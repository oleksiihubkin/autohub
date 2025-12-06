<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDealerRequest extends FormRequest
{
    /**
     * Allow the request. Authorization is handled elsewhere.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for updating an existing Dealer record.
     */
    public function rules(): array
    {
        return [
            // Dealer name is required
            'name'  => 'required|string|max:255',

            // Optional phone number with reasonable length limits
            'phone' => 'nullable|string|min:7|max:50',

            // Optional email, must be valid if provided
            'email' => 'nullable|email|max:255',
        ];
    }
}
