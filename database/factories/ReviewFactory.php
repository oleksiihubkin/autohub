<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Car;

class ReviewFactory extends Factory
{
    /**
     * Define the default attributes for a Review model.
     * Used for test data generation and database seeding.
     */
    public function definition(): array
    {
        return [
            // Assign a random existing user, or create one if none exist
            'user_id' => User::inRandomOrder()->value('id')
                        ?? User::factory()->create()->id,

            // Assign a random existing car, or create one if none exist
            'car_id'  => Car::inRandomOrder()->value('id')
                        ?? Car::factory()->create()->id,

            // Rating from 1 to 5
            'rating'  => $this->faker->numberBetween(1, 5),

            // 70% chance to generate a short comment, otherwise null
            'comment' => $this->faker->boolean(70)
                        ? $this->faker->sentence(10)
                        : null,
        ];
    }
}
