@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/payments/show.css') }}" rel="stylesheet">
@endpush

@section('title', __('payment.details_title'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ __('payment.details_title') }}</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($viewData['payment'])
                <p><strong>{{ __('payment.amount') }}:</strong> ${{ $viewData['payment']->getAmount() }}</p>
                <p><strong>{{ __('payment.method') }}:</strong> {{ $viewData['payment']->getMethod() }}</p>
                <p><strong>{{ __('payment.date') }}:</strong> {{ $viewData['payment']->getDate() }}</p>
                <p><strong>{{ __('payment.status') }}:</strong> {{ $viewData['payment']->getStatus()->getName() }}</p>
            @else
                <p>{{ __('payment.no_payment') }}</p>
                <a href="{{ route('payments.create', $viewData['order']->getId()) }}" class="btn btn-primary">{{ __('payment.register') }}</a>
            @endif
        </div>
    </div>
</div>
@endsection