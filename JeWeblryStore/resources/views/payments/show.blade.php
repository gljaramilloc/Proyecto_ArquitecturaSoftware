@extends('layouts.app')

@section('title', __('payment.details_title'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="h3 font-display mb-4">{{ __('payment.details_title') }}</h1>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        @if ($viewData['payment'])
                            <p><strong>{{ __('payment.amount') }}:</strong> ${{ number_format($viewData['payment']->getAmount(), 2) }}</p>
                            <p><strong>{{ __('payment.method') }}:</strong> {{ __('payment.'.$viewData['payment']->getMethod()) }}</p>
                            <p><strong>{{ __('payment.date') }}:</strong> {{ $viewData['payment']->getDate() }}</p>
                            <p><strong>{{ __('payment.status') }}:</strong> {{ $viewData['payment']->getStatus() ? __('status.'.$viewData['payment']->getStatus()->getName()) : __('admin.not_available') }}</p>

                            @if ($viewData['payment']->isCheque())
                                <a href="{{ route('payments.cheque', $viewData['order']->getId()) }}" class="btn btn-brand">
                                    <i class="bi bi-download me-1"></i>{{ __('payment.download_cheque') }}
                                </a>
                            @endif
                        @else
                            <p>{{ __('payment.no_payment') }}</p>
                            <a href="{{ route('payments.create', $viewData['order']->getId()) }}" class="btn btn-brand">{{ __('payment.register') }}</a>
                        @endif
                    </div>
                </div>

                <a href="{{ route('orders.show', $viewData['order']->getId()) }}" class="btn btn-outline-dark mt-4">{{ __('payment.back_to_order') }}</a>
            </div>
        </div>
    </div>
@endsection
