@extends('layouts.app')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 60vh;">
    <div class="card card-glow px-4 py-4 text-center" style="max-width: 480px;">
        <h1 class="display-5 mb-3">
            <i class="bi bi-shield-lock me-2"></i>403
        </h1>
        <h2 class="h4 mb-3">Access denied</h2>
        <p class="text-secondary mb-4">
            {{ $exception->getMessage() ?: 'You do not have permission to access this page.' }}
        </p>

        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="bi bi-house-door me-1"></i> Back to dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </a>
        @endauth
    </div>
</div>
@endsection