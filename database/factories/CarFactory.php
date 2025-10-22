<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'make' => $this->faker->company(),
            'model' => $this->faker->word(),
            'year' => $this->faker->numberBetween(2000, 2025),
            'color' => $this->faker->safeColorName(),
            'price' => $this->faker->randomFloat(2, 10000, 100000),
        ];
    }
}
