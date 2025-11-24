<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AutoHub</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Bootstrap & Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body{ background: #0f172a; } /* slate-900 */
    .navbar{ background: linear-gradient(90deg,#0d6efd,#6f42c1); }
    .nav-link.active{ font-weight:700; text-decoration:underline; text-underline-offset:6px; }
    .card-glow{ border:0; border-radius:16px; box-shadow:0 10px 24px rgba(0,0,0,.25); }
    .card-glow .card-header{ border:0; background: transparent; font-weight:700; }
    .ah-container{ max-width:1080px; }
    .badge-soft{ background:rgba(13,110,253,.1); color:#9ec5fe; border:1px solid rgba(13,110,253,.2) }
    .table > :not(caption) > * > * { background: #121a34; color:#e2e8f0; }
    .table-hover tbody tr:hover{ background:#151f3f; }
    .dash-icon {
    width: 56px;
    height: 56px;
    object-fit: contain;
    display: block;
  }
    .form-control, .form-select, .form-control:focus, .form-select:focus{
      background:#0b1328; color:#e2e8f0; border-color:#1f2a4a;
    }
    .btn{ border-radius:10px; }
    footer{ background:#0b1022 }
  </style>
</head>
<body class="font-sans antialiased text-light">

<nav class="navbar navbar-expand-lg navbar-dark mb-4">
  <div class="container ah-container">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}"><i class="bi bi-speedometer2 me-2"></i>AutoHub</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-house-door me-1"></i>Home</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('cars*') ? 'active' : '' }}" href="{{ route('cars.index') }}"><i class="bi bi-car-front me-1"></i>Cars</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('factories*') ? 'active' : '' }}" href="{{ route('factories.index') }}"><i class="bi bi-building-gear me-1"></i>Factories</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('dealers*') ? 'active' : '' }}" href="{{ route('dealers.index') }}"><i class="bi bi-people me-1"></i>Dealers</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('reviews*') ? 'active' : '' }}" href="{{ route('reviews.index') }}"><i class="bi bi-chat-left-star me-1"></i>Reviews</a></li>

        @auth
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}"><i class="bi bi-person-gear me-1"></i>Profile</a></li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button class="btn btn-link nav-link text-white"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
            </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<main class="container ah-container mb-5">

  {{-- Flash --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
      <i class="bi bi-exclamation-triangle me-1"></i>{{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
      <strong>⚠️ Please fix the following errors:</strong>
      <ul class="mb-0 mt-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @yield('content')
</main>

<footer class="text-light text-center py-3 mt-auto">
  <p class="mb-0">© {{ date('Y') }} AutoHub — All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>