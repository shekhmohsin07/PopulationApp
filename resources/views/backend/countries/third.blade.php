@extends('backend.layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Update 3rd Country</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('countries.updateThird') }}">
        @csrf

        <div class="mb-4">
            <label>Country</label>
            <input type="text" class="form-control" value="{{ $country->country }}" disabled>
        </div>

        <div class="mb-4">
            <label for="population">Population</label>
            <input type="number" name="population" class="form-control"
                   value="{{ $country->population }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update (Round to Million)</button>
    </form>
@endsection
