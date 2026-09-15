@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/orders/index.css') }}" rel="stylesheet">
@endpush

@section('title', __('order.history_title'))

@section('content')
<div class="container">
    <h1>{{ __('order.history_title') }}</h1>

    @if ($viewData['orders']->isEmpty())
        <p>{{ __('order.no_orders') }}</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('order.order_number') }}</th>
                    <th>{{ __('order.date') }}</th>
                    <th>{{ __('order.total') }}</th>
                    <th>{{ __('order.status') }}</th>
                    <th>{{ __('order.payment_status') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData['orders'] as $order)
                    <tr>
                        <td>#{{ $order->getId() }}</td>
                        <td>{{ $order->getCreatedAt() }}</td>
                        <td>${{ $order->getTotal() }}</td>
                        <td>{{ $order->getStatus()?->getName() }}</td>
                        <td>
                            @if ($order->getPayment())
                                {{ $order->getPayment()->getStatus()?->getName() }}
                            @else
                                {{ __('order.no_payment') }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order->getId()) }}" class="btn btn-sm btn-primary">{{ __('order.view_details') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection