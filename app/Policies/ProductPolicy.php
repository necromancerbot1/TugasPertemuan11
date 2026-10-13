<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Admin & editor bisa lihat semua produk (termasuk nonaktif).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /**
     * Semua user bisa lihat produk aktif.
     */
    public function view(?User $user, Product $product): bool
    {
        return $product->is_active || ($user && ($user->isAdmin() || $user->isEditor()));
    }

    /**
     * Hanya admin & editor yang bisa membuat produk.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /**
     * Hanya admin & editor yang bisa edit produk.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /**
     * Hanya admin yang bisa menghapus produk.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }

    /**
     * Hanya admin yang bisa restore soft-deleted produk.
     */
    public function restore(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }

    /**
     * Hanya admin yang bisa permanent delete.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return $user->isAdmin();
    }
}
