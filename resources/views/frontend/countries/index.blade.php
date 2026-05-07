@extends('frontend.layouts.app')

@section('content')

    <div class="row mb-4 justify-content-between align-items-center">
        <div class="col-md-3">
            <h3 class="fw-bold text-secondary">Countries:</h3>
        </div>

        <div class="col-md-9 d-flex justify-content-end gap-2 flex-wrap">
            <a href="{{ route('home', ['sort' => 'population']) }}" 
            class="btn {{ request('sort') === 'population' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                Sort by Population
            </a>

            <a href="{{ route('home', ['sort' => 'alphabet']) }}" 
            class="btn {{ request('sort') === 'alphabet' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                Sort A–Z
            </a>
        </div>
    </div>


    
    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Country</th>
                <th>Population</th>
                
            </tr>
        </thead>
        <tbody>
        @foreach ($countries as $country)
            <tr>
                <td>{{ $country->country }}</td>
                <td>{{ Illuminate\Support\Number::forHumans($country->population) }}</td>
                
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