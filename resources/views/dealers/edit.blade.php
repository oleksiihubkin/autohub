@extends('layouts.app')

@section('content')
    <h1>Edit Dealer</h1>
    {{-- Flash messages --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Validation errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('dealers.update', $dealer->id) }}" method="POST" class="mt-3">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ $dealer->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input name="phone" class="form-control" value="{{ $dealer->phone }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" value="{{ $dealer->email }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('dealers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
