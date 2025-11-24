@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3"><i class="bi bi-pencil-square me-2"></i>Edit Review #{{ $review->id }}</h1>

<div class="card card-glow">
  <div class="card-body">
    <form method="POST" action="{{ route('reviews.update',$review) }}">
      @csrf @method('PUT')

      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Rating (1–5)</label>
          <input type="number" name="rating" min="1" max="5" class="form-control" value="{{ $review->rating }}" required>
        </div>
        <div class="col-12">
          <label class="form-label">Comment</label>
          <textarea name="comment" class="form-control" rows="4">{{ $review->comment }}</textarea>
        </div>
      </div>

      <div class="mt-3">
        <button class="btn btn-primary"><i class="bi bi-save me-1"></i>Save</button>
        <a href="{{ route('reviews.show',$review) }}" class="btn btn-outline-secondary">Back</a>
      </div>
    </form>
  </div>
</div>
@endsection