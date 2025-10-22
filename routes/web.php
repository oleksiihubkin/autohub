<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\DealerController;

// Resource routes for main entities
Route::resource('cars', CarController::class)->middleware('auth');
Route::resource('factories', FactoryController::class)->middleware('auth');
Route::post('/factories/{factory}/assign-dealers', [FactoryController::class, 'assignDealers'])
    ->name('factories.assignDealers')
    ->middleware('auth');
Route::resource('dealers', DealerController::class)->middleware('auth');

// Home page
Route::get('/', function () {
    return view('welcome');
});

use App\Models\Car;
use App\Models\Factory;
use App\Models\Dealer;

// Dashboard with summary statistics
Route::get('/dashboard', function () {
    $carsCount = Car::count();
    $factoriesCount = Factory::count();
    $dealersCount = Dealer::count();

    return view('dashboard', compact('carsCount', 'factoriesCount', 'dealersCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile management routes (only for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__.'/auth.php';
