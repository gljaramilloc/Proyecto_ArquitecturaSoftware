@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="container py-5">
        <div class="section-heading text-start mb-5">
            <h1 class="mb-1">Categories</h1>
            <p>Explore our collection organized by jewel type</p>
        </div>

        <div class="row g-4">
            @foreach ($viewData['categories'] as $category)
                <div class="col-md-6 col-lg-4">
                    <div class="category-card category-card--{{ ['teal', 'gold', 'navy'][$loop->index % 3] }}">
                        <h3 class="category-card__name">{{ $category->getName() }}</h3>
                        <p class="category-card__description">{{ $category->getDescription() }}</p>
                        <a href="{{ route('categories.show', $category->getId()) }}" class="btn btn-brand-outline btn-sm">
                            View jewels <i class="bi bi-arrow-right-short"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection