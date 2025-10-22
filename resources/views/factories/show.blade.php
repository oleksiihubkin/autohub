@extends('layouts.layout')

@section('content')
    <h1>Factory Details</h1>

    <p><strong>ID:</strong> {{ $factory->id }}</p>
    <p><strong>Name:</strong> {{ $factory->name }}</p>
    <p><strong>Location:</strong> {{ $factory->location }}</p>

    <hr>
    <h4>Cars produced by this factory</h4>
    <ul>
        @forelse($factory->cars as $car)
            <li>{{ $car->make }} {{ $car->model }} ({{ $car->year }})</li>
        @empty
            <li>No cars yet.</li>
        @endforelse
    </ul>
    {{-- 🔹 Assign Dealers Section --}}
    <hr>
    <h4>Dealers associated with this factory</h4>

    {{-- Show current dealers --}}
    @if($factory->dealers->count() > 0)
        <ul>
            @foreach($factory->dealers as $dealer)
                <li>{{ $dealer->name }}</li>
            @endforeach
        </ul>
    @else
        <p>No dealers assigned yet.</p>
    @endif

    {{-- Form to assign dealers --}}
    <form action="{{ route('factories.assignDealers', $factory->id) }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label for="dealer_ids" class="form-label">Select Dealers</label>
            <select name="dealer_ids[]" id="dealer_ids" class="form-select" multiple>
                @foreach(\App\Models\Dealer::all() as $dealer)
                    <option value="{{ $dealer->id }}"
                        {{ $factory->dealers->contains($dealer->id) ? 'selected' : '' }}>
                        {{ $dealer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Dealers</button>
    </form>

    <a href="{{ route('factories.index') }}" class="btn btn-secondary">⬅ Back</a>
@endsection
