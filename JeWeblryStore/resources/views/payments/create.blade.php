@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/payments/create.css') }}" rel="stylesheet">
@endpush

@section('title', __('payment.title'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ __('payment.title') }}</h1>
            <p>{{ __('payment.order_number') }}: #{{ $viewData['order']->getId() }} — {{ __('payment.order_total') }}: ${{ $viewData['order']->getTotal() }}</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('payments.store', $viewData['order']->getId()) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>{{ __('payment.amount') }}</label>
                    <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $viewData['order']->getTotal()) }}">
                </div>

                <div class="mb-3">
                    <label>{{ __('payment.method') }}</label>
                    <select name="method" class="form-control">
                        <option value="credit_card" {{ old('method') === 'credit_card' ? 'selected' : '' }}>{{ __('payment.credit_card') }}</option>
                        <option value="debit_card" {{ old('method') === 'debit_card' ? 'selected' : '' }}>{{ __('payment.debit_card') }}</option>
                        <option value="paypal" {{ old('method') === 'paypal' ? 'selected' : '' }}>PayPal</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>{{ __('payment.date') }}</label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}">
                </div>

                <button type="submit" class="btn btn-primary">{{ __('payment.save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection