<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Project Loop App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="{{ route('countries.index') }}">🌍 Project Loop</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a 
                          class="nav-link {{ request()->routeIs('home') && !request()->has('sort') ? 'active' : '' }}" 
                          href="{{ route('home') }}">
                          Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a 
                          class="nav-link {{ request()->routeIs('countries.index') && !request()->has('sort') ? 'active' : '' }}" 
                          href="{{ route('countries.index') }}">
                          Countries
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a 
                          class="nav-link {{ request()->routeIs('countries.index') && request('sort') === 'population' ? 'active' : '' }}" 
                          href="{{ route('countries.index', ['sort' => 'population']) }}">
                          Sort by Population
                        </a>
                    </li>
                </ul>

                @auth
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
