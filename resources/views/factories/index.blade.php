@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">
        <i class="bi bi-building-gear me-2"></i>Factories
    </h1>

    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('factories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Factory
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
                <th>Name</th>
                <th>Location</th>
                <th>Cars</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($factories as $factory)
                <tr>
                    <td>{{ $factory->id }}</td>
                    <td>{{ $factory->name }}</td>
                    <td>{{ $factory->location }}</td>
                    <td>{{ $factory->cars_count ?? $factory->cars->count() }}</td>

                    <td class="text-end">
                        {{-- View доступен всем --}}
                        <a class="btn btn-sm btn-outline-secondary"
                           href="{{ route('factories.show', $factory->id) }}">
                            <i class="bi bi-eye"></i>
                        </a>

                        @auth
                            @if(auth()->user()->isAdmin())
                                <a class="btn btn-sm btn-outline-warning"
                                   href="{{ route('factories.edit', $factory->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('factories.destroy', $factory->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this factory?')">
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

@if(method_exists($factories, 'links'))
    <div class="mt-3">
        {{ $factories->links() }}
    </div>
@endif
@endsection