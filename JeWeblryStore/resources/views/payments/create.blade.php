@extends('layouts.app')

@section('title', __('payment.title'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="h3 font-display mb-2">{{ __('payment.title') }}</h1>
                <p class="text-muted mb-4">
                    {{ __('payment.order_number') }} #{{ $viewData['order']->getId() }} —
                    {{ __('payment.order_total') }}: <span class="fw-bold text-brand-gold">${{ number_format($viewData['order']->getTotal(), 2) }}</span>
                </p>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('payments.store', $viewData['order']->getId()) }}" method="POST">
                            @csrf

                            <fieldset class="mb-4">
                                <legend class="h6 mb-3">{{ __('payment.method') }}</legend>

                                <div class="form-check mb-3">
                                    <input class="form-check-input @error('method') is-invalid @enderror" type="radio" name="method" id="method-cheque" value="cheque" {{ old('method', 'cheque') === 'cheque' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="method-cheque">
                                        <i class="bi bi-file-earmark-pdf me-1"></i>{{ __('payment.cheque') }}
                                        <small class="d-block text-muted">{{ __('payment.cheque_hint') }}</small>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input @error('method') is-invalid @enderror" type="radio" name="method" id="method-balance" value="balance" {{ old('method') === 'balance' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="method-balance">
                                        <i class="bi bi-wallet2 me-1"></i>{{ __('payment.balance') }}
                                        <small class="d-block text-muted">{{ __('payment.balance_hint', ['balance' => number_format($viewData['balance'], 2)]) }}</small>
                                    </label>
                                    @error('method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </fieldset>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('orders.show', $viewData['order']->getId()) }}" class="btn btn-outline-dark">{{ __('payment.back_to_order') }}</a>
                                <button type="submit" class="btn btn-brand">{{ __('payment.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
