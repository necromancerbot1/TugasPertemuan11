<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_orders'    => $user->orders()->count(),
            'pending_orders'  => $user->orders()->pending()->count(),
            'delivered_orders'=> $user->orders()->delivered()->count(),
            'total_spent'     => $user->orders()->delivered()->sum('total_price'),
        ];

        $recentOrders   = $user->orders()->with('items.product')->latest()->take(3)->get();
        $featuredProducts = Product::active()->inStock()->latest()->take(6)->get();

        return view('user.dashboard', compact('stats', 'recentOrders', 'featuredProducts'));
    }
}
