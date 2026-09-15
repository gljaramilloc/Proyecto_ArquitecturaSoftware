{{-- Featured jewels --}}
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
