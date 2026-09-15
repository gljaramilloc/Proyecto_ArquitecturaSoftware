@extends('layouts.app')

@section('title', 'Catalog')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="font-display">Jewel Catalog</h1>
            <p class="text-muted text-uppercase catalog-subtitle">Find the perfect piece</p>
        </div>

        {{-- Search form --}}
        <div class="card border-0 shadow-sm mb-5 bg-white search-card">
            <div class="card-body p-4">
                <form action="{{ route('jewels.index') }}" method="GET" class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="name" class="form-control border-start-0 ps-0 shadow-none" placeholder="Search by name..." value="{{ $viewData['searchName'] }}">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <select name="category_id" class="form-select shadow-none">
                            <option value="">— All categories</option>
                            @foreach ($viewData['categories'] as $category)
                                <option value="{{ $category->getId() }}" {{ $viewData['searchCategoryId'] === $category->getId() ? 'selected' : '' }}>
                                    {{ $category->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-brand w-100">Search</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Jewel grid --}}
        <div class="row">
            @forelse ($viewData['jewels'] as $jewel)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 jewel-card">
                        <div class="jewel-card__image-wrapper bg-light d-flex align-items-center justify-content-center">
                            @if ($jewel->getImage())
                                <img src="{{ Storage::url($jewel->getImage()) }}" alt="{{ $jewel->getName() }}" class="img-card w-100 rounded-top">
                            @else
                                <i class="bi bi-image text-muted fs-1"></i>
                            @endif
                        </div>

                        <div class="card-body text-center p-4">
                            <p class="catalog-eyebrow text-muted small fw-bold mb-2">{{ $jewel->getCategory()?->getName() }}</p>
                            <h5 class="card-title font-display mb-3">{{ $jewel->getName() }}</h5>
                            <h5 class="text-brand-gold fw-normal mb-4">${{ number_format($jewel->getPrice(), 2) }}</h5>

                            <a href="{{ route('jewels.show', $jewel->getId()) }}" class="btn btn-brand-outline w-100">
                                View detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert text-center p-5 border-0 shadow-sm bg-white search-empty-state">
                        <i class="bi bi-search display-4 text-muted mb-3 d-block"></i>
                        <h4 class="font-display">No jewels found</h4>
                        <p class="text-muted mb-0">Try a different name or select another category.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection