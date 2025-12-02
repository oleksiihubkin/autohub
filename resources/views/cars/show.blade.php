@extends('layouts.app')

@section('content')
    <h1>Car Details</h1>

    <p><strong>ID:</strong> {{ $car->id }}</p>
    <p><strong>Make:</strong> {{ $car->make }}</p>
    <p><strong>Model:</strong> {{ $car->model }}</p>
    <p><strong>Year:</strong> {{ $car->year }}</p>
    <p><strong>Color:</strong> {{ $car->color }}</p>
    <p><strong>Price:</strong> {{ $car->price }}</p>
    <p><strong>Factory:</strong> {{ $car->factory->name }}</p>

    <a href="{{ route('cars.index') }}">⬅ Back to List</a>
@endsection
