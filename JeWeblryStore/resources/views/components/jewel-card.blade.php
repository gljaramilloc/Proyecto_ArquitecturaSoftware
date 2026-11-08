@props(['jewel'])

{{-- Shared jewel card for the storefront listings (catalog and category detail) --}}
<div class="card h-100 border-0 shadow-sm jewel-card">
    <div class="jewel-card__image-wrapper bg-light d-flex align-items-center justify-content-center">
        @if ($jewel->getImage())
            <img src="{{ Storage::url($jewel->getImage()) }}" alt="{{ $jewel->getName() }}" class="img-card w-100 rounded-top">
        @else
            <i class="bi bi-image text-muted fs-1"></i>
        @endif
    </div>

    <div class="card-body d-flex flex-column text-center p-4">
        <p class="catalog-eyebrow text-muted small fw-bold mb-2">{{ $jewel->getCategory()?->getName() }}</p>
        <h2 class="h5 card-title font-display mb-2">{{ $jewel->getName() }}</h2>
        <p class="small mb-3 {{ $jewel->getStock() > 0 ? 'text-success' : 'text-danger' }}">
            {{ $jewel->getStock() > 0 ? __('catalog.in_stock', ['count' => $jewel->getStock()]) : __('catalog.out_of_stock') }}
        </p>

        <div class="mt-auto">
            <p class="fs-5 text-brand-gold mb-3">${{ number_format($jewel->getPrice(), 2) }}</p>
            <a href="{{ route('jewels.show', $jewel->getId()) }}" class="btn btn-brand-outline w-100">
                {{ __('catalog.view_detail') }}
            </a>
        </div>
    </div>
</div>
