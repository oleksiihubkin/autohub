@extends('layouts.app')

@section('content')
    <h1>Dealer Details</h1>

    <p><strong>ID:</strong> {{ $dealer->id }}</p>
    <p><strong>Name:</strong> {{ $dealer->name }}</p>
    <p><strong>Phone:</strong> {{ $dealer->phone }}</p>
    <p><strong>Email:</strong> {{ $dealer->email }}</p>

    <hr>
    <h4>Factories working with this dealer</h4>
    <ul>
        @forelse($dealer->factories as $factory)
            <li>{{ $factory->name }} — {{ $factory->location }}</li>
        @empty
            <li>No factories assigned yet.</li>
        @endforelse
    </ul>

    <a href="{{ route('dealers.index') }}" class="btn btn-secondary">⬅ Back</a>
@endsection
