@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Factory Details</h1>

    <div class="card card-glow mb-3">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $factory->id }}</p>
            <p><strong>Name:</strong> {{ $factory->name }}</p>
            <p><strong>Location:</strong> {{ $factory->location }}</p>
        </div>
    </div>

    <div class="card card-glow mb-3">
        <div class="card-body">
            <h4 class="h5">Cars produced by this factory</h4>
            <ul class="mt-2 mb-0">
                @forelse($factory->cars as $car)
                    <li>{{ $car->make }} {{ $car->model }} ({{ $car->year }})</li>
                @empty
                    <li>No cars yet.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="card card-glow mb-3">
        <div class="card-body">
            <h4 class="h5">Dealers associated with this factory</h4>

            {{-- список дилеров виден всем --}}
            @if($factory->dealers->count() > 0)
                <ul class="mt-2">
                    @foreach($factory->dealers as $dealer)
                        <li>{{ $dealer->name }}</li>
                    @endforeach
                </ul>
            @else
                <p class="mt-2 mb-0">No dealers assigned yet.</p>
            @endif

            {{-- 👇 форму изменения дилеров показываем ТОЛЬКО админу --}}
            @auth
                @if(auth()->user()->isAdmin())
                    <hr class="border-secondary">

                    <h5 class="h6 mb-2">Select Dealers</h5>
                    <form action="{{ route('factories.assignDealers', $factory->id) }}" method="POST" class="mt-2">
                        @csrf
                        <div class="mb-3">
                            <select name="dealer_ids[]" id="dealer_ids" class="form-select" multiple>
                                @foreach(\App\Models\Dealer::all() as $dealer)
                                    <option value="{{ $dealer->id }}"
                                        {{ $factory->dealers->contains($dealer->id) ? 'selected' : '' }}>
                                        {{ $dealer->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">
                                Hold Ctrl (Cmd on Mac) to select multiple dealers.
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Dealers</button>
                    </form>
                @endif
            @endauth
        </div>
    </div>

    <a href="{{ route('factories.index') }}" class="btn btn-outline-secondary">
        ⬅ Back
    </a>
@endsection