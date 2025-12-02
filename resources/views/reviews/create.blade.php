@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3"><i class="bi bi-plus-circle me-2"></i>New Review</h1>

<div class="card card-glow">
  <div class="card-body">
    <form method="POST" action="{{ route('reviews.store') }}">
      @csrf
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Car</label>
          <select name="car_id" class="form-select" required>
            @foreach($cars as $car)
              <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }} (#{{ $car->id }})</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Rating (1–5)</label>
          <input type="number" name="rating" min="1" max="5" class="form-control" required>
        </div>
        <div class="col-12">
          <label class="form-label">Comment</label>
          <textarea name="comment" class="form-control" rows="4" placeholder="Share your experience..."></textarea>
        </div>
      </div>
      <div class="mt-3">
        <button class="btn btn-primary"><i class="bi bi-check2-circle me-1"></i>Create</button>
        <a href="{{ route('reviews.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection