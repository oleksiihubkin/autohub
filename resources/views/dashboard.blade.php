@extends('layouts.app')

@section('content')
  <div class="card card-glow mb-4">
    <div class="card-body p-4">
      <h1 class="h3 mb-2"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h1>
      <p class="text-secondary mb-0">Quick overview of your AutoHub data.</p>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-md-4">
      <div class="card card-glow">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <div class="text-secondary small">Factories</div>
            <div class="h3 mb-0">{{ $factoriesCount }}</div>
          </div>
          <div class="display-6 text-primary"><i class="bi bi-building-gear"></i></div>
        </div>
        <div class="card-footer bg-transparent border-0">
          <a href="{{ route('factories.index') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-eye me-1"></i>View</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-glow">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <div class="text-secondary small">Cars</div>
            <div class="h3 mb-0">{{ $carsCount }}</div>
          </div>
          <div class="display-6 text-info"><i class="bi bi-car-front"></i></div>
        </div>
        <div class="card-footer bg-transparent border-0">
          <a href="{{ route('cars.index') }}" class="btn btn-outline-info btn-sm"><i class="bi bi-eye me-1"></i>View</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-glow">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <div class="text-secondary small">Dealers</div>
            <div class="h3 mb-0">{{ $dealersCount }}</div>
          </div>
          <div class="display-6 text-warning"><i class="bi bi-people"></i></div>
        </div>
        <div class="card-footer bg-transparent border-0">
          <a href="{{ route('dealers.index') }}" class="btn btn-outline-warning btn-sm"><i class="bi bi-eye me-1"></i>View</a>
        </div>
      </div>
    </div>
  </div>
@endsection