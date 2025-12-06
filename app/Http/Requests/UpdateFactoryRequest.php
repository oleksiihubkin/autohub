<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFactoryRequest extends FormRequest
{
    /**
     * Allow this request. Authorization is handled elsewhere
     * (e.g., middleware or controller checks).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for updating an existing Factory record.
     */
    public function rules(): array
    {
        return [
            // Factory name (required)
            'name'     => 'required|string|max:255',

            // Factory location (required)
            'location' => 'required|string|max:255',
        ];
    }
}
