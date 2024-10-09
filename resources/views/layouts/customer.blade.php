<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.Cozyran', 'Cozyran') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=YourChosenFont&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .navbar {
            height: 60px;
            /* Set a fixed height */
        }

        .navbar-brand,
        .nav-link {
            height: 60px;
            /* Match height of navbar */
            line-height: 60px;
            /* Center text vertically */
            padding: 0 15px;
            /* Add some padding for horizontal spacing */
        }

        .navbar-toggler {
            height: 60px;
            /* Ensure the toggler button matches the navbar height */
        }

        .nav-link {
            position: relative;
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
    </style>
</head>

<body style="background: rgb(233,225,215);
background: linear-gradient(90deg, rgba(233,225,215,1) 0%, rgba(230,230,230,1) 41%, rgba(159,155,161,1) 100%);">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" style="font-weight: bold;" href="{{ url('/') }}">
                    {{ config('app.Cozyran', 'Cozyran') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item cart-icon">
                            <a class="nav-link position-relative d-flex align-items-center" href="{{ route('customer.shopping-cart.view') }}">
                                <i class="bi bi-cart fs-4 me-2"></i>
                                @if(session()->has('cart') && count(session('cart')) > 0)
                                <span class="position-absolute top-30 start-50 translate-middle badge rounded-pill bg-danger">
                                    {{ count(session('cart')) }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                @endif
                            </a>
                        </li>

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
                                <a class="dropdown-item" href="{{ route('customer.profile.show') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('customer.my-orders.index') }}">My Purchases</a>
                                <a class="dropdown-item" href="{{ route('customer.emails.order_confirmation') }}">Notifications</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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

        <main class="container mt-4">
            @yield('content')
        </main>
    </div>
</body>

</html>