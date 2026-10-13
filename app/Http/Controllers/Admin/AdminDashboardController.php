<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Review;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'    => User::count(),
            'total_products' => Product::count(),
            'total_orders'   => Order::count(),
            'total_revenue'  => Order::delivered()->sum('total_price'),
            'pending_orders' => Order::pending()->count(),
            'low_stock'      => Product::where('stock', '<', 10)->count(),
        ];

        $recentOrders   = Order::with('user')->latest()->take(5)->get();
        $topProducts    = Product::popular()->active()->take(5)->get();
        $recentUsers    = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts', 'recentUsers'));
    }
}
