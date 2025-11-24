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
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) Админ
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // 2) Обычные пользователи
        $users = User::factory(3)->create(['role' => 'user']);

        // 3) Фабрики (plants)
        $plants = Factory::factory(3)->create();

        // 4) Машины, привязанные к фабрикам
        $plants->each(function (\App\Models\Factory $plant) {
    CarFactory::new()
        ->count(3)
        ->create([
            'factory_id' => $plant->id,
        ]);
});

        // 5) Дилеры
        $dealers = Dealer::factory(5)->create();

        // 6) Привязка дилеров к фабрикам (many-to-many), если есть связь factories()
        // Закомментируй, если у модели Dealer нет связи factories()
        if (method_exists(Dealer::class, 'factories')) {
            $dealers->each(function (Dealer $dealer) use ($plants) {
                // привяжем к 1–2 случайным фабрикам
                $dealer->factories()->sync(
                    $plants->random(rand(1, 2))->pluck('id')->toArray()
                );
            });
        }

        // 7) Пример отзывов: для первого пользователя создадим по отзыву на несколько машин
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