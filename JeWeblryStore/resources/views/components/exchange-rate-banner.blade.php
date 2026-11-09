@props(['quote' => null])

@if ($quote !== null)
    <div class="exchange-rate-banner shadow-sm px-3 py-2 mb-4" role="status">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="badge exchange-rate-badge px-2 py-1">
                    <i class="bi bi-currency-exchange me-1" aria-hidden="true"></i>{{ __('currency.badge_label') }}
                </span>
                <span class="fw-semibold text-dark small">
                    {{ __('currency.rate_format', [
                        'base' => $quote->getBaseCurrency(),
                        'rate' => number_format($quote->getRate(), 2),
                        'target' => $quote->getTargetCurrency(),
                    ]) }}
                </span>
                @if ($quote->getUpdatedAtLabel() !== null)
                    <span class="text-muted small">
                        ({{ __('currency.updated_date', ['date' => $quote->getUpdatedAtLabel()]) }})
                    </span>
                @endif
            </div>
            <span class="text-muted small">{{ __('currency.reference_note') }}</span>
        </div>
    </div>
@else
    <div class="exchange-rate-banner--offline px-3 py-2 mb-4" role="status">
        <div class="d-flex align-items-center gap-2 text-muted small">
            <i class="bi bi-cloud-slash" aria-hidden="true"></i>
            <span>{{ __('currency.unavailable_short') }}</span>
        </div>
    </div>
@endif
