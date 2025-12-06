<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Factory;
use App\Models\Dealer;
use App\Models\Car;
use App\Models\Review;
use Database\Factories\CarFactory;
use Database\Factories\FactoryFactory;
use Database\Factories\DealerFactory;
use Database\Factories\ReviewFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with initial data.
     */
    public function run(): void
    {
        // 1) Create an admin user
        User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'role'     => 'admin',
            'password' => bcrypt('password'),
        ]);

        // 2) Create regular users
        $users = User::factory(3)->create(['role' => 'user']);

        // 3) Create factories (plants)
        $plants = Factory::factory(3)->create();

        // 4) Create cars linked to each factory
        $plants->each(function (\App\Models\Factory $plant) {
            CarFactory::new()
                ->count(3)
                ->create([
                    'factory_id' => $plant->id,
                ]);
        });

        // 5) Create dealers
        $dealers = Dealer::factory(5)->create();

        // 6) Attach dealers to factories (many-to-many) if the relationship exists
        // Safe to disable if Dealer model does not define factories()
        if (method_exists(Dealer::class, 'factories')) {
            $dealers->each(function (Dealer $dealer) use ($plants) {
                // Attach dealer to 1–2 random factories
                $dealer->factories()->sync(
                    $plants->random(rand(1, 2))->pluck('id')->toArray()
                );
            });
        }

        // 7) Create example reviews for the first regular user
        $anyUser = $users->first();
        $anyCars = Car::inRandomOrder()->take(3)->get();

        foreach ($anyCars as $car) {
            Review::create([
                'user_id' => $anyUser->id,
                'car_id'  => $car->id,
                'rating'  => rand(3, 5),
                'comment' => 'Great car!',
            ]);
        }
    }
}
