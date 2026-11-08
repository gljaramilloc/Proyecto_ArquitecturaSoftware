@extends('layouts.app')

@section('title', __('profile.title'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="h3 font-display mb-4">{{ __('profile.title') }}</h1>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4 d-flex flex-wrap justify-content-between gap-3">
                        <div>
                            <p class="text-muted small text-uppercase mb-1">{{ __('profile.email') }}</p>
                            <p class="fw-semibold mb-0">{{ $viewData['user']->getEmail() }}</p>
                        </div>
                        <div class="text-md-end">
                            <p class="text-muted small text-uppercase mb-1">{{ __('profile.balance') }}</p>
                            <p class="fw-bold text-brand-gold mb-0">${{ number_format($viewData['user']->getBalance(), 2) }}</p>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">{{ __('ui.validation_errors') }}</div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('profile.name') }} <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $viewData['user']->getName()) }}" maxlength="255" autocomplete="given-name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lastNames" class="form-label">{{ __('profile.last_names') }}</label>
                                <input type="text" id="lastNames" name="lastNames" class="form-control @error('lastNames') is-invalid @enderror" value="{{ old('lastNames', $viewData['user']->getLastNames()) }}" maxlength="255" autocomplete="family-name">
                                @error('lastNames')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">{{ __('profile.phone_number') }}</label>
                                <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control @error('phoneNumber') is-invalid @enderror" value="{{ old('phoneNumber', $viewData['user']->getPhoneNumber()) }}" maxlength="20" autocomplete="tel">
                                @error('phoneNumber')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="address" class="form-label">{{ __('profile.address') }}</label>
                                <textarea id="address" name="address" rows="2" class="form-control @error('address') is-invalid @enderror" maxlength="255" autocomplete="street-address">{{ old('address', $viewData['user']->getAddress()) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-brand">{{ __('profile.save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
