<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\DashboardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function dashboard(): View
    {
        $stats = $this->dashboardService->getStats();
        $recent = $this->dashboardService->getRecentData();
        $topSellingProducts = $this->dashboardService->getTopSellingProducts();

        return view('dashboard', array_merge($stats, $recent, ['topSellingProducts' => $topSellingProducts]));
    }

    public function index(): View
    {
        $users = User::query()
            ->withCount('orders')
            ->select('users.*')
            ->selectSub(
                Order::query()
                    ->join('order_product', 'orders.id', '=', 'order_product.order_id')
                    ->selectRaw('COALESCE(SUM(order_product.quantity), 0)')
                    ->whereColumn('orders.user_id', 'users.id'),
                'total_items_bought'
            )
            ->orderBy('firstName')
            ->paginate(50);

        return view('users', compact('users'));
    }

    public function toggleBan(Request $request, User $user): RedirectResponse
    {
        if ($request->user() && $request->user()->id === $user->id) {
            return back()->with('error', 'You cannot ban or unban your own account.');
        }

        $user->is_banned = ! $user->is_banned;
        $user->save();

        $message = $user->is_banned
            ? 'User has been banned successfully.'
            : 'User has been unbanned successfully.';

        return redirect()->route('users.index')->with('success', $message);
    }
}
