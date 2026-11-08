@extends('layouts.app')

@section('title', $viewData['category']->getName())

@section('content')
    <div class="container py-5">
        <nav aria-label="{{ __('catalog.breadcrumb') }}" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">{{ __('catalog.categories_title') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $viewData['category']->getName() }}</li>
            </ol>
        </nav>

        <div class="section-heading text-start mb-5">
            <h1 class="mb-1">{{ $viewData['category']->getName() }}</h1>
            <p>{{ $viewData['category']->getDescription() }}</p>
        </div>

        <h2 class="h4 mb-4">{{ __('catalog.jewels_in_category') }}</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            @forelse ($viewData['jewels'] as $jewel)
                <div class="col">
                    <x-jewel-card :jewel="$jewel" />
                </div>
            @empty
                <div class="col-12 w-100">
                    <div class="alert alert-light border text-center">
                        {{ __('catalog.no_category_jewels') }}
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $viewData['jewels']->links() }}
        </div>

        <a href="{{ route('categories.index') }}" class="btn btn-outline-dark mt-4">
            &larr; {{ __('catalog.back_to_categories') }}
        </a>
    </div>
@endsection