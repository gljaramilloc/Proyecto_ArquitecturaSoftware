@extends('layouts.app')

@section('title', $viewData['category']->getName())

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $viewData['category']->getName() }}</li>
            </ol>
        </nav>

        <div class="section-heading text-start mb-5">
            <h1 class="mb-1">{{ $viewData['category']->getName() }}</h1>
            <p>{{ $viewData['category']->getDescription() }}</p>
        </div>

        <h2 class="h4 mb-4">Jewels in this category</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            @forelse ($viewData['jewels'] as $jewel)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm jewel-card">
                        @if ($jewel->getImage())
                            <img src="{{ Storage::url($jewel->getImage()) }}" alt="{{ $jewel->getName() }}" class="img-card w-100 rounded-top">
                        @else
                            <div class="img-card img-card--placeholder w-100 rounded-top d-flex align-items-center justify-content-center bg-light text-muted">
                                <i class="bi bi-image fs-1"></i>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">{{ $jewel->getName() }}</h5>
                            <p class="text-muted small mb-3">{{ $jewel->getStock() > 0 ? $jewel->getStock() . ' in stock' : 'Out of stock' }}</p>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="fw-bold fs-5 text-brand-gold">
                                    ${{ number_format($jewel->getPrice(), 2) }}
                                </span>
                                <a href="{{ route('jewels.show', $jewel->getId()) }}" class="btn btn-sm btn-outline-dark">
                                    View detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border text-center">
                        No jewels registered in this category yet.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection