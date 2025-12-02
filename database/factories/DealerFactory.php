<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DealerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'  => $this->faker->company(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}