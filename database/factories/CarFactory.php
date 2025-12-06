<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;
use App\Models\Factory as Plant;

class CarFactory extends Factory
{
    /**
     * The model that this factory corresponds to.
     */
    protected $model = Car::class;

    /**
     * Define the default set of attributes for a Car model.
     * Used when generating fake data for testing or seeding.
     */
    public function definition(): array
    {
        return [
            // Random manufacturer
            'make'       => $this->faker->randomElement(['Toyota', 'BMW', 'Audi', 'Ford', 'Volkswagen']),

            // Model code like "AB-123"
            'model'      => strtoupper($this->faker->bothify('??-###')),

            // Random production year
            'year'       => $this->faker->numberBetween(2005, 2025),

            // Random safe HTML color name
            'color'      => $this->faker->safeColorName(),

            // Random price within a realistic range
            'price'      => $this->faker->numberBetween(8000, 60000),

            // Assign a factory: pick an existing one, or create a new one if none exist
            'factory_id' => Plant::inRandomOrder()->value('id')
                            ?? Plant::factory()->create()->id,
        ];
    }
}
