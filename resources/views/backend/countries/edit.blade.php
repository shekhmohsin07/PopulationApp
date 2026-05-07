@extends('backend.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Country</h2>

    <form action="{{ route('countries.update', $country->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="country" class="form-label">Country Name</label>
            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $country->country) }}" required>
            @error('country')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="population" class="form-label">Population</label>
            <input type="number" name="population" id="population" class="form-control" value="{{ old('population', $country->population) }}" required>
            @error('population')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('countries.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
