@extends('layouts.app')

@section('content')
    <h1>Add Factory</h1>

    <form action="{{ route('factories.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input name="location" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('factories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
