<form action="{{ route('lang.switch', ['locale' => app()->getLocale() === 'es' ? 'en' : 'es']) }}" method="GET"
    class="language-switch d-flex align-items-center gap-2 mx-2">
    <span class="language-switch__label {{ app()->getLocale() !== 'es' ? 'fw-bold' : '' }}">EN</span>

    <button type="submit" class="language-switch__toggle {{ app()->getLocale() === 'es' ? 'is-es' : '' }}" role="switch"
        aria-checked="{{ app()->getLocale() === 'es' ? 'true' : 'false' }}" aria-label="{{ __('Toggle language') }}">
        <span class="language-switch__knob"></span>
    </button>

    <span class="language-switch__label {{ app()->getLocale() === 'es' ? 'fw-bold' : '' }}">ES</span>
</form>