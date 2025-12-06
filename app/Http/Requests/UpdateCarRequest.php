<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    /**
     * Allow the request. Authorization is handled elsewhere.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for updating an existing Car record.
     * These are identical to StoreCarRequest but used for updates.
     */
    public function rules(): array
    {
        return [
            // Car manufacturer name
            'make'       => 'required|string|max:255',

            // Car model name
            'model'      => 'required|string|max:255',

            // Year must be realistic and not exceed current year
            'year'       => 'required|integer|min:1900|max:' . date('Y'),

            // Color description
            'color'      => 'required|string|max:50',

            // Car price, must be numeric and non-negative
            'price'      => 'required|numeric|min:0',

            // Must reference an existing factory
            'factory_id' => 'required|exists:factories,id',
        ];
    }
}
