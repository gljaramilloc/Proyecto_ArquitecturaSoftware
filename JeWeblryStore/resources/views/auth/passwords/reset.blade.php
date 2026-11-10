@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/auth/passwords/reset.css') }}" rel="stylesheet">
@endpush

@section('title', __('auth.reset_password'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h1 class="font-display h3 text-dark mb-0">{{ __('auth.reset_password') }}</h1>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold text-uppercase small text-muted">{{ __('auth.email_address') }}</label>
                                <input id="email" type="email" maxlength="255" class="form-control rounded-0 shadow-none @error('email') is-invalid @enderror" name="email" value="{{ old('email', $email ?? '') }}" required autocomplete="email" autofocus>
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
                                {{ __('auth.reset_password') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
