<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Only authenticated users are allowed to submit reviews.
     */
    public function authorize(): bool {
        return auth()->check();
    }

    /**
     * Validation rules for creating a new review.
     */
    public function rules(): array {
        return [
            // The selected car must exist in the cars table
            'car_id'  => ['required', 'exists:cars,id'],

            // Rating must be an integer between 1 and 5
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],

            // Optional review text, max length 2000 characters
            'comment' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
