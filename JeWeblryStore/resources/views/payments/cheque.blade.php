{{-- PDF document rendered by ChequePdfPaymentProcessor (dompdf). It is a file, not a screen,
     so it does not extend layouts.app nor include the language switch. --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{ __('payment.cheque_title') }} #{{ $viewData['order']->getId() }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #1f2937; font-size: 13px; }
        .cheque { border: 2px solid #b08d57; padding: 24px; }
        .cheque__header { border-bottom: 1px solid #b08d57; margin-bottom: 16px; padding-bottom: 8px; }
        .cheque__store { font-size: 20px; font-weight: bold; color: #b08d57; }
        .cheque__number { float: right; }
        .cheque__row { margin-bottom: 12px; }
        .cheque__label { color: #6b7280; text-transform: uppercase; font-size: 10px; }
        .cheque__amount { font-size: 22px; font-weight: bold; }
        .cheque__signature { margin-top: 40px; border-top: 1px solid #1f2937; width: 220px; text-align: center; padding-top: 4px; }
    </style>
</head>

<body>
    <div class="cheque">
        <div class="cheque__header">
            <span class="cheque__number">{{ __('payment.cheque_number') }} {{ str_pad((string) $viewData['payment']->getId(), 6, '0', STR_PAD_LEFT) }}</span>
            <span class="cheque__store">{{ config('app.name', 'JeWeblryStore') }}</span>
        </div>

        <div class="cheque__row">
            <div class="cheque__label">{{ __('payment.date') }}</div>
            <div>{{ $viewData['payment']->getDate() }}</div>
        </div>

        <div class="cheque__row">
            <div class="cheque__label">{{ __('payment.cheque_pay_to') }}</div>
            <div>{{ config('app.name', 'JeWeblryStore') }}</div>
        </div>

        <div class="cheque__row">
            <div class="cheque__label">{{ __('payment.amount') }}</div>
            <div class="cheque__amount">${{ number_format($viewData['payment']->getAmount(), 2) }}</div>
        </div>

        <div class="cheque__row">
            <div class="cheque__label">{{ __('payment.cheque_concept') }}</div>
            <div>{{ __('payment.order_number') }} #{{ $viewData['order']->getId() }}</div>
        </div>

        <div class="cheque__signature">
            {{ $viewData['customer']->getName() }} {{ $viewData['customer']->getLastNames() }}
        </div>
    </div>
</body>

</html>
