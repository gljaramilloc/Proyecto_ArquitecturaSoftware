<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @hasSection('title')— @yield('title')@endif</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,600,700|playfair-display:500,600,700" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Bootstrap 5 CSS & Custom Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/layout/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components/language-switch.css') }}" rel="stylesheet">

    <!-- Per-screen stylesheet, pushed from each view -->
    @stack('styles')

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    <div id="app">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md navbar-dark bg-secondary shadow-sm py-3">
            <div class="container">
                <a class="navbar-brand fw-bold fs-4 font-display text-brand-gold" href="{{ route('home.index') }}">
                    💎 {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home.index') ? 'active fw-bold' : '' }}"
                                href="{{ route('home.index') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('jewels.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('jewels.index') }}">
                                Catalog
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('categories.index') }}">
                                Categories
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Language Switch -->
                        <li class="nav-item">
                            <x-language-switch />
                        </li>

                        <!-- Cart Link -->
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                🛒 {{ __('cart.title') }}
                            </a>
                        </li>

                        <!-- Authentication Links -->
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->getName() }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        📦 {{ __('order.my_orders') }}
                                    </a>
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
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
            @if (session('status'))
                <div class="container mt-4">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-secondary text-white pt-5 pb-4 mt-5">
            <div class="container text-center text-md-start">
                <div class="row">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h4 class="text-uppercase mb-4 font-display text-brand-gold">{{ config('app.name', 'Laravel') }}
                        </h4>
                        <p class="text-white-50 footer-tagline">
                            Creating unforgettable moments through exceptional pieces. Design, quality, and absolute
                            elegance in every detail of our collections.
                        </p>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase mb-4 fw-bold text-brand-gold footer-heading">Collections</h6>
                        <p><a href="{{ route('jewels.index') }}" class="text-white-50 text-decoration-none">View All</a>
                        </p>
                        <p><a href="{{ route('categories.index') }}" class="text-white-50 text-decoration-none">New
                                Arrivals</a></p>
                        <p><a href="{{ route('jewels.index') }}" class="text-white-50 text-decoration-none">Best
                                Sellers</a></p>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase mb-4 fw-bold text-brand-gold footer-heading">Contact</h6>
                        <p class="text-white-50"><i class="bi bi-geo-alt-fill me-2"></i> Bello, Antioquia, Colombia</p>
                        <p class="text-white-50"><i class="bi bi-envelope-fill me-2"></i> contact@jewelstore.com</p>
                        <p class="text-white-50"><i class="bi bi-telephone-fill me-2"></i> +57 300 123 4567</p>
                    </div>
                </div>

                <hr class="mb-4 border-light opacity-25">

                <div class="row align-items-center">
                    <div class="col-md-7 col-lg-8">
                        <p class="text-center text-md-start text-white-50 mb-0">
                            © {{ date('Y') }} All rights reserved. <span
                                class="text-brand-gold">{{ config('app.name', 'Laravel') }}</span>
                        </p>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="text-center text-md-end">
                            <ul class="list-unstyled list-inline mb-0">
                                <li class="list-inline-item"><a href="#"
                                        class="text-white-50 text-decoration-none fs-5 me-2"><i
                                            class="bi bi-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#"
                                        class="text-white-50 text-decoration-none fs-5 me-2"><i
                                            class="bi bi-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"
                                        class="text-white-50 text-decoration-none fs-5"><i
                                            class="bi bi-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @stack('scripts')
</body>

</html>