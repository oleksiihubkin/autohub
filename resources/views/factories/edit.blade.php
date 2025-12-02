@extends('layouts.app')

@section('content')
    <h1>Edit Factory</h1>

    <form action="{{ route('factories.update', $factory->id) }}" method="POST" class="mt-3">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ $factory->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input name="location" class="form-control" value="{{ $factory->location }}" required>
        </div>

        {{-- New: Dealer selection --}}
        <div class="mb-3">
            <label class="form-label">Dealers</label>
            <select name="dealers[]" class="form-select" multiple>
                @foreach($dealers as $dealer)
                    <option value="{{ $dealer->id }}" 
                        {{ $factory->dealers->contains($dealer->id) ? 'selected' : '' }}>
                        {{ $dealer->name }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Hold Ctrl (or Cmd on Mac) to select multiple dealers</small>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('factories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

