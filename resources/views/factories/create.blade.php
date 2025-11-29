@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3"><i class="bi bi-building-add me-2"></i>Add Factory</h1>

<div class="card card-glow">
  <div class="card-body">
    <form method="POST" action="{{ route('factories.store') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Location</label>
        <input name="location" class="form-control" required>
      </div>
      <button class="btn btn-primary">Save</button>
      <a href="{{ route('factories.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection