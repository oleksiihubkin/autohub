<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Factory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;


class CarController extends Controller
{
    // Show all cars
    public function index()
{
    $cars = Car::with('factory')->orderBy('id','desc')->paginate(10);
    return view('cars.index', compact('cars'));
}

    // Show create form
    public function create()
    {
        $factories = Factory::all();
        return view('cars.create', compact('factories'));
    }

    // Save new car
    public function store(StoreCarRequest $request)
{
    Car::create($request->validated());
    return redirect()->route('cars.index')->with('success', 'Car created successfully.');
}

    // Show single car
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    // Show edit form
    public function edit(Car $car)
    {
        $factories = Factory::all();
        return view('cars.edit', compact('car', 'factories'));
    }

    // Update car
    public function update(UpdateCarRequest $request, Car $car)
{
    $car->update($request->validated());
    return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
}

    // Delete car
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
