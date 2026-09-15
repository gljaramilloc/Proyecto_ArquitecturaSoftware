@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Create Category</h1>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                        @error('slug') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                        @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Status</label>
                        <select name="status_id" class="form-select" required>
                            @foreach ($viewData['statuses'] as $status)
                                <option value="{{ $status->getId() }}" {{ old('status_id') == $status->getId() ? 'selected' : '' }}>
                                    {{ $status->getName() }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-brand">Save</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-link">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection