<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    /**
     * Determine if the user is allowed to update the review.
     * User must be authenticated AND must meet one of the conditions:
     *  - be an admin, OR
     *  - be the original author of the review
     */
    public function authorize(): bool {
        $review = $this->route('review');

        return auth()->check() &&
               (auth()->user()->isAdmin() || $review->user_id === auth()->id());
    }

    /**
     * Validation rules for updating an existing review.
     */
    public function rules(): array {
        return [
            // Rating must be between 1 and 5
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],

            // Optional review comment, max 2000 characters
            'comment' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
