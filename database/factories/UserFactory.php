<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The cached password value so the factory does not hash
     * "password" repeatedly for each generated user.
     */
    protected static ?string $password;

    /**
     * Define the default attributes for the User model.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Random user name
            'name' => fake()->name(),

            // Unique, safe email address
            'email' => fake()->unique()->safeEmail(),

            // Mark email as verified by default
            'email_verified_at' => now(),

            // Password is hashed once and reused for all factory instances
            'password' => static::$password ??= Hash::make('password'),

            // Random remember token for "remember me" functionality
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Make the user have an unverified email.
     * Useful for testing behavior related to email verification.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
