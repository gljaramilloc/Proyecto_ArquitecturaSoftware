{{-- Promotional seasonal banner --}}
<section class="promo-banner py-5">
    <div class="container py-3">
        <div class="promo-banner__card text-center text-white p-4 p-md-5 mx-auto">
            <p class="promo-banner__kicker text-brand-gold text-uppercase fw-bold small mb-2">
                {{ __('home.promo_banner_kicker') }}
            </p>
            <h2 class="font-display display-5 text-white mb-3">
                {{ __('home.promo_banner_title') }}
            </h2>
            <p class="promo-banner__subtitle text-light mx-auto mb-4">
                {{ __('home.promo_banner_subtitle') }}
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('jewels.index') }}" class="btn btn-brand px-4 py-2">
                    {{ __('home.promo_banner_cta') }}
                </a>
                <a href="{{ route('categories.index') }}" class="btn btn-promo-outline px-4 py-2">
                    {{ __('home.promo_banner_secondary_cta') }}
                </a>
            </div>
        </div>
    </div>
</section>
