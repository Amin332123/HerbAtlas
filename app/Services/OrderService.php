<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function getOrderQueryForUser(?int $userId, bool $isAdmin = false): Builder
    {
        $query = Order::query()->with([
            'user.role',
            'products' => fn ($query) => $query
                ->with(['pictures', 'category'])
                ->orderBy('products.name'),
        ]);

        if (! $isAdmin) {
            $query->where('user_id', $userId);
        }

        return $query;
    }

    public function buildStripeCheckoutPayload(array $items, string $currency = 'usd'): array
    {
        $normalizedItems = $this->normalizeItems($items);

        if ($normalizedItems === []) {
            throw ValidationException::withMessages([
                'items' => ['Your cart is empty.'],
            ]);
        }

        $productIds = array_keys($normalizedItems);

        /** @var Collection<int, Product> $products */
        $products = Product::query()
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $missingProductIds = array_values(array_diff($productIds, $products->keys()->all()));

        if ($missingProductIds !== []) {
            throw ValidationException::withMessages([
                'items' => ['One or more selected products no longer exist.'],
            ]);
        }

        $lineItems = [];
        $metadataItems = [];
        $totalCents = 0;

        foreach ($normalizedItems as $productId => $item) {
            /** @var Product $product */
            $product = $products->get($productId);
            $quantity = (int) $item['quantity'];

            $this->ensureValidQuantityAndStock($product, $quantity, "items.$productId");

            $unitAmount = $this->convertAmountToCents((float) $product->price);

            $lineItems[] = [
                'price_data' => [
                    'currency' => strtolower($currency),
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $unitAmount,
                ],
                'quantity' => $quantity,
            ];

            $metadataItems[] = [
                'id' => $product->id,
                'quantity' => $quantity,
            ];

            $totalCents += $unitAmount * $quantity;
        }

        return [
            'line_items' => $lineItems,
            'items' => array_values($metadataItems),
            'total_cents' => $totalCents,
            'currency' => strtolower($currency),
        ];
    }

    public function createOrder(array $items, int $userId): Order
    {
        $normalizedItems = $this->normalizeItems($items);

        if ($normalizedItems === []) {
            throw ValidationException::withMessages([
                'items' => ['Your cart is empty.'],
            ]);
        }

        return DB::transaction(function () use ($normalizedItems, $userId) {
            /** @var Collection<int, Product> $products */
            $products = $this->loadProductsForItems($normalizedItems, true);

            $order = Order::create([
                'user_id' => $userId,
                'name' => 'Order #' . now()->timestamp,
            ]);

            if (! $order->name) {
                $order->forceFill([
                    'name' => 'Order #' . $order->id,
                ])->save();
            }

            $orderItems = [];

            foreach ($normalizedItems as $productId => $item) {
                /** @var Product $product */
                $product = $products->get($productId);
                $quantity = (int) $item['quantity'];

                $this->ensureValidQuantityAndStock($product, $quantity, "items.$productId");

                $orderItems[$product->id] = [
                    'quantity' => $quantity,
                    'price' => (float) $product->price,
                ];

                $product->decrement('stock', $quantity);
            }

            $order->products()->attach($orderItems);

            return $this->loadAndTransformOrder($order);
        });
    }

    public function createPaidOrder(
        array $items,
        int $userId,
        string $stripeCheckoutSessionId,
        ?string $stripePaymentIntentId = null,
        ?int $paidAmountTotal = null
    ): Order {
        $normalizedItems = $this->normalizeItems($items);

        if ($normalizedItems === []) {
            throw ValidationException::withMessages([
                'items' => ['Your cart is empty.'],
            ]);
        }

        return DB::transaction(function () use (
            $normalizedItems,
            $userId,
            $stripeCheckoutSessionId,
            $stripePaymentIntentId,
            $paidAmountTotal
        ) {
            $hasStatusColumn = Schema::hasColumn('orders', 'status');
            $hasStripeCheckoutSessionColumn = Schema::hasColumn('orders', 'stripe_checkout_session_id');
            $hasStripePaymentIntentColumn = Schema::hasColumn('orders', 'stripe_payment_intent_id');

            $existingOrder = $hasStripeCheckoutSessionColumn
                ? Order::query()
                    ->where('stripe_checkout_session_id', $stripeCheckoutSessionId)
                    ->first()
                : null;

            if ($existingOrder) {
                return $this->loadAndTransformOrder($existingOrder);
            }

            /** @var Collection<int, Product> $products */
            $products = $this->loadProductsForItems($normalizedItems, true);

            $orderItems = [];
            $calculatedTotalCents = 0;

            foreach ($normalizedItems as $productId => $item) {
                /** @var Product $product */
                $product = $products->get($productId);
                $quantity = (int) $item['quantity'];

                $this->ensureValidQuantityAndStock($product, $quantity, "items.$productId");

                $unitPrice = (float) $product->price;
                $calculatedTotalCents += $this->convertAmountToCents($unitPrice) * $quantity;

                $orderItems[$product->id] = [
                    'quantity' => $quantity,
                    'price' => $unitPrice,
                ];
            }

            if ($paidAmountTotal !== null && $paidAmountTotal !== $calculatedTotalCents) {
                throw ValidationException::withMessages([
                    'payment' => ['The paid amount does not match the current order total.'],
                ]);
            }

            $orderAttributes = [
                'user_id' => $userId,
                'name' => 'Order #' . now()->timestamp,
            ];

            if ($hasStatusColumn) {
                $orderAttributes['status'] = Order::STATUS_COMPLETED;
            }

            if ($hasStripeCheckoutSessionColumn) {
                $orderAttributes['stripe_checkout_session_id'] = $stripeCheckoutSessionId;
            }

            if ($hasStripePaymentIntentColumn) {
                $orderAttributes['stripe_payment_intent_id'] = $stripePaymentIntentId;
            }

            $order = Order::create($orderAttributes);

            if (! $order->name) {
                $order->forceFill([
                    'name' => 'Order #' . $order->id,
                ])->save();
            }

            foreach ($normalizedItems as $productId => $item) {
                /** @var Product $product */
                $product = $products->get($productId);
                $product->decrement('stock', (int) $item['quantity']);
            }

            $order->products()->attach($orderItems);

            return $this->loadAndTransformOrder($order);
        });
    }

    public function updateOrderItem(Order $order, Product $product, int $quantity): Order
    {
        if ($quantity < 1) {
            throw ValidationException::withMessages([
                'quantity' => ['Quantity must be at least 1.'],
            ]);
        }

        return DB::transaction(function () use ($order, $product, $quantity) {
            $order = Order::query()
                ->whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            $pivot = $order->products()
                ->where('product_id', $product->id)
                ->lockForUpdate()
                ->first()?->pivot;

            if (! $pivot) {
                throw ValidationException::withMessages([
                    'product' => ['Product not found in this order.'],
                ]);
            }

            $product = Product::query()->whereKey($product->id)->lockForUpdate()->firstOrFail();

            $currentQuantity = (int) $pivot->quantity;
            $stockChange = $quantity - $currentQuantity;

            if ($stockChange > 0 && $product->stock < $stockChange) {
                throw ValidationException::withMessages([
                    'quantity' => ["The product '{$product->name}' only has {$product->stock} item(s) left in stock."],
                ]);
            }

            if ($stockChange > 0) {
                $product->decrement('stock', $stockChange);
            } elseif ($stockChange < 0) {
                $product->increment('stock', abs($stockChange));
            }

            $order->products()->updateExistingPivot($product->id, [
                'quantity' => $quantity,
                'price' => (float) $pivot->price,
            ]);

            return $this->loadAndTransformOrder($order);
        });
    }

    public function removeOrderItem(Order $order, Product $product): Order
    {
        return DB::transaction(function () use ($order, $product) {
            $order = Order::query()
                ->whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            $pivot = $order->products()
                ->where('product_id', $product->id)
                ->lockForUpdate()
                ->first()?->pivot;

            if (! $pivot) {
                throw ValidationException::withMessages([
                    'product' => ['Product not found in this order.'],
                ]);
            }

            $product = Product::query()->whereKey($product->id)->lockForUpdate()->firstOrFail();
            $product->increment('stock', (int) $pivot->quantity);
            $order->products()->detach($product->id);

            return $this->loadAndTransformOrder($order);
        });
    }

    public function loadAndTransformOrder(Order $order): Order
    {
        $order->loadMissing([
            'user.role',
            'products' => fn ($query) => $query
                ->with(['pictures', 'category'])
                ->orderBy('products.name'),
        ]);

        return $this->transformOrder($order);
    }

    public function transformOrder(Order $order): Order
    {
        $products = $order->products ?? collect();

        $itemsCount = $products->count();
        $totalQuantity = $products->sum(fn ($product) => (int) data_get($product, 'pivot.quantity', 0));
        $calculatedTotal = (float) $products->sum(function ($product) {
            return ((float) data_get($product, 'pivot.price', 0)) * ((int) data_get($product, 'pivot.quantity', 0));
        });

        $order->setAttribute('display_name', $order->name ?: ('Order #' . $order->id));
        $order->setAttribute('items_count', $itemsCount);
        $order->setAttribute('total_quantity', $totalQuantity);
        $order->setAttribute('calculated_total', round($calculatedTotal, 2));
        $order->setAttribute('is_pending', $order->status === Order::STATUS_PENDING);
        $order->setAttribute('can_modify', $order->status === Order::STATUS_PENDING);

        return $order;
    }

    /**
     * @param  array<int, array{product_id:int, quantity:int}>  $normalizedItems
     * @return Collection<int, Product>
     */
    protected function loadProductsForItems(array $normalizedItems, bool $lockForUpdate = false): Collection
    {
        $productIds = array_keys($normalizedItems);

        $query = Product::query()->whereIn('id', $productIds);

        if ($lockForUpdate) {
            $query->lockForUpdate();
        }

        /** @var Collection<int, Product> $products */
        $products = $query->get()->keyBy('id');

        $missingProductIds = array_values(array_diff($productIds, $products->keys()->all()));

        if ($missingProductIds !== []) {
            throw ValidationException::withMessages([
                'items' => ['One or more selected products no longer exist.'],
            ]);
        }

        return $products;
    }

    protected function ensureValidQuantityAndStock(Product $product, int $quantity, string $errorKey = 'items'): void
    {
        if ($quantity < 1) {
            throw ValidationException::withMessages([
                $errorKey => ['Quantity must be at least 1.'],
            ]);
        }

        if ($product->stock < $quantity) {
            throw ValidationException::withMessages([
                $errorKey => ["The product '{$product->name}' only has {$product->stock} item(s) left in stock."],
            ]);
        }
    }

    protected function convertAmountToCents(float $amount): int
    {
        return (int) round($amount * 100);
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     * @return array<int, array{product_id:int, quantity:int}>
     */
    protected function normalizeItems(array $items): array
    {
        $normalized = [];

        foreach ($items as $item) {
            $productId = (int) ($item['id'] ?? $item['product_id'] ?? 0);
            $quantity = (int) ($item['quantity'] ?? 0);

            if ($productId < 1 || $quantity < 1) {
                continue;
            }

            if (! isset($normalized[$productId])) {
                $normalized[$productId] = [
                    'product_id' => $productId,
                    'quantity' => 0,
                ];
            }

            $normalized[$productId]['quantity'] += $quantity;
        }

        return $normalized;
    }
}
