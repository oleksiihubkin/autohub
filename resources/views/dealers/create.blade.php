@extends('layouts.app')

@section('content')
    <h1>Add Dealer</h1>

    <form action="{{ route('dealers.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('dealers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
