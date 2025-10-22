@extends('layouts.layout')

@section('content')
    <h1>Add New Car</h1>

    <form action="{{ route('cars.store') }}" method="POST">
        @csrf
        <label>Make:</label>
        <input type="text" name="make" required><br><br>

        <label>Model:</label>
        <input type="text" name="model" required><br><br>

        <label>Year:</label>
        <input type="number" name="year" required><br><br>

        <label>Color:</label>
        <input type="text" name="color" required><br><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" required><br><br>

        <label>Factory:</label>
        <select name="factory_id" required>
            @foreach($factories as $factory)
                <option value="{{ $factory->id }}">{{ $factory->name }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Save</button>
    </form>
@endsection
