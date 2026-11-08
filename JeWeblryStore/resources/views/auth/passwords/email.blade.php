@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/auth/passwords/email.css') }}" rel="stylesheet">
@endpush

@section('title', __('Reset Password'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h1 class="font-display h3 text-dark mb-0">{{ __('Reset Password') }}</h1>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold text-uppercase small text-muted">{{ __('Email Address') }}</label>
                                <input id="email" type="email" maxlength="255" class="form-control rounded-0 shadow-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-brand w-100 py-2">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </form>

                        @if (Route::has('login'))
                            <hr class="my-4">
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="small text-brand-gold fw-semibold text-decoration-none">
                                    &larr; {{ __('auth.back_to_login') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
