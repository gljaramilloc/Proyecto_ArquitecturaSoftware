{{-- Hero carousel --}}
<section class="hero-carousel-wrapper">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-label="{{ __('home.go_to_slide', ['number' => 1]) }}"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="{{ __('home.go_to_slide', ['number' => 2]) }}"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="{{ __('home.go_to_slide', ['number' => 3]) }}"></button>
        </div>

        <div class="carousel-inner bg-dark">
            <div class="carousel-item active" data-bs-interval="4000">
                <div class="hero-slide-container hero-slide-container--1 d-flex align-items-center justify-content-center text-center text-white">
                    <div class="hero-overlay"></div>
                    <div class="container position-relative z-1 py-5">
                        <p class="text-brand-gold text-uppercase fw-bold mb-2 small tracking-wide">{{ __('home.new_collection') }}</p>
                        <h1 class="font-display display-4 mb-3 text-white">{{ __('home.timeless_elegance') }}</h1>
                        <p class="text-light mx-auto mb-4 fs-6 w-75 opacity-75">{{ __('home.hero_collection_copy') }}</p>
                        <a href="{{ route('jewels.index') }}" class="btn btn-brand px-4 py-2">{{ __('home.explore_catalog') }}</a>
                    </div>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="4000">
                <div class="hero-slide-container hero-slide-container--2 d-flex align-items-center justify-content-center text-center text-white">
                    <div class="hero-overlay"></div>
                    <div class="container position-relative z-1 py-5">
                        <p class="text-brand-gold text-uppercase fw-bold mb-2 small tracking-wide">{{ __('home.pure_craftsmanship') }}</p>
                        <h1 class="font-display display-4 mb-3 text-white">{{ __('home.details_that_shine') }}</h1>
                        <p class="text-light mx-auto mb-4 fs-6 w-75 opacity-75">{{ __('home.craftsmanship_copy') }}</p>
                        <a href="{{ route('categories.index') }}" class="btn btn-brand px-4 py-2">{{ __('home.view_categories') }}</a>
                    </div>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="4000">
                <div class="hero-slide-container hero-slide-container--3 d-flex align-items-center justify-content-center text-center text-white">
                    <div class="hero-overlay"></div>
                    <div class="container position-relative z-1 py-5">
                        <p class="text-brand-gold text-uppercase fw-bold mb-2 small tracking-wide">{{ __('home.exclusivity') }}</p>
                        <h1 class="font-display display-4 mb-3 text-white">{{ __('home.perfect_gift') }}</h1>
                        <p class="text-light mx-auto mb-4 fs-6 w-75 opacity-75">{{ __('home.gift_copy') }}</p>
                        <a href="{{ route('jewels.index') }}" class="btn btn-brand px-4 py-2">{{ __('home.shop_now') }}</a>
                    </div>
                </div>
            </div>
        </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="{{ __('home.previous_slide') }}">
            <span class="carousel-control-prev-icon"></span>
        </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="{{ __('home.next_slide') }}">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>
