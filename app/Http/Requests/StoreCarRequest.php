<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Always true — access control is handled elsewhere (middleware/controller).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating a new Car record.
     */
    public function rules(): array
    {
        return [
            // Car manufacturer name (e.g., Toyota)
            'make'       => 'required|string|max:255',

            // Car model name (e.g., Corolla)
            'model'      => 'required|string|max:255',

            // Year must be realistic and not exceed current year
            'year'       => 'required|integer|min:1900|max:' . date('Y'),

            // Color string, reasonable length
            'color'      => 'required|string|max:50',

            // Car price, must be numeric and non-negative
            'price'      => 'required|numeric|min:0',

            // The selected factory must exist in the factories table
            'factory_id' => 'required|exists:factories,id',
        ];
    }
}
