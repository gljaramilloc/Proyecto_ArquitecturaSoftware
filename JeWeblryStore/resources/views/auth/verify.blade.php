@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/auth/verify.css') }}" rel="stylesheet">
@endpush

@section('title', __('auth.verify_email'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h1 class="font-display h3 text-dark mb-4">{{ __('auth.verify_email') }}</h1>

                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('auth.verification_link_sent') }}
                            </div>
                        @endif

                        <p class="text-muted mb-4">
                            {{ __('auth.check_email_verification') }}
                            {{ __('auth.did_not_receive_email') }},
                        </p>

                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-brand px-4 py-2">{{ __('auth.request_another_verification') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
