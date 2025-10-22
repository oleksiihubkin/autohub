@extends('layouts.app')

@section('content')
    <h1>Factories</h1>

    <a href="{{ route('factories.create') }}">➕ Add a New Factory</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
        @foreach($factories as $factory)
            <tr>
                <td>{{ $factory->id }}</td>
                <td>{{ $factory->name }}</td>
                <td>{{ $factory->location }}</td>
                <td>
                    <a href="{{ route('factories.show', $factory->id) }}">View</a> |
                    <a href="{{ route('factories.edit', $factory->id) }}">Edit</a> |
                    <form action="{{ route('factories.destroy', $factory->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
