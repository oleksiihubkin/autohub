<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FactoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'    => $this->faker->company(),
            'location' => $this->faker->city(),
        ];
    }
}