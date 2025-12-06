<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDealerRequest extends FormRequest
{
    /**
     * Anyone is allowed to submit this request.
     * (Authorization is handled elsewhere, e.g., middleware.)
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Validation rules for creating a new Dealer record.
     */
    public function rules(): array
    {
        return [
            // Dealer name (required)
            'name'  => 'required|string|max:255',

            // Optional phone number (long enough to be valid)
            'phone' => 'nullable|string|min:7|max:50',

            // Optional email, must be valid if provided
            'email' => 'nullable|email|max:255',
        ];
    }
}
