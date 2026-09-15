{{-- Extend the main application layout --}}
@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/home/index.css') }}" rel="stylesheet">
@endpush

{{-- Define the page title --}}
@section('title', 'Home Page - Online Store')

{{-- Define the main content section --}}
@section('content')
    <div class="text-center mb-5">
        <h1 class="display-4">{{ __('home.welcome') }}</h1>
    </div>

    @if(isset($viewData['topJewels']) && $viewData['topJewels']->count() > 0)
        <div class="container mb-5">
            <h2 class="text-center mb-4 text-primary">{{ __('home.top_selling') }}</h2>
            <div class="row justify-content-center">
                @foreach($viewData['topJewels'] as $orderItem)
                    @if($orderItem->getJewel())
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <!-- Si tuvieras imagenes: <img src="..." class="card-img-top"> -->
                                <div class="card-body text-center d-flex flex-column">
                                    <h4 class="card-title text-uppercase">{{ $orderItem->getJewel()->getName() }}</h4>
                                    <h6 class="text-muted mb-3">{{ $orderItem->getJewel()->getMaterial() }}</h6>
                                    <p class="card-text fs-5 fw-bold text-success mb-3">
                                        ${{ number_format($orderItem->getJewel()->getPrice(), 2) }}
                                    </p>

                                    <div class="mt-auto">
                                        <span class="badge bg-warning text-dark fs-6 d-block mb-3">
                                            ⭐ {{ __('home.sold_count') }} {{ $orderItem->getTotalSold() }}
                                        </span>

                                        <!-- Botón hacia el detalle del producto (Ruta estática para evitar crash si tus compañeros no la han creado en web.php) -->
                                        <a href="/jewels/{{ $orderItem->getJewel()->getId() }}" class="btn btn-outline-primary w-100">
                                            {{ __('home.view_product') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@endsection

{{-- Display error message from session if it exists --}}
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif