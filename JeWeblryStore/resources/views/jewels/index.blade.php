@extends('layouts.app')

@section('title', __('catalog.title'))

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="font-display">{{ __('catalog.title') }}</h1>
            <p class="text-muted text-uppercase catalog-subtitle">{{ __('catalog.subtitle') }}</p>
        </div>

        <x-exchange-rate-banner :quote="$viewData['exchangeQuote']" />

        {{-- Search form --}}
        <div class="card border-0 shadow-sm mb-4 bg-white search-card">
            <div class="card-body p-4">
                <form action="{{ route('jewels.index') }}" method="GET" class="row g-3 align-items-center" role="search">
                    <div class="col-md-5">
                        <label for="search-name" class="visually-hidden">{{ __('catalog.search_placeholder') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="search" id="search-name" name="name" class="form-control border-start-0 ps-0 shadow-none" placeholder="{{ __('catalog.search_placeholder') }}" value="{{ $viewData['searchName'] }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="search-category" class="visually-hidden">{{ __('catalog.all_categories') }}</label>
                        <select id="search-category" name="category_id" class="form-select shadow-none">
                            <option value="">— {{ __('catalog.all_categories') }}</option>
                            @foreach ($viewData['categories'] as $category)
                                <option value="{{ $category->getId() }}" {{ $viewData['searchCategoryId'] === $category->getId() ? 'selected' : '' }}>
                                    {{ $category->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-brand flex-grow-1">{{ __('catalog.search') }}</button>
                        @if ($viewData['isFiltered'])
                            <a href="{{ route('jewels.index') }}" class="btn btn-outline-dark" title="{{ __('catalog.clear_filters') }}" aria-label="{{ __('catalog.clear_filters') }}">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <p class="text-muted small mb-4">{{ trans_choice('catalog.results_count', $viewData['jewels']->total(), ['count' => $viewData['jewels']->total()]) }}</p>

        {{-- Jewel grid --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            @forelse ($viewData['jewels'] as $jewel)
                <div class="col">
                    <x-jewel-card :jewel="$jewel" :exchange-quote="$viewData['exchangeQuote']" />
                </div>
            @empty
                <div class="col-12 w-100">
                    <div class="alert text-center p-5 border-0 shadow-sm bg-white search-empty-state">
                        <i class="bi bi-search display-4 text-muted mb-3 d-block"></i>
                        <h2 class="h4 font-display">{{ __('catalog.no_results') }}</h2>
                        <p class="text-muted mb-0">{{ __('catalog.no_results_hint') }}</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $viewData['jewels']->links() }}
        </div>
    </div>
@endsection
