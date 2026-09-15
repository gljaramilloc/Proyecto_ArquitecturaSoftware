{{-- About the store --}}
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
