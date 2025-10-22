@extends('layouts.layout')

@section('content')
    <h1>Edit Factory</h1>

    <form action="{{ route('factories.update', $factory->id) }}" method="POST" class="mt-3">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ $factory->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input name="location" class="form-control" value="{{ $factory->location }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('factories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
