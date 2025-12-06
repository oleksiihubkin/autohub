<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DealerFactory extends Factory
{
    /**
     * Define the default attributes for a Dealer model.
     * Used for seeding and testing.
     */
    public function definition(): array
    {
        return [
            // Random business/company name
            'name'  => $this->faker->company(),

            // Random phone number
            'phone' => $this->faker->phoneNumber(),

            // Unique and safe email address
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
