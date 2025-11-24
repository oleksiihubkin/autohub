<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Car;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'car_id'  => Car::inRandomOrder()->value('id')  ?? Car::factory()->create()->id,
            'rating'  => $this->faker->numberBetween(1,5),
            'comment' => $this->faker->boolean(70) ? $this->faker->sentence(10) : null,
        ];
    }
}