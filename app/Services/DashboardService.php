<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getStats(): array
    {
        $totalUsers = User::count();
        $bannedUsers = User::where('is_banned', true)->count();
        
        return [
            'totalUsers' => $totalUsers,
            'activeUsers' => max($totalUsers - $bannedUsers, 0),
            'bannedUsers' => $bannedUsers,
            'totalProducts' => Product::count(),
            'lowStockProducts' => Product::where('stock', '<=', 5)->count(),
            'totalStockUnits' => (int) Product::sum('stock'),
            'totalCategories' => Category::count(),
            'totalOrders' => Order::count(),
            'totalItemsSold' => (int) DB::table('order_product')->sum('quantity'),
            'estimatedRevenue' => (float) DB::table('order_product')->sum(DB::raw('quantity * price')),
        ];
    }

    public function getRecentData(): array
    {
        $newestProducts = Product::with('category')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($product) {
                $product->description_excerpt = str($product->description)->limit(90);
                $product->category_name = $product->category?->title;
                return $product;
            });

        $latestOrders = Order::with('user')
            ->select('orders.*')
            ->selectRaw('(SELECT SUM(quantity) FROM order_product WHERE order_id = orders.id) as items_count')
            ->selectRaw('(SELECT SUM(quantity * price) FROM order_product WHERE order_id = orders.id) as total_amount')
            ->latest()
            ->take(6)
            ->get();

        return compact('newestProducts', 'latestOrders');
    }

    public function getTopSellingProducts(int $limit = 4)
    {
        return Product::query()
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.stock',
                'categories.title as category_name'
            )
            ->selectRaw('SUM(order_product.quantity) as total_quantity')
            ->selectRaw('SUM(order_product.quantity * order_product.price) as revenue')
            ->groupBy(
                'products.id',
                'products.name',
                'products.price',
                'products.stock',
                'categories.title'
            )
            ->orderByDesc('total_quantity')
            ->take($limit)
            ->get();
    }
}