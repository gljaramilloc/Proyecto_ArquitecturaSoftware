@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="card border-success shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">{{ $viewData['title'] }}</h4>
                    </div>
                    <div class="card-body py-5">
                        <div class="display-1 text-success mb-4">
                            <i class="bi bi-check-circle-fill">✓</i>
                        </div>
                        <h2 class="card-title fw-bold">{{ $viewData['subtitle'] }}</h2>
                        <p class="lead mt-3">{{ __('cart.success_msg') }}</p>
                        <p class="fs-5 text-muted">
                            {{ __('cart.order_number') }}:
                            <strong class="text-dark">#{{ $viewData['order']->getId() }}</strong>
                        </p>

                        <div class="mt-5">
                            <a href="{{ route('orders.index') }}" class="btn btn-lg btn-success me-3">
                                {{ __('cart.view_my_orders') }}
                            </a>
                            <a href="{{ route('home.index') }}" class="btn btn-lg btn-outline-secondary">
                                {{ __('cart.continue_shopping') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection