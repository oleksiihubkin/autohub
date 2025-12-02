<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;
use App\Models\Factory as Plant;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'make'       => $this->faker->randomElement(['Toyota','BMW','Audi','Ford','Volkswagen']),
            'model'      => strtoupper($this->faker->bothify('??-###')),
            'year'       => $this->faker->numberBetween(2005, 2025),
            'color'      => $this->faker->safeColorName(),
            'price'      => $this->faker->numberBetween(8000, 60000),
            'factory_id' => Plant::inRandomOrder()->value('id') ?? Plant::factory()->create()->id,
        ];
    }
}