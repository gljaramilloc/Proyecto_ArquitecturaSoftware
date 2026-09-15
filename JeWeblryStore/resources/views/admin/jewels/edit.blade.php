@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Edit Jewel</h1>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.jewels.update', $viewData['jewel']->getId()) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $viewData['jewel']->getName()) }}" required>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $viewData['jewel']->getPrice()) }}" required>
                            @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock', $viewData['jewel']->getStock()) }}" required>
                            @error('stock') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" required>{{ old('description', $viewData['jewel']->getDescription()) }}</textarea>
                        @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Material</label>
                        <input type="text" name="material" class="form-control" value="{{ old('material', $viewData['jewel']->getMaterial()) }}" required>
                        @error('material') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                @foreach ($viewData['categories'] as $category)
                                    <option
                                        value="{{ $category->getId() }}"
                                        {{ old('category_id', $viewData['jewel']->getCategoryId()) == $category->getId() ? 'selected' : '' }}
                                    >
                                        {{ $category->getName() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status_id" class="form-select" required>
                                @foreach ($viewData['statuses'] as $status)
                                    <option
                                        value="{{ $status->getId() }}"
                                        {{ old('status_id', $viewData['jewel']->getStatusId()) == $status->getId() ? 'selected' : '' }}
                                    >
                                        {{ $status->getName() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    @if ($viewData['jewel']->getImage())
                        <div class="mb-3">
                            <img src="{{ Storage::url($viewData['jewel']->getImage()) }}" alt="{{ $viewData['jewel']->getName() }}" class="img-thumbnail" width="150">
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="form-label">Replace image (optional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-brand">Update</button>
                    <a href="{{ route('admin.jewels.index') }}" class="btn btn-link">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection