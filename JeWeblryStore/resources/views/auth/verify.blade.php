@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/auth/verify.css') }}" rel="stylesheet">
@endpush

@section('title', __('Verify Your Email Address'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h1 class="font-display h3 text-dark mb-4">{{ __('Verify Your Email Address') }}</h1>

                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p class="text-muted mb-4">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                        </p>

                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-brand px-4 py-2">{{ __('click here to request another') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
