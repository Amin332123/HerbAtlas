<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'products' => function ($query) {
                $query->with(['pictures', 'category']);
            },
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get()
            ->map(function ($order) {
                $order->calculated_total = $order->products->sum(function ($product) {
                    return ((float) $product->pivot->price) * ((int) $product->pivot->quantity);
                });

                $order->total_quantity = $order->products->sum(function ($product) {
                    return (int) $product->pivot->quantity;
                });

                return $order;
            });

        return view('orders', compact('orders'));
    }

    public function show($id)
    {
        if ($id === 'draft') {
            return view('orderDetails', [
                'isDraft' => true,
                'draftOrderToken' => session('draft_order_token', 'DRAFT-' . now()->format('Ymd')),
                'orderItems' => collect(),
                'order' => null,
            ]);
        }

        $order = Order::with([
            'products' => function ($query) {
                $query->with(['pictures', 'category']);
            },
        ])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $order->calculated_total = $order->products->sum(function ($product) {
            return ((float) $product->pivot->price) * ((int) $product->pivot->quantity);
        });

        $order->total_quantity = $order->products->sum(function ($product) {
            return (int) $product->pivot->quantity;
        });

        return view('orderDetails', [
            'order' => $order,
            'orderItems' => $order->products,
            'isDraft' => false,
            'draftOrderToken' => null,
        ]);
    }

    public function store(Request $request)
    {
        $items = $request->input('items');

        if (!is_array($items) || empty($items)) {
            return response()->json(['message' => 'Your cart is empty'], 422);
        }

        return DB::transaction(function () use ($items) {
            $order = new Order();
            $order->user_id = auth()->id();
            $order->name = 'Order #' . now()->format('YmdHis');
            $order->save();

            foreach ($items as $item) {
                $productId = $item['id'] ?? null;
                $quantity = max(1, (int) ($item['quantity'] ?? 1));

                if (!$productId) {
                    continue;
                }

                $product = Product::findOrFail($productId);

                $order->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'price' => $product->price * $quantity,
                ]);
            }

            return response()->json([
                'message' => 'data stored',
                'order_id' => $order->id,
            ]);
        });
    }
}



