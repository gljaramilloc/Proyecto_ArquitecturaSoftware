@extends('layouts.app')

@section('title', 'Home')

@section('content')

    {{-- 1. HERO CAROUSEL --}}
    <section class="hero-carousel-wrapper">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner bg-dark">
                <div class="carousel-item active" data-bs-interval="4000">
                    <div class="hero-slide-container hero-slide-container--1 d-flex align-items-center justify-content-center text-center text-white">
                        <div class="hero-overlay"></div>
                        <div class="container position-relative z-1 py-5">
                            <p class="text-brand-gold text-uppercase fw-bold mb-2 small tracking-wide">New Collection</p>
                            <h1 class="font-display display-4 mb-3 text-white">Timeless Elegance</h1>
                            <p class="text-light mx-auto mb-4 fs-6 w-75 opacity-75">Discover exclusive pieces designed to capture the essence of your most unforgettable moments.</p>
                            <a href="{{ route('jewels.index') }}" class="btn btn-brand px-4 py-2">Explore Catalog</a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item" data-bs-interval="4000">
                    <div class="hero-slide-container hero-slide-container--2 d-flex align-items-center justify-content-center text-center text-white">
                        <div class="hero-overlay"></div>
                        <div class="container position-relative z-1 py-5">
                            <p class="text-brand-gold text-uppercase fw-bold mb-2 small tracking-wide">Pure Craftsmanship</p>
                            <h1 class="font-display display-4 mb-3 text-white">Details that Shine</h1>
                            <p class="text-light mx-auto mb-4 fs-6 w-75 opacity-75">Rings and necklaces forged with the purest metals and the brightest gems on the market.</p>
                            <a href="{{ route('categories.index') }}" class="btn btn-brand px-4 py-2">View Categories</a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item" data-bs-interval="4000">
                    <div class="hero-slide-container hero-slide-container--3 d-flex align-items-center justify-content-center text-center text-white">
                        <div class="hero-overlay"></div>
                        <div class="container position-relative z-1 py-5">
                            <p class="text-brand-gold text-uppercase fw-bold mb-2 small tracking-wide">Exclusivity</p>
                            <h1 class="font-display display-4 mb-3 text-white">The Perfect Gift</h1>
                            <p class="text-light mx-auto mb-4 fs-6 w-75 opacity-75">Say what you feel without saying a word. Find the ideal jewel for that special someone.</p>
                            <a href="{{ route('jewels.index') }}" class="btn btn-brand px-4 py-2">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    {{-- 2. ABOUT THE STORE --}}
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
                    <p class="text-brand-gold text-uppercase fw-bold small">About Us</p>
                    <h2 class="font-display mb-4 display-6 text-dark">Tradition and Luxury in Every Detail</h2>
                    <p class="text-muted mb-3 lh-base">
                        Welcome to <strong>{{ config('app.name', 'Laravel') }}</strong>. We were founded on the belief that a jewel is much more than an accessory; it is a legacy, a tangible memory, and a work of art that transcends generations.
                    </p>
                    <p class="text-muted mb-4 lh-base">
                        Our team of artisans and designers works meticulously, selecting noble metals and certified precious stones to ensure that every piece meets the highest standards.
                    </p>
                    <a href="{{ route('jewels.index') }}" class="btn btn-brand-outline">Discover the Collection</a>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/jewel4.jpg') }}" alt="Handcrafted jewelry" class="about-image img-fluid rounded shadow-sm w-100">
                </div>
            </div>
        </div>
    </section>

    {{-- 3. TRUST STRIP --}}
    <section class="trust-strip py-4 border-top border-bottom bg-light">
        <div class="container">
            <div class="row text-center gy-3">
                <div class="col-6 col-md-3">
                    <i class="bi bi-gem text-brand-gold fs-2 mb-1 d-block"></i>
                    <p class="fw-bold text-uppercase small text-dark mb-0">Certified Gems</p>
                </div>
                <div class="col-6 col-md-3">
                    <i class="bi bi-box-seam text-brand-gold fs-2 mb-1 d-block"></i>
                    <p class="fw-bold text-uppercase small text-dark mb-0">Insured Shipping</p>
                </div>
                <div class="col-6 col-md-3">
                    <i class="bi bi-shield-check text-brand-gold fs-2 mb-1 d-block"></i>
                    <p class="fw-bold text-uppercase small text-dark mb-0">Secure Payments</p>
                </div>
                <div class="col-6 col-md-3">
                    <i class="bi bi-arrow-clockwise text-brand-gold fs-2 mb-1 d-block"></i>
                    <p class="fw-bold text-uppercase small text-dark mb-0">1-Year Warranty</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. FEATURED JEWELS --}}
    @if (count($viewData['featuredJewels']) > 0)
        <section class="py-5 bg-white">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <p class="text-muted text-uppercase small mb-1">Exclusive Catalog</p>
                    <h2 class="font-display text-dark display-6">New Arrivals</h2>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($viewData['featuredJewels'] as $jewel)
                        <div class="col">
                            <div class="card h-100 jewel-card border shadow-sm bg-white">
                                @if ($jewel->getImage())
                                    <img src="{{ Storage::url($jewel->getImage()) }}" alt="{{ $jewel->getName() }}" class="featured-jewel-image card-img-top">
                                @else
                                    <div class="featured-jewel-image card-img-top d-flex align-items-center justify-content-center bg-light text-muted">
                                        <i class="bi bi-image fs-1"></i>
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column text-center p-4">
                                    <p class="text-muted small text-uppercase mb-2">{{ $jewel->getCategory()?->getName() }}</p>
                                    <h5 class="card-title font-display mb-3">{{ $jewel->getName() }}</h5>

                                    <div class="mt-auto">
                                        <p class="fw-bold fs-5 text-brand-gold mb-3">${{ number_format($jewel->getPrice(), 2) }}</p>
                                        <a href="{{ route('jewels.show', $jewel->getId()) }}" class="btn btn-brand-outline w-100">View Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('jewels.index') }}" class="btn btn-brand">View All Jewels</a>
                </div>
            </div>
        </section>
    @endif
    @push('scripts')
        <script src="{{ asset('js/home.js') }}" defer></script>
    @endpush

@endsection