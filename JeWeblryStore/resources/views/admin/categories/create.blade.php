@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-5">
        @include('admin.partials.nav')

        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <nav aria-label="{{ __('catalog.breadcrumb') }}" class="mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('admin.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ __('admin.categories') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.create_category') }}</li>
                    </ol>
                </nav>

                <h1 class="font-display h3 mb-4 text-dark">{{ __('admin.create_category') }}</h1>

                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.name') }}</label>
                                <input id="name" type="text" name="name" maxlength="255" class="form-control rounded-0 shadow-none @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.slug') }}</label>
                                <input id="slug" type="text" name="slug" maxlength="255" placeholder="{{ __('admin.slug_placeholder') }}" class="form-control rounded-0 shadow-none @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.description') }}</label>
                                <textarea id="description" name="description" class="form-control rounded-0 shadow-none @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="status_id" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.status') }}</label>
                                <select id="status_id" name="status_id" class="form-select rounded-0 shadow-none @error('status_id') is-invalid @enderror" required>
                                    <option value="" disabled {{ old('status_id') ? '' : 'selected' }}>{{ __('admin.select_status') }}</option>
                                    @foreach ($viewData['statuses'] as $status)
                                        <option value="{{ $status->getId() }}" {{ (string) old('status_id') === (string) $status->getId() ? 'selected' : '' }}>
                                            {{ __('status.'.$status->getName()) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-3 pt-2">
                                <button type="submit" class="btn btn-brand px-4 py-2">{{ __('admin.save') }}</button>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-brand-outline px-4 py-2">{{ __('admin.cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
