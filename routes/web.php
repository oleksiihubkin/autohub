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
| Home page
| Public landing page of the application.
*/
Route::get('/', function () {
    return view('welcome');
});

/*
| Auth-only routes (profile + CRUD)
| These routes require the user to be authenticated.
| Admin permissions are checked inside controllers when needed.
*/
Route::middleware('auth')->group(function () {

    // User profile management
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // Reviews — authenticated users can create/edit/delete
    // Index + show remain public (defined below)
    Route::resource('reviews', ReviewController::class)->except(['index', 'show']);

    // Cars / Factories / Dealers — CRUD except public listing/show
    Route::resource('cars', CarController::class)->except(['index', 'show']);
    Route::resource('factories', FactoryController::class)->except(['index', 'show']);
    Route::resource('dealers', DealerController::class)->except(['index', 'show']);

    // Assign dealers to a factory (admin check is inside the controller)
    Route::post(
        '/factories/{factory}/assign-dealers',
        [FactoryController::class, 'assignDealers']
    )->name('factories.assignDealers');
});

/*
| Public resources (index + show)
| Must appear AFTER the auth-group to avoid route conflicts such as:
| /factories/create being interpreted as /factories/{factory}.
|
| These routes allow guests to browse cars, factories, dealers, reviews.
*/
Route::resource('cars', CarController::class)->only(['index', 'show']);
Route::resource('factories', FactoryController::class)->only(['index', 'show']);
Route::resource('dealers', DealerController::class)->only(['index', 'show']);
Route::resource('reviews', ReviewController::class)->only(['index', 'show']);

/*
| Dashboard (auth + verified)
| Simple dashboard that displays basic statistics.
*/
Route::get('/dashboard', function () {
    $carsCount      = Car::count();
    $factoriesCount = Factory::count();
    $dealersCount   = Dealer::count();

    return view('dashboard', compact('carsCount', 'factoriesCount', 'dealersCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

/*
| Authentication scaffolding (login, register, etc.)
*/
require __DIR__.'/auth.php';
