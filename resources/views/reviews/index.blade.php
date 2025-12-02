@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 m-0"><i class="bi bi-chat-left-star me-2"></i>Reviews</h1>
  @auth
    <a href="{{ route('reviews.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>New Review</a>
  @endauth
</div>

<div class="d-grid gap-3">
@foreach ($reviews as $review)
  <div class="card card-glow">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <div>
          <div class="h5 mb-1">{{ $review->car->make ?? '' }} {{ $review->car->model ?? '' }}</div>
          <span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i>{{ $review->rating }}/5</span>
          <span class="ms-2 text-secondary small">by {{ $review->user->name ?? 'Unknown' }}</span>
        </div>
        <div>
          <a href="{{ route('reviews.show', $review) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
          @can('update',$review)
            <a href="{{ route('reviews.edit', $review) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
          @endcan
          @can('delete',$review)
            <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete review?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          @endcan
        </div>
      </div>
      @if($review->comment)
        <p class="mt-3 mb-0">{{ \Illuminate\Support\Str::limit($review->comment, 200) }}</p>
      @endif
    </div>
  </div>
@endforeach
</div>

<div class="mt-3">{{ $reviews->links() }}</div>
@endsection