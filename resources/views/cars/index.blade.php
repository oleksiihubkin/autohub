@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0"><i class="bi bi-car-front me-2"></i>Cars</h1>

    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('cars.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Car
            </a>
        @endif
    @endauth
</div>

<div class="card card-glow">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Factory</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->make }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->year }}</td>
                        <td>{{ $car->color }}</td>
                        <td>€ {{ number_format($car->price, 2) }}</td>
                        <td>{{ $car->factory->name ?? '-' }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary"
                               href="{{ route('cars.show',$car->id) }}">
                                <i class="bi bi-eye"></i>
                            </a>

                            @auth
                                @if(auth()->user()->isAdmin())
                                    <a class="btn btn-sm btn-outline-warning"
                                       href="{{ route('cars.edit',$car->id) }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('cars.destroy',$car->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this car?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            @endauth

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $cars->links() }}
</div>
@endsection