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
| Home page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Auth-only routes (profile + CRUD)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // Reviews CRUD (index/show are public below)
    Route::resource('reviews', ReviewController::class)->except(['index', 'show']);

    // Cars / Factories / Dealers CRUD (index/show are public below)
    Route::resource('cars', CarController::class)->except(['index', 'show']);
    Route::resource('factories', FactoryController::class)->except(['index', 'show']);
    Route::resource('dealers', DealerController::class)->except(['index', 'show']);

    // Assign dealers to factory (admin logic проверяем в контроллере)
    Route::post(
        '/factories/{factory}/assign-dealers',
        [FactoryController::class, 'assignDealers']
    )->name('factories.assignDealers');
});

/*
|--------------------------------------------------------------------------
| Public resources (index + show)
| !!! They must go AFTER auth group so that /factories/create
|     не перехватывался маршрутом /factories/{factory}.
|--------------------------------------------------------------------------
*/
Route::resource('cars', CarController::class)->only(['index', 'show']);
Route::resource('factories', FactoryController::class)->only(['index', 'show']);
Route::resource('dealers', DealerController::class)->only(['index', 'show']);
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
| Auth scaffolding
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';