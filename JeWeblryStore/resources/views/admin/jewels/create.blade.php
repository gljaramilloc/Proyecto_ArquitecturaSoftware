@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">

                <h1 class="font-display h3 mb-4 text-dark">Create Jewel</h1>

                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('admin.jewels.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold text-uppercase small text-muted">Name</label>
                                <input type="text" name="name" class="form-control rounded-0 shadow-none @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-uppercase small text-muted">Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control rounded-0 shadow-none @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                                    @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-uppercase small text-muted">Stock</label>
                                    <input type="number" name="stock" class="form-control rounded-0 shadow-none @error('stock') is-invalid @enderror" value="{{ old('stock') }}" required>
                                    @error('stock') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-uppercase small text-muted">Description</label>
                                <textarea name="description" class="form-control rounded-0 shadow-none @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                                @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-uppercase small text-muted">Material</label>
                                <input type="text" name="material" class="form-control rounded-0 shadow-none @error('material') is-invalid @enderror" value="{{ old('material') }}" required>
                                @error('material') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-uppercase small text-muted">Category</label>
                                    <select name="category_id" class="form-select rounded-0 shadow-none @error('category_id') is-invalid @enderror" required>
                                        <option value="" selected disabled>Select a category</option>
                                        @foreach ($viewData['categories'] as $category)
                                            <option value="{{ $category->getId() }}" {{ old('category_id') == $category->getId() ? 'selected' : '' }}>
                                                {{ $category->getName() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-uppercase small text-muted">Status</label>
                                    <select name="status_id" class="form-select rounded-0 shadow-none @error('status_id') is-invalid @enderror" required>
                                        <option value="" selected disabled>Select a status</option>
                                        @foreach ($viewData['statuses'] as $status)
                                            <option value="{{ $status->getId() }}" {{ old('status_id') == $status->getId() ? 'selected' : '' }}>
                                                {{ $status->getName() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-uppercase small text-muted">Image</label>
                                <input type="file" name="image" class="form-control rounded-0 shadow-none @error('image') is-invalid @enderror" accept="image/*">
                                @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-flex align-items-center gap-3 pt-2">
                                <button type="submit" class="btn btn-brand px-4 py-2 rounded-0">Save</button>
                                <a href="{{ route('admin.jewels.index') }}" class="text-decoration-none text-muted">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection