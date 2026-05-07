@extends('backend.layouts.app')

@section('content')


    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <h2>Countries</h2>
    <a href="{{ route('countries.create') }}" class="btn btn-primary mb-3">Add New Country</a>
    <a href="?sort=population" class="btn btn-secondary mb-3">Sort by Population</a>
    <a href="?sort=alphabet" class="btn btn-secondary mb-3">Sort A–Z</a>
    <a href="{{ route('countries.editThird') }}" class="btn btn-secondary mb-3">
        Update 3rd Country
    </a>


    @php use Illuminate\Support\Number; @endphp

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Country</th>
                <th>Population</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($countries as $country)
            <tr>
                <td>{{ $country->country }}</td>
                <td>{{ Number::forHumans($country->population) }}</td>
                <td>
                    <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('countries.destroy', $country->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure you want to delete {{ $country->country }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if ($countries->hasPages())
        <div class="mt-4">
            <nav class="inline-flex -space-x-px rounded-md" aria-label="Pagination">
                {{-- Previous Page Link --}}
                @if ($countries->onFirstPage())
                    <span class="px-3 py-2 ml-0 leading-tight text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md">
                        ‹
                    </span>
                @else
                    <a href="{{ $countries->previousPageUrl() }}" class="px-3 py-2 ml-0 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 rounded-l-md">
                        ‹
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($countries->getUrlRange(1, $countries->lastPage()) as $page => $url)
                    @if ($page == $countries->currentPage())
                        <span class="px-3 py-2 leading-tight text-gray bg-blue-600 border border-gray-300">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($countries->hasMorePages())
                    <a href="{{ $countries->nextPageUrl() }}" class="px-3 py-2 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 rounded-r-md">
                        ›
                    </a>
                @else
                    <span class="px-3 py-2 leading-tight text-gray bg-white border border-gray-300 cursor-default rounded-r-md">
                        ›
                    </span>
                @endif
            </nav>
        </div>
    @endif
@endsection