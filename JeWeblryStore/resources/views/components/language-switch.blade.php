{{-- Reusable language switch component: toggles between EN and ES locales --}}
@php
    $currentLocale = app()->getLocale();
    $isSpanish = $currentLocale === 'es';
    $targetLocale = $isSpanish ? 'en' : 'es';
@endphp

<form action="{{ route('lang.switch', ['locale' => $targetLocale]) }}" method="GET" class="language-switch d-flex align-items-center gap-2 mx-2">
    <span class="language-switch__label text-secondary {{ ! $isSpanish ? 'fw-bold' : '' }}">EN</span>

    <button type="submit" class="language-switch__toggle {{ $isSpanish ? 'is-es' : '' }}" role="switch" aria-checked="{{ $isSpanish ? 'true' : 'false' }}" aria-label="{{ __('Toggle language') }}">
        <span class="language-switch__knob"></span>
    </button>

    <span class="language-switch__label text-secondary {{ $isSpanish ? 'fw-bold' : '' }}">ES</span>
</form>
