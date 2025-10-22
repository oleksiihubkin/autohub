@extends('layouts.app')

@section('content')
    <h1>Dealers</h1>

    <a href="{{ route('dealers.create') }}">➕ Add a New Dealer</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        @foreach($dealers as $dealer)
            <tr>
                <td>{{ $dealer->id }}</td>
                <td>{{ $dealer->name }}</td>
                <td>{{ $dealer->phone }}</td>
                <td>{{ $dealer->email }}</td>
                <td>
                    <a href="{{ route('dealers.show', $dealer->id) }}">View</a> |
                    <a href="{{ route('dealers.edit', $dealer->id) }}">Edit</a> |
                    <form action="{{ route('dealers.destroy', $dealer->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
