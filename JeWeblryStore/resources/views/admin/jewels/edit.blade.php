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
                        <li class="breadcrumb-item"><a href="{{ route('admin.jewels.index') }}">{{ __('admin.jewels') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.edit_jewel') }}</li>
                    </ol>
                </nav>

                <h1 class="font-display h3 mb-4 text-dark">{{ __('admin.edit_jewel') }}</h1>

                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.jewels.update', $viewData['jewel']->getId()) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.name') }}</label>
                                <input id="name" type="text" name="name" maxlength="255" class="form-control rounded-0 shadow-none @error('name') is-invalid @enderror" value="{{ old('name', $viewData['jewel']->getName()) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.price') }}</label>
                                    <input id="price" type="number" step="0.01" min="0" name="price" class="form-control rounded-0 shadow-none @error('price') is-invalid @enderror" value="{{ old('price', $viewData['jewel']->getPrice()) }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stock" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.stock') }}</label>
                                    <input id="stock" type="number" step="1" min="0" name="stock" class="form-control rounded-0 shadow-none @error('stock') is-invalid @enderror" value="{{ old('stock', $viewData['jewel']->getStock()) }}" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.description') }}</label>
                                <textarea id="description" name="description" class="form-control rounded-0 shadow-none @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $viewData['jewel']->getDescription()) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="material" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.material') }}</label>
                                <input id="material" type="text" name="material" maxlength="255" class="form-control rounded-0 shadow-none @error('material') is-invalid @enderror" value="{{ old('material', $viewData['jewel']->getMaterial()) }}" required>
                                @error('material')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.category') }}</label>
                                    <select id="category_id" name="category_id" class="form-select rounded-0 shadow-none @error('category_id') is-invalid @enderror" required>
                                        @foreach ($viewData['categories'] as $category)
                                            <option
                                                value="{{ $category->getId() }}"
                                                {{ (string) old('category_id', $viewData['jewel']->getCategoryId()) === (string) $category->getId() ? 'selected' : '' }}
                                            >
                                                {{ $category->getName() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status_id" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.status') }}</label>
                                    <select id="status_id" name="status_id" class="form-select rounded-0 shadow-none @error('status_id') is-invalid @enderror" required>
                                        @foreach ($viewData['statuses'] as $status)
                                            <option
                                                value="{{ $status->getId() }}"
                                                {{ (string) old('status_id', $viewData['jewel']->getStatusId()) === (string) $status->getId() ? 'selected' : '' }}
                                            >
                                                {{ __('status.'.$status->getName()) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if ($viewData['jewel']->getImage())
                                <div class="mb-3">
                                    <span class="form-label fw-bold text-uppercase small text-muted d-block">{{ __('admin.current_image') }}</span>
                                    <img src="{{ Storage::url($viewData['jewel']->getImage()) }}" alt="{{ $viewData['jewel']->getName() }}" class="img-thumbnail rounded-0" width="150">
                                </div>
                            @endif

                            <div class="mb-4">
                                <label for="image" class="form-label fw-bold text-uppercase small text-muted">{{ __('admin.replace_image') }}</label>
                                <input id="image" type="file" name="image" aria-describedby="image-hint" class="form-control rounded-0 shadow-none @error('image') is-invalid @enderror" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="image-hint" class="form-text">{{ __('admin.image_hint') }}</div>
                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-3 pt-2">
                                <button type="submit" class="btn btn-brand px-4 py-2">{{ __('admin.update') }}</button>
                                <a href="{{ route('admin.jewels.index') }}" class="btn btn-brand-outline px-4 py-2">{{ __('admin.cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
