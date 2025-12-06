<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFactoryRequest extends FormRequest
{
    /**
     * Allow the request to proceed.
     * Authorization logic is handled elsewhere (e.g., middleware).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating a new Factory record.
     */
    public function rules(): array
    {
        return [
            // Factory name (required field)
            'name'     => 'required|string|max:255',

            // Factory location (required field)
            'location' => 'required|string|max:255',
        ];
    }
}
