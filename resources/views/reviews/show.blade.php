@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 m-0"><i class="bi bi-chat-left-quote me-2"></i>Review #{{ $review->id }}</h1>
  <div>
    @can('update',$review)
      <a class="btn btn-warning btn-sm" href="{{ route('reviews.edit',$review) }}"><i class="bi bi-pencil"></i> Edit</a>
    @endcan
    @can('delete',$review)
      <form class="d-inline" action="{{ route('reviews.destroy',$review) }}" method="POST" onsubmit="return confirm('Delete review?')">
        @csrf @method('DELETE')
        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</button>
      </form>
    @endcan
  </div>
</div>

<div class="card card-glow">
  <div class="card-body">
    <p class="mb-2"><strong>Car:</strong> {{ $review->car->make ?? '' }} {{ $review->car->model ?? '' }}</p>
    <p class="mb-2"><strong>Rating:</strong> <span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i>{{ $review->rating }}/5</span></p>
    <p class="mb-2"><strong>By:</strong> {{ $review->user->name }}</p>
    @if($review->comment)
      <hr class="border-secondary">
      <p class="mb-0">{{ $review->comment }}</p>
    @endif
  </div>
</div>
@endsection