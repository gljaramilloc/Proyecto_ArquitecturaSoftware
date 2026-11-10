@extends('layouts.app')

@section('title', __('cart.purchase_title'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 text-center">
                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-3">
                            <i class="bi bi-check-circle text-brand-gold display-3" aria-hidden="true"></i>
                        </div>

                        <p class="text-brand-gold text-uppercase fw-bold small mb-2">{{ $viewData['title'] }}</p>
                        <h1 class="font-display h2 text-dark mb-3">{{ $viewData['subtitle'] }}</h1>
                        <p class="text-muted mb-3">{{ __('cart.success_msg') }}</p>

                        <p class="fs-5 text-muted mb-4">
                            {{ __('cart.order_number') }}:
                            <strong class="text-dark">#{{ $viewData['order']->getId() }}</strong>
                        </p>

                        <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                            <a href="{{ route('payments.create', $viewData['order']->getId()) }}" class="btn btn-brand px-4 py-2">
                                <i class="bi bi-credit-card me-1" aria-hidden="true"></i>{{ __('payment.register') }}
                            </a>
                            <a href="{{ route('orders.show', $viewData['order']->getId()) }}" class="btn btn-brand-outline px-4 py-2">
                                {{ __('order.view_details') }}
                            </a>
                            <a href="{{ route('jewels.index') }}" class="btn btn-brand-outline px-4 py-2">
                                {{ __('cart.continue_shopping') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
