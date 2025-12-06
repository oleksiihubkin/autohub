<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FactoryFactory extends Factory
{
    /**
     * Define the default attributes for a Factory model.
     * Used when generating fake data for testing or seeding.
     */
    public function definition(): array
    {
        return [
            // Random factory/company name
            'name'     => $this->faker->company(),

            // Random city/location name
            'location' => $this->faker->city(),
        ];
    }
}
