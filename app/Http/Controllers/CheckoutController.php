<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Stripe\Checkout\Session as StripeCheckoutSession;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Stripe\Webhook;
use Symfony\Component\HttpFoundation\Response;
use UnexpectedValueException;

class CheckoutController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function checkout(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required_without:items.*.product_id', 'nullable', 'integer', 'exists:products,id'],
            'items.*.product_id' => ['required_without:items.*.id', 'nullable', 'integer', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'total' => ['nullable', 'integer', 'min:1'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        try {
            $payload = $this->orderService->buildStripeCheckoutPayload(
                $validated['items'],
                config('services.stripe.currency', 'usd')
            );

            if (isset($validated['total']) && (int) $validated['total'] !== (int) $payload['total_cents']) {
                return response()->json([
                    'message' => 'Cart total mismatch. Please refresh your cart and try again.',
                ], 422);
            }

            $user->createOrGetStripeCustomer();

            $returnBaseUrl = rtrim($request->getSchemeAndHttpHost(), '/');

            $session = $this->stripe()->checkout->sessions->create([
                'mode' => 'payment',
                'customer' => $user->stripe_id,
                'line_items' => $payload['line_items'],
                'success_url' => $returnBaseUrl . '/payment/success/{CHECKOUT_SESSION_ID}',
                'cancel_url' => $returnBaseUrl . '/payment/cancel',
                'payment_method_types' => ['card'],
                'client_reference_id' => (string) $user->id,
                'metadata' => [
                    'user_id' => (string) $user->id,
                    'items' => json_encode($payload['items'], JSON_THROW_ON_ERROR),
                    'total_cents' => (string) $payload['total_cents'],
                    'currency' => $payload['currency'],
                ],
            ]);

            return response()->json([
                'id' => $session->id,
                'session_id' => $session->id,
                'url' => $session->url,
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $exception->errors(),
            ], 422);
        } catch (\Throwable $exception) {
            Log::error('Stripe checkout session creation failed.', [
                'user_id' => $user->id ?? null,
                'message' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Unable to start Stripe checkout right now.',
            ], 500);
        }
    }

    public function success(string $session): \Illuminate\View\View|RedirectResponse
    {
        $authenticatedUserId = Auth::id();

        try {
            /** @var StripeCheckoutSession $stripeSession */
            $stripeSession = $this->stripe()->checkout->sessions->retrieve($session, []);

            $sessionUserId = (int) data_get($stripeSession, 'metadata.user_id', 0);

            if ($sessionUserId < 1) {
                abort(Response::HTTP_FORBIDDEN);
            }

            if ($authenticatedUserId !== null && $sessionUserId !== $authenticatedUserId) {
                abort(Response::HTTP_FORBIDDEN);
            }

            if (($stripeSession->payment_status ?? null) !== 'paid') {
                return redirect()
                    ->route('order.draft')
                    ->withErrors(['Payment has not been completed yet.']);
            }

            $order = $this->finalizePaidCheckoutSession($stripeSession);

            return redirect()
                ->route('order.draft')
                ->with('success', 'Thanks! Your payment was successful and your order has been created.')
                ->with('clear_draft_cart', true)
                ->with('paid_order_id', $order->id);
        } catch (ValidationException $exception) {
            return redirect()
                ->route('order.draft')
                ->withErrors($exception->errors());
        } catch (\Throwable $exception) {
            Log::error('Stripe checkout success handling failed.', [
                'session_id' => $session,
                'user_id' => $authenticatedUserId,
                'message' => $exception->getMessage(),
            ]);

            return redirect()
                ->route('order.draft')
                ->withErrors(['We could not verify your payment right now. Please contact support if you were charged.']);
        }
    }

    public function cancel(): RedirectResponse
    {
        return redirect()
            ->route('order.draft')
            ->withErrors(['Payment cancelled. Your draft cart is still saved locally.']);
    }

    public function webhook(Request $request): Response
    {
        $webhookSecret = (string) config('services.stripe.webhook_secret');

        if ($webhookSecret === '') {
            Log::warning('Stripe webhook secret is missing.');

            return response('Stripe webhook secret is not configured.', 500);
        }

        $payload = $request->getContent();
        $signature = (string) $request->header('Stripe-Signature', '');

        try {
            $event = Webhook::constructEvent($payload, $signature, $webhookSecret);

            if (in_array($event->type, ['checkout.session.completed', 'checkout.session.async_payment_succeeded'], true)) {
                /** @var StripeCheckoutSession $stripeSession */
                $stripeSession = $event->data->object;

                if (($stripeSession->payment_status ?? null) === 'paid') {
                    $this->finalizePaidCheckoutSession($stripeSession);
                }
            }

            return response('Webhook handled.', 200);
        } catch (UnexpectedValueException|SignatureVerificationException $exception) {
            Log::warning('Invalid Stripe webhook received.', [
                'message' => $exception->getMessage(),
            ]);

            return response('Invalid webhook payload.', 400);
        } catch (ValidationException $exception) {
            Log::warning('Stripe webhook validation failed.', [
                'errors' => $exception->errors(),
            ]);

            return response('Webhook validation failed.', 422);
        } catch (\Throwable $exception) {
            Log::error('Stripe webhook processing failed.', [
                'message' => $exception->getMessage(),
            ]);

            return response('Webhook processing failed.', 500);
        }
    }

    protected function finalizePaidCheckoutSession(StripeCheckoutSession $stripeSession): Order
    {
        $items = json_decode((string) data_get($stripeSession, 'metadata.items', '[]'), true);

        if (! is_array($items) || $items === []) {
            throw ValidationException::withMessages([
                'items' => ['No order items were found in the Stripe session metadata.'],
            ]);
        }

        $userId = (int) data_get($stripeSession, 'metadata.user_id', 0);

        if ($userId < 1) {
            throw ValidationException::withMessages([
                'user' => ['No valid user was found for this Stripe session.'],
            ]);
        }

        /** @var User|null $user */
        $user = User::query()->find($userId);

        if (! $user) {
            throw ValidationException::withMessages([
                'user' => ['The user for this payment could not be found.'],
            ]);
        }

        if (($stripeSession->payment_status ?? null) !== 'paid') {
            throw ValidationException::withMessages([
                'payment' => ['This Stripe session has not been paid yet.'],
            ]);
        }

        if (! empty($stripeSession->customer) && $user->stripe_id !== $stripeSession->customer) {
            $user->forceFill([
                'stripe_id' => $stripeSession->customer,
            ])->save();
        }

        return $this->orderService->createPaidOrder(
            items: $items,
            userId: $user->id,
            stripeCheckoutSessionId: (string) $stripeSession->id,
            stripePaymentIntentId: $stripeSession->payment_intent ? (string) $stripeSession->payment_intent : null,
            paidAmountTotal: $stripeSession->amount_total !== null ? (int) $stripeSession->amount_total : null,
        );
    }

    protected function stripe(): StripeClient
    {
        return new StripeClient((string) config('services.stripe.secret'));
    }
}
