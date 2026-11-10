@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/auth/login.css') }}" rel="stylesheet">
@endpush

@section('title', __('auth.login'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h1 class="font-display h3 text-dark mb-0">{{ __('auth.login') }}</h1>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold text-uppercase small text-muted">{{ __('auth.email_address') }}</label>
                                <input id="email" type="email" maxlength="255" class="form-control rounded-0 shadow-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold text-uppercase small text-muted">{{ __('auth.password_label') }}</label>
                                <input id="password" type="password" class="form-control rounded-0 shadow-none @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="remember">
                                        {{ __('auth.remember_me') }}
                                    </label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a class="small text-brand-gold text-decoration-none fw-semibold" href="{{ route('password.request') }}">
                                        {{ __('auth.forgot_password') }}
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-brand w-100 py-2">
                                {{ __('auth.login') }}
                            </button>
                        </form>

                        @if (Route::has('register'))
                            <hr class="my-4">
                            <p class="text-center small text-muted mb-0">
                                {{ __('auth.no_account') }}
                                <a href="{{ route('register') }}" class="text-brand-gold fw-semibold text-decoration-none ms-1">{{ __('auth.register') }}</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
