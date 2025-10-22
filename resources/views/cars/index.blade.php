@extends('layouts.app')

@section('content')
    <h1>Cars</h1>

    <a href="{{ route('cars.create') }}" class="btn btn-primary">➕ Add a New Car</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Color</th>
            <th>Price</th>
            <th>Factory</th>
            <th>Actions</th>
        </tr>
        @foreach($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->make }}</td>
                <td>{{ $car->model }}</td>
                <td>{{ $car->year }}</td>
                <td>{{ $car->color }}</td>
                <td>{{ $car->price }}</td>
                <td>{{ $car->factory->name }}</td>
                <td>
                    <a href="{{ route('cars.show', $car->id) }}">View</a> |
                    <a href="{{ route('cars.edit', $car->id) }}">Edit</a> |
                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
