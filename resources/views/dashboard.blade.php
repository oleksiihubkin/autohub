@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="mb-5 fw-bold">📊 Dashboard</h1>

    <div class="row justify-content-center">
        <!-- Factories -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">🏭 Factories</h5>
                    <p class="display-6 fw-bold text-primary">{{ $factoriesCount }}</p>
                    <a href="{{ route('factories.index') }}" class="btn btn-outline-primary">View</a>
                </div>
            </div>
        </div>

        <!-- Cars -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">🚗 Cars</h5>
                    <p class="display-6 fw-bold text-success">{{ $carsCount }}</p>
                    <a href="{{ route('cars.index') }}" class="btn btn-outline-success">View</a>
                </div>
            </div>
        </div>

        <!-- Dealers -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">🤝 Dealers</h5>
                    <p class="display-6 fw-bold text-warning">{{ $dealersCount }}</p>
                    <a href="{{ route('dealers.index') }}" class="btn btn-outline-warning">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

