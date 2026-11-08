@extends('layouts.app')

@section('title', __('catalog.categories_title'))

@section('content')
    <div class="container py-5">
        <div class="section-heading text-start mb-5">
            <h1 class="mb-1">{{ __('catalog.categories_title') }}</h1>
            <p>{{ __('catalog.categories_subtitle') }}</p>
        </div>

        <div class="row g-4">
            @forelse ($viewData['categories'] as $category)
                <div class="col-md-6 col-lg-4">
                    <div class="category-card category-card--{{ ['teal', 'gold', 'navy'][$loop->index % 3] }}">
                        <h2 class="h3 category-card__name">{{ $category->getName() }}</h2>
                        <p class="category-card__description">{{ $category->getDescription() }}</p>
                        <a href="{{ route('categories.show', $category->getId()) }}" class="btn btn-brand-outline btn-sm">
                            {{ __('catalog.view_jewels') }} <i class="bi bi-arrow-right-short"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border text-center">{{ __('catalog.no_categories') }}</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection