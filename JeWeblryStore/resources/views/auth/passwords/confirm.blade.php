@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/auth/passwords/confirm.css') }}" rel="stylesheet">
@endpush

@section('title', __('Confirm Password'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-3">
                            <h1 class="font-display h3 text-dark mb-2">{{ __('Confirm Password') }}</h1>
                            <p class="text-muted small mb-0">{{ __('Please confirm your password before continuing.') }}</p>
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold text-uppercase small text-muted">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control rounded-0 shadow-none @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-brand w-100 py-2">
                                {{ __('Confirm Password') }}
                            </button>

                            @if (Route::has('password.request'))
                                <div class="text-center mt-3">
                                    <a class="small text-brand-gold fw-semibold text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
