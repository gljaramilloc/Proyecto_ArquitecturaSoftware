@extends('layouts.app')

@section('title', __('allied.title'))

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="font-display">{{ __('allied.title') }}</h1>
            <p class="text-muted text-uppercase catalog-subtitle">{{ __('allied.subtitle') }}</p>
        </div>

        @if (! $viewData['serviceAvailable'])
            <div class="alert alert-warning text-center p-5 border-0 shadow-sm">
                <i class="bi bi-cloud-slash display-4 d-block mb-3"></i>
                <h2 class="h4 font-display">{{ __('allied.unavailable') }}</h2>
                <p class="mb-0">{{ __('allied.unavailable_hint') }}</p>
            </div>
        @else
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                @forelse ($viewData['products'] as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm jewel-card">
                            <div class="jewel-card__image-wrapper bg-light d-flex align-items-center justify-content-center">
                                @if ($product->getImage())
                                    <img src="{{ $product->getImage() }}" alt="{{ $product->getName() }}" class="img-card w-100 rounded-top">
                                @else
                                    <i class="bi bi-image text-muted fs-1"></i>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column text-center p-4">
                                <h2 class="h5 card-title font-display mb-3">{{ $product->getName() }}</h2>

                                <div class="mt-auto">
                                    @if ($product->getPrice() !== null)
                                        <p class="fs-5 text-brand-gold mb-3">${{ number_format($product->getPrice(), 2) }}</p>
                                    @endif

                                    @if ($product->getLink())
                                        <a href="{{ $product->getLink() }}" class="btn btn-brand-outline w-100" target="_blank" rel="noopener noreferrer">
                                            {{ __('allied.view_product') }} <i class="bi bi-box-arrow-up-right ms-1"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 w-100">
                        <div class="alert alert-light border text-center">{{ __('allied.empty') }}</div>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
@endsection
