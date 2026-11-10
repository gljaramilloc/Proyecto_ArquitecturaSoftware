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
                @forelse ($viewData['vehicles'] as $vehicle)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm jewel-card">
                            <div class="card-body d-flex flex-column text-center p-4">
                                <i class="bi bi-car-front text-brand-gold display-5 mb-3"></i>

                                <h2 class="h5 card-title font-display mb-1">{{ $vehicle->getFullName() }}</h2>

                                @if ($vehicle->getCategory())
                                    <p class="mb-3"><span class="badge bg-light text-dark border">{{ $vehicle->getCategory() }}</span></p>
                                @endif

                                @if ($vehicle->getLocationName())
                                    <p class="text-muted small mb-1">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $vehicle->getLocationName() }}@if ($vehicle->getCity()), {{ $vehicle->getCity() }}@endif
                                    </p>
                                @endif

                                <p class="small mb-3 {{ $vehicle->isAvailable() ? 'text-success' : 'text-danger' }}">
                                    {{ $vehicle->isAvailable() ? __('allied.available') : __('allied.not_available') }}
                                </p>

                                <div class="mt-auto">
                                    @if ($vehicle->getDailyRate() !== null)
                                        <p class="fs-5 text-brand-gold mb-3">
                                            {{ __('allied.daily_rate', ['price' => '$'.number_format($vehicle->getDailyRate(), 0, ',', '.'), 'currency' => $vehicle->getCurrency()]) }}
                                        </p>
                                    @endif

                                    @if ($vehicle->getDetailUrl())
                                        <a href="{{ $vehicle->getDetailUrl() }}" class="btn btn-brand-outline w-100" target="_blank" rel="noopener noreferrer">
                                            {{ __('allied.view_vehicle') }} <i class="bi bi-box-arrow-up-right ms-1"></i>
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
