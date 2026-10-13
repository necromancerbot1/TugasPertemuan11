<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Admin bisa lihat semua order.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Admin bisa lihat semua order, user hanya bisa lihat order miliknya.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->isAdmin() || $user->id === $order->user_id;
    }

    /**
     * Hanya user biasa yang bisa membuat order.
     */
    public function create(User $user): bool
    {
        return $user->isUser();
    }

    /**
     * Hanya admin yang bisa update status order.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->isAdmin();
    }

    /**
     * Hanya admin yang bisa hapus order.
     */
    public function delete(User $user, Order $order): bool
    {
        return $user->isAdmin();
    }
}
