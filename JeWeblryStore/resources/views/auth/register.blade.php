@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/auth/register.css') }}" rel="stylesheet">
@endpush

@section('title', __('auth.register'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h1 class="font-display h3 text-dark mb-0">{{ __('auth.register') }}</h1>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold text-uppercase small text-muted">{{ __('auth.name') }}</label>
                                <input id="name" type="text" maxlength="255" class="form-control rounded-0 shadow-none @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold text-uppercase small text-muted">{{ __('auth.email_address') }}</label>
                                <input id="email" type="email" maxlength="255" class="form-control rounded-0 shadow-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold text-uppercase small text-muted">{{ __('auth.password_label') }}</label>
                                <input id="password" type="password" minlength="8" aria-describedby="password-hint" class="form-control rounded-0 shadow-none @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div id="password-hint" class="form-text">{{ __('auth.password_min_hint') }}</div>
                            </div>

                            <div class="mb-4">
                                <label for="password-confirm" class="form-label fw-bold text-uppercase small text-muted">{{ __('auth.confirm_password') }}</label>
                                <input id="password-confirm" type="password" minlength="8" class="form-control rounded-0 shadow-none" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-brand w-100 py-2">
                                {{ __('auth.register') }}
                            </button>
                        </form>

                        @if (Route::has('login'))
                            <hr class="my-4">
                            <p class="text-center small text-muted mb-0">
                                {{ __('auth.already_registered') }}
                                <a href="{{ route('login') }}" class="text-brand-gold fw-semibold text-decoration-none ms-1">{{ __('auth.login') }}</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
