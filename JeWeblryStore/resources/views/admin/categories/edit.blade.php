@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">{{ __('admin.edit_category') }}</h1>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $viewData['category']->getId()) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">{{ __('admin.name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $viewData['category']->getName()) }}" required>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('admin.slug') }}</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $viewData['category']->getSlug()) }}" required>
                        @error('slug') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('admin.description') }}</label>
                        <textarea name="description" class="form-control" rows="3" required>{{ old('description', $viewData['category']->getDescription()) }}</textarea>
                        @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">{{ __('admin.status') }}</label>
                        <select name="status_id" class="form-select" required>
                            @foreach ($viewData['statuses'] as $status)
                                <option
                                    value="{{ $status->getId() }}"
                                    {{ old('status_id', $viewData['category']->getStatusId()) == $status->getId() ? 'selected' : '' }}
                                >
                                    {{ __('status.'.$status->getName()) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-brand">{{ __('admin.update') }}</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-link">{{ __('admin.cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection