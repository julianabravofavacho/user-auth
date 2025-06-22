<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- Navbar estilizada --}}
    <nav class="navbar bg-body-tertiary navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
        <div class="container">
            {{-- Logo com ícone redondo --}}
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('dashboard') }}">
                <div class="bg-dark text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 35px; height: 35px;">
                    B
                </div>
                <span>{{ config('app.name', 'Laravel') }}</span>
            </a>

            {{-- Toggle para mobile --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                {{-- Abas da aplicação --}}
                <ul class="navbar-nav me-auto ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'fw-bold text-dark' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                </ul>

                {{-- Menu do usuário autenticado --}}
                @auth
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @if (isset($header))
        <div class="bg-light p-3 mb-4 shadow-sm rounded">
            <h2 class="mb-0">{{ $header }}</h2>
        </div>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>