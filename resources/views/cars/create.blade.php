@extends('layouts.app')

@section('content')
    <h1>Add New Car</h1>

    <form action="{{ route('cars.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label class="form-label">Make:</label>
            <input type="text" name="make" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Model:</label>
            <input type="text" name="model" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Year:</label>
            <input type="number" name="year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Color:</label>
            <input type="text" name="color" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (€):</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Factory:</label>
            <select name="factory_id" class="form-select" required>
                @foreach($factories as $factory)
                    <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success"> Save</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
