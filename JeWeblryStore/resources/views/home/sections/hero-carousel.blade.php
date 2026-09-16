{{-- Hero carousel --}}
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
