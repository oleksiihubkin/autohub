@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0"><i class="bi bi-people me-2"></i>Dealers</h1>

    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('dealers.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Dealer
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
                    <th>Phone</th>
                    <th>Email</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dealers as $dealer)
                    <tr>
                        <td>{{ $dealer->id }}</td>
                        <td>{{ $dealer->name }}</td>
                        <td>{{ $dealer->phone }}</td>
                        <td>{{ $dealer->email }}</td>
                        <td class="text-end">

                            <a class="btn btn-sm btn-outline-secondary"
                               href="{{ route('dealers.show',$dealer->id) }}">
                                <i class="bi bi-eye"></i>
                            </a>

                            @auth
                                @if(auth()->user()->isAdmin())
                                    <a class="btn btn-sm btn-outline-warning"
                                       href="{{ route('dealers.edit',$dealer->id) }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('dealers.destroy',$dealer->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this dealer?')">
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
@endsection