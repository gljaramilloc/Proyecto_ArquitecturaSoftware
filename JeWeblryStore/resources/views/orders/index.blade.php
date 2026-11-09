@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/orders/index.css') }}" rel="stylesheet">
@endpush

@section('title', __('order.history_title'))

@section('content')
    <div class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-brand-gold text-uppercase fw-bold small mb-1">{{ __('order.my_orders') }}</p>
                <h1 class="h2 font-display text-dark mb-0">{{ __('order.history_title') }}</h1>
            </div>
            @if ($viewData['orders']->isNotEmpty())
                <a href="{{ route('jewels.index') }}" class="btn btn-brand-outline">
                    {{ __('order.explore_catalog') }}
                </a>
            @endif
        </div>

        <div class="card border shadow-sm bg-white rounded-0">
            <div class="card-body p-4">
                @if ($viewData['orders']->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-box-seam display-4 text-muted d-block mb-3" aria-hidden="true"></i>
                        <h4 class="font-display text-dark mb-3">{{ __('order.no_orders') }}</h4>
                        <a href="{{ route('jewels.index') }}" class="btn btn-brand px-4 py-2">
                            {{ __('order.explore_catalog') }}
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-uppercase small text-muted">
                                    <th scope="col">{{ __('order.order_number') }}</th>
                                    <th scope="col">{{ __('order.date') }}</th>
                                    <th scope="col">{{ __('order.total') }}</th>
                                    <th scope="col">{{ __('order.status') }}</th>
                                    <th scope="col">{{ __('order.payment_status') }}</th>
                                    <th scope="col" class="text-end">{{ __('admin.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewData['orders'] as $order)
                                    <tr>
                                        <td class="fw-bold">#{{ $order->getId() }}</td>
                                        <td>{{ $order->getCreatedAt() }}</td>
                                        <td class="fw-bold text-brand-gold">${{ number_format($order->getTotal(), 2) }}</td>
                                        <td>
                                            <x-status-badge :status="$order->getStatus()" />
                                        </td>
                                        <td>
                                            @if ($order->getPayment())
                                                <x-status-badge :status="$order->getPayment()->getStatus()" />
                                            @else
                                                <span class="text-muted small">{{ __('order.no_payment') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('orders.show', $order->getId()) }}" class="btn btn-sm btn-brand-outline">
                                                {{ __('order.view_details') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
