<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Allow viewing the list of reviews.
     * Public access — even guests may view reviews.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Allow viewing a specific review.
     * Public access — even guests may read reviews.
     */
    public function view(?User $user, Review $review): bool
    {
        return true;
    }

    /**
     * Allow creation of reviews.
     * Only authenticated users can create new reviews.
     */
    public function create(User $user): bool
    {
        return $user !== null;
    }

    /**
     * Allow updating a review.
     * User must be admin OR the original author of the review.
     */
    public function update(User $user, Review $review): bool
    {
        return $user->role === 'admin'
            || $review->user_id === $user->id;
    }

    /**
     * Allow deleting a review.
     * Same rules as update: admin OR the author.
     */
    public function delete(User $user, Review $review): bool
    {
        return $user->role === 'admin'
            || $review->user_id === $user->id;
    }
}
