@extends('layouts.app')

@section('content')
    <h1>Edit Car</h1>

    <form action="{{ route('cars.update', $car->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Make:</label>
        <input type="text" name="make" value="{{ $car->make }}" required><br><br>

        <label>Model:</label>
        <input type="text" name="model" value="{{ $car->model }}" required><br><br>

        <label>Year:</label>
        <input type="number" name="year" value="{{ $car->year }}" required><br><br>

        <label>Color:</label>
        <input type="text" name="color" value="{{ $car->color }}" required><br><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="{{ $car->price }}" required><br><br>

        <label>Factory:</label>
        <select name="factory_id" required>
            @foreach($factories as $factory)
                <option value="{{ $factory->id }}" {{ $car->factory_id == $factory->id ? 'selected' : '' }}>
                    {{ $factory->name }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Update</button>
    </form>
@endsection
