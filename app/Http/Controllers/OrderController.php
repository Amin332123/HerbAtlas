<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function index(): View
    {
        $user = auth()->user();
        $isAdmin = $user?->role?->status === 'admin';

        $orders = $this->orderService
            ->getOrderQueryForUser($user?->id, $isAdmin)
            ->latest()
            ->paginate(10)
            ->through(fn (Order $order) => $this->orderService->transformOrder($order));

        return view('orders', [
            'orders' => $orders,
            'isAdmin' => $isAdmin,
        ]);
    }

    public function show(int|string $id): View
    {
        $user = auth()->user();
        $isAdmin = $user?->role?->status === 'admin';

        $order = $this->orderService
            ->getOrderQueryForUser($user?->id, $isAdmin)
            ->findOrFail($id);

        $order = $this->orderService->loadAndTransformOrder($order);

        return view('orderDetails', [
            'order' => $order,
            'orderItems' => $order->products,
            'isDraft' => false,
        ]);
    }

    public function store(StoreOrderRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $order = $this->orderService->createOrder(
                $request->validated('items'),
                (int) auth()->id()
            );

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Order created successfully.',
                    'order_id' => $order->id,
                    'redirect_url' => route('orders.show', $order->id),
                ], 201);
            }

            return redirect()
                ->route('orders.show', $order->id)
                ->with('success', 'Order placed successfully!');
        } catch (ValidationException $exception) {
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $exception->errors(),
                ], 422);
            }

            throw $exception;
        }
    }

    public function updateItem(Request $request, Order $order, Product $product): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        $isAdmin = $user?->role?->status === 'admin';

        if (! $isAdmin && $order->user_id !== $user?->id) {
            abort(403);
        }

        if ($order->status !== Order::STATUS_PENDING) {
            return redirect()->back()->withErrors(['Order cannot be modified.']);
        }

        $newQuantity = (int) $request->quantity;

        try {
            $updatedOrder = $this->orderService->updateOrderItem($order, $product, $newQuantity);
            return redirect()
                ->route('orders.show', $updatedOrder->id)
                ->with('success', 'Item updated successfully.');
        } catch (ValidationException $exception) {
            return redirect()->back()->withErrors($exception->errors());
        }
    }

    public function removeItem(Order $order, Product $product): RedirectResponse
    {
        $user = auth()->user();
        $isAdmin = $user?->role?->status === 'admin';

        if (! $isAdmin && $order->user_id !== $user?->id) {
            abort(403);
        }

        if ($order->status !== Order::STATUS_PENDING) {
            return redirect()->back()->withErrors(['Order cannot be modified.']);
        }

        try {
            $updatedOrder = $this->orderService->removeOrderItem($order, $product);
            return redirect()
                ->route('orders.show', $updatedOrder->id)
                ->with('success', 'Item removed successfully.');
        } catch (ValidationException $exception) {
            return redirect()->back()->withErrors($exception->errors());
        }
    }
}
