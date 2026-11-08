@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/orders/show.css') }}" rel="stylesheet">
@endpush

@section('title', __('order.details_title'))

@section('content')
    <div class="container py-5">
        <nav aria-label="{{ __('catalog.breadcrumb') }}" class="mb-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">{{ __('order.history_title') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">#{{ $viewData['order']->getId() }}</li>
            </ol>
        </nav>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <h1 class="h2 font-display text-dark mb-0">{{ __('order.details_title') }} #{{ $viewData['order']->getId() }}</h1>
            <a href="{{ route('orders.index') }}" class="btn btn-brand-outline">
                &larr; {{ __('order.back_to_orders') }}
            </a>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border shadow-sm bg-white rounded-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap justify-content-between gap-3 pb-3 mb-3 border-bottom">
                            <div>
                                <span class="text-muted text-uppercase small d-block">{{ __('order.date') }}</span>
                                <strong>{{ $viewData['order']->getCreatedAt() }}</strong>
                            </div>
                            <div>
                                <span class="text-muted text-uppercase small d-block">{{ __('order.status') }}</span>
                                <span class="badge bg-secondary">
                                    {{ $viewData['order']->getStatus() ? __('status.'.$viewData['order']->getStatus()->getName()) : __('admin.not_available') }}
                                </span>
                            </div>
                        </div>

                        <h2 class="h5 font-display text-dark mb-3">{{ __('order.items_title') }}</h2>

                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr class="text-uppercase small text-muted">
                                        <th scope="col">{{ __('order.item_name') }}</th>
                                        <th scope="col" class="text-center">{{ __('order.item_quantity') }}</th>
                                        <th scope="col" class="text-end">{{ __('order.item_unit_price') }}</th>
                                        <th scope="col" class="text-end">{{ __('order.item_subtotal') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewData['order']->getItems() as $item)
                                        <tr>
                                            <td>
                                                @if ($item->getJewel())
                                                    <a href="{{ route('jewels.show', $item->getJewel()->getId()) }}" class="fw-semibold text-dark text-decoration-none">
                                                        {{ $item->getJewel()->getName() }}
                                                    </a>
                                                @else
                                                    {{ __('admin.not_available') }}
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->getQuantity() }}</td>
                                            <td class="text-end">${{ number_format($item->getUnitPrice(), 2) }}</td>
                                            <td class="text-end fw-bold text-brand-gold">${{ number_format($item->getQuantity() * $item->getUnitPrice(), 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end fs-5 pt-3">{{ __('order.total') }}:</th>
                                        <th class="text-end fs-5 text-brand-gold pt-3">${{ number_format($viewData['order']->getTotal(), 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4">
                        <h2 class="h5 font-display text-dark mb-3">{{ __('order.payment_title') }}</h2>

                        @if ($viewData['order']->getPayment())
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-muted">{{ __('payment.amount') }}</span>
                                    <strong class="text-brand-gold">${{ number_format($viewData['order']->getPayment()->getAmount(), 2) }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-muted">{{ __('payment.method') }}</span>
                                    <span class="fw-semibold">{{ __('payment.'.$viewData['order']->getPayment()->getMethod()) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span class="text-muted">{{ __('payment.status') }}</span>
                                    <span class="badge bg-success">
                                        {{ $viewData['order']->getPayment()->getStatus() ? __('status.'.$viewData['order']->getPayment()->getStatus()->getName()) : __('admin.not_available') }}
                                    </span>
                                </li>
                            </ul>

                            <a href="{{ route('payments.show', $viewData['order']->getId()) }}" class="btn btn-brand-outline w-100 py-2 mt-3">
                                {{ __('payment.details_title') }}
                            </a>
                        @else
                            <p class="text-muted mb-4">{{ __('order.no_payment') }}</p>
                            <a href="{{ route('payments.create', $viewData['order']->getId()) }}" class="btn btn-brand w-100 py-2">
                                <i class="bi bi-credit-card me-1" aria-hidden="true"></i>{{ __('payment.register') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
