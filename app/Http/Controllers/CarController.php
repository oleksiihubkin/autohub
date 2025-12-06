<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Factory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

/**
 * Controller responsible for managing CRUD operations for Cars.
 * All create/update actions use Form Request validation for security.
 */
class CarController extends Controller
{
    /**
     * Display a paginated list of all cars.
     * Cars are loaded together with their related Factory using eager loading.
     */
    public function index()
    {
        $cars = Car::with('factory')->orderBy('id', 'desc')->paginate(10);
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new car.
     * Factories are loaded so the user can assign the car to a factory.
     */
    public function create()
    {
        $factories = Factory::all();
        return view('cars.create', compact('factories'));
    }

    /**
     * Store a newly created car in the database.
     * Uses StoreCarRequest for validation.
     */
    public function store(StoreCarRequest $request)
    {
        Car::create($request->validated());
        return redirect()
            ->route('cars.index')
            ->with('success', 'Car created successfully.');
    }

    /**
     * Display the details of a single car.
     */
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing an existing car.
     * Loads all factories so the factory assignment can be changed.
     */
    public function edit(Car $car)
    {
        $factories = Factory::all();
        return view('cars.edit', compact('car', 'factories'));
    }

    /**
     * Update an existing car in the database.
     * Uses UpdateCarRequest for validation.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->validated());
        return redirect()
            ->route('cars.index')
            ->with('success', 'Car updated successfully.');
    }

    /**
     * Remove a car from the database.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()
            ->route('cars.index')
            ->with('success', 'Car deleted successfully.');
    }
}