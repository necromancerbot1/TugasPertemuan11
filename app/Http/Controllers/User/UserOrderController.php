<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->latest()
            ->paginate(5);

        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('items.product');
        return view('user.orders.show', compact('order'));
    }
}
