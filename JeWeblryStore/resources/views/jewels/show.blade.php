@extends('layouts.app')

@section('title', $viewData['jewel']->getName())

@section('content')
    <div class="container py-5">
        <nav aria-label="{{ __('catalog.breadcrumb') }}" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('jewels.index') }}">{{ __('catalog.title') }}</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('categories.show', $viewData['jewel']->getCategoryId()) }}">
                        {{ $viewData['jewel']->getCategory()?->getName() }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $viewData['jewel']->getName() }}</li>
            </ol>
        </nav>

        <div class="card border-0 shadow-sm">
            <div class="row g-0">
                <div class="col-md-5">
                    @if ($viewData['jewel']->getImage())
                        <img
                            src="{{ Storage::url($viewData['jewel']->getImage()) }}"
                            alt="{{ $viewData['jewel']->getName() }}"
                            class="jewel-detail__image w-100 h-100 rounded-start"
                        >
                    @else
                        <div class="jewel-detail__image jewel-detail__image--placeholder w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted rounded-start">
                            <i class="bi bi-image display-4"></i>
                        </div>
                    @endif
                </div>

                <div class="col-md-7">
                    <div class="card-body h-100 d-flex flex-column">
                        <span class="badge bg-secondary align-self-start mb-2">
                            {{ $viewData['jewel']->getCategory()?->getName() }}
                        </span>

                        <h1 class="h3 font-display">{{ $viewData['jewel']->getName() }}</h1>
                        <p class="fs-3 fw-bold mb-2 text-brand-gold">
                            ${{ number_format($viewData['jewel']->getPrice(), 2) }} <span class="fs-6 fw-normal text-muted">{{ __('currency.usd_code') }}</span>
                        </p>

                        @if ($viewData['exchangeQuote'] !== null)
                            <div class="jewel-detail__cop-box px-3 py-2 mb-3">
                                <p class="small text-muted mb-0">{{ __('currency.estimated_cop_label') }}</p>
                                <p class="fw-semibold text-dark mb-0">
                                    {{ __('currency.approx_cop', ['amount' => number_format($viewData['exchangeQuote']->convert($viewData['jewel']->getPrice()), 0)]) }}
                                    <span class="text-muted fw-normal small ms-1">
                                        ({{ __('currency.rate_format', [
                                            'base' => $viewData['exchangeQuote']->getBaseCurrency(),
                                            'rate' => number_format($viewData['exchangeQuote']->getRate(), 2),
                                            'target' => $viewData['exchangeQuote']->getTargetCurrency(),
                                        ]) }})
                                    </span>
                                </p>
                            </div>
                        @else
                            <p class="small text-muted mb-3">
                                <i class="bi bi-cloud-slash me-1" aria-hidden="true"></i>{{ __('currency.unavailable_detail') }}
                            </p>
                        @endif

                        <p class="text-muted">{{ $viewData['jewel']->getDescription() }}</p>

                        <ul class="list-group list-group-flush mt-auto">
                            <li class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-muted">{{ __('catalog.material') }}</span>
                                <span class="fw-semibold">{{ $viewData['jewel']->getMaterial() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-muted">{{ __('catalog.availability') }}</span>
                                @if ($viewData['jewel']->getStock() > 0)
                                    <span class="badge bg-success">{{ __('catalog.in_stock', ['count' => $viewData['jewel']->getStock()]) }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('catalog.out_of_stock') }}</span>
                                @endif
                            </li>
                        </ul>

                        @auth
                            @if ($viewData['jewel']->getStock() > 0)
                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <form method="POST" action="{{ route('cart.add', $viewData['jewel']->getId()) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-brand-outline">
                                        <i class="bi bi-cart-plus me-1"></i>{{ __('cart.add_to_cart') }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('cart.buyNow', $viewData['jewel']->getId()) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-brand">
                                        <i class="bi bi-bag-check me-1"></i>{{ __('cart.buy_now') }}
                                    </button>
                                </form>
                            </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-brand mt-4 align-self-start">
                                <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('catalog.login_to_buy') }}
                            </a>
                        @endauth

                        <a href="{{ route('jewels.index') }}" class="btn btn-outline-dark mt-4 align-self-start">
                            &larr; {{ __('catalog.back_to_catalog') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection