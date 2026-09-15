@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/orders/show.css') }}" rel="stylesheet">
@endpush

@section('title', __('order.details_title'))

@section('content')
<div class="container">
    <h1>{{ __('order.details_title') }} #{{ $viewData['order']->getId() }}</h1>

    <p><strong>{{ __('order.date') }}:</strong> {{ $viewData['order']->getCreatedAt() }}</p>
    <p><strong>{{ __('order.status') }}:</strong> {{ $viewData['order']->getStatus()?->getName() }}</p>

    <h2>{{ __('order.items_title') }}</h2>
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('order.item_name') }}</th>
                <th>{{ __('order.item_quantity') }}</th>
                <th>{{ __('order.item_unit_price') }}</th>
                <th>{{ __('order.item_subtotal') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viewData['order']->getItems() as $item)
                <tr>
                    <td>{{ $item->getJewel()?->getName() }}</td>
                    <td>{{ $item->getQuantity() }}</td>
                    <td>${{ $item->getUnitPrice() }}</td>
                    <td>${{ $item->getQuantity() * $item->getUnitPrice() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>{{ __('order.total') }}:</strong> ${{ $viewData['order']->getTotal() }}</p>

    <h2>{{ __('order.payment_title') }}</h2>
    @if ($viewData['order']->getPayment())
        <p><strong>{{ __('payment.amount') }}:</strong> ${{ $viewData['order']->getPayment()->getAmount() }}</p>
        <p><strong>{{ __('payment.method') }}:</strong> {{ $viewData['order']->getPayment()->getMethod() }}</p>
        <p><strong>{{ __('payment.status') }}:</strong> {{ $viewData['order']->getPayment()->getStatus()?->getName() }}</p>
    @else
        <p>{{ __('order.no_payment') }}</p>
        <a href="{{ route('payments.create', $viewData['order']->getId()) }}" class="btn btn-primary">{{ __('payment.register') }}</a>
    @endif
</div>
@endsection