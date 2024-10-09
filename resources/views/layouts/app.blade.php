<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Cozyran', 'Cozyran') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=YourChosenFont&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(90deg, rgba(233, 225, 215, 1) 0%, rgba(230, 230, 230, 1) 41%, rgba(159, 155, 161, 1) 100%);
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: #333;
        }

        .nav-link {
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #000;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            background-color: black;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link:focus::after,
        .nav-link.active::after {
            transform: scaleX(1);
        }

        .dropdown-item {
            transition: background-color 0.3s;
        }

        .dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        main {
            padding: 2rem;
        }

        footer {
            text-align: center;
            padding: 1rem 0;
            background-color: #f8f9fa;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    {{ config('Cozy_ran', 'Cozy_ran') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="{{ route('products.home') }}" class="nav-link {{ request()->routeIs('products.home') ? 'active' : '' }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}">{{ __('Manage Products') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.categories.index') }}" class="nav-link {{ request()->routeIs('products.categories.index') ? 'active' : '' }}">{{ __('Manage Categories') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.supplier.index') }}" class="nav-link {{ request()->routeIs('products.supplier.index') ? 'active' : '' }}">{{ __('Manage Suppliers') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.users.index') }}" class="nav-link {{ request()->routeIs('products.users.index') ? 'active' : '' }}">{{ __('Manage Users') }}</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

    </div>
</body>

</html>