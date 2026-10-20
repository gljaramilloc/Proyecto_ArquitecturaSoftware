{{-- About the store --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
                <p class="text-brand-gold text-uppercase fw-bold small">{{ __('home.about_us') }}</p>
                <h2 class="font-display mb-4 display-6 text-dark">{{ __('home.tradition_luxury') }}</h2>
                <p class="text-muted mb-3 lh-base">
                    {{ __('home.welcome_store', ['name' => config('app.name', 'Laravel')]) }}
                </p>
                <p class="text-muted mb-4 lh-base">
                    {{ __('home.about_artisans') }}
                </p>
                <a href="{{ route('jewels.index') }}" class="btn btn-brand-outline">{{ __('home.discover_collection') }}</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/jewel4.jpg') }}" alt="{{ __('home.handcrafted_jewelry') }}" class="about-image img-fluid rounded shadow-sm w-100">
            </div>
        </div>
    </div>
</section>
