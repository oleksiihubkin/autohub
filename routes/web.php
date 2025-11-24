<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\ReviewController;

use App\Models\Car;
use App\Models\Factory;
use App\Models\Dealer;

/*
|--------------------------------------------------------------------------
| Public pages
|--------------------------------------------------------------------------
*/

// Главная (welcome-страница)
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Публичные ресурсы (index + show)
|--------------------------------------------------------------------------
|
| Эти маршруты доступны всем (гости и залогиненные).
|
*/

// Cars — только список и просмотр
Route::resource('cars', CarController::class)->only(['index', 'show']);

// Factories — только список и просмотр
Route::resource('factories', FactoryController::class)->only(['index', 'show']);

// Dealers — только список и просмотр
Route::resource('dealers', DealerController::class)->only(['index', 'show']);

// Reviews — только список и просмотр
Route::resource('reviews', ReviewController::class)->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| Dashboard (auth + verified)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $carsCount      = Car::count();
    $factoriesCount = Factory::count();
    $dealersCount   = Dealer::count();

    return view('dashboard', compact('carsCount', 'factoriesCount', 'dealersCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile + Reviews CRUD (auth)
|--------------------------------------------------------------------------
|
| Тут всё, что требуется просто залогиненного пользователя.
|
*/

Route::middleware('auth')->group(function () {
    // Профиль
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // Reviews — create/store/edit/update/destroy
    // index/show уже объявлены выше, поэтому тут исключаем
    Route::resource('reviews', ReviewController::class)->except(['index', 'show']);
});

/*
|--------------------------------------------------------------------------
| Admin-only CRUD (auth + admin)
|--------------------------------------------------------------------------
|
| Полные CRUD для Cars/Factories/Dealers — только для админа.
| index/show остаются публичные (см. выше).
|
*/

Route::middleware(['auth', 'admin'])->group(function () {
    // Cars — полный CRUD кроме index/show (они уже есть)
    Route::resource('cars', CarController::class)->except(['index', 'show']);

    // Factories — полный CRUD кроме index/show
    Route::resource('factories', FactoryController::class)->except(['index', 'show']);

    // Dealers — полный CRUD кроме index/show
    Route::resource('dealers', DealerController::class)->except(['index', 'show']);

    // Привязка дилеров к фабрикам (если есть такой метод)
    Route::post(
        '/factories/{factory}/assign-dealers',
        [FactoryController::class, 'assignDealers']
    )->name('factories.assignDealers');
});

/*
|--------------------------------------------------------------------------
| Auth scaffolding
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';