<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Validation rules for updating the user profile.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // User name must be provided and reasonably short
            'name' => ['required', 'string', 'max:255'],

            // Email must be valid, lowercase, unique — except for the current user
            'email' => [
                'required',
                'string',
                'lowercase', // automatically converts email to lowercase
                'email',
                'max:255',

                // Unique in "users" table, but ignore the current user's own email
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
}
