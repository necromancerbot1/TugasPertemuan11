<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    /**
     * User bisa membuat review.
     */
    public function create(User $user): bool
    {
        return $user->isUser();
    }

    /**
     * User hanya bisa edit review miliknya sendiri. Admin bisa edit semua.
     */
    public function update(User $user, Review $review): bool
    {
        return $user->isAdmin() || $user->id === $review->user_id;
    }

    /**
     * User hanya bisa hapus review miliknya. Admin bisa hapus semua.
     */
    public function delete(User $user, Review $review): bool
    {
        return $user->isAdmin() || $user->id === $review->user_id;
    }
}
