@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 font-display text-dark mb-0">Manage Categories</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-brand rounded-0 px-4 py-2 text-uppercase small fw-bold">New Category</a>
        </div>

        <div class="card border shadow-sm rounded-0 bg-white">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-uppercase small text-muted">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($viewData['categories'] as $category)
                                <tr>
                                    <td>{{ $category->getId() }}</td>
                                    <td class="fw-bold">{{ $category->getName() }}</td>
                                    <td class="text-muted small">{{ $category->getSlug() }}</td>
                                    <td>
                                        <form action="{{ route('admin.categories.toggleStatus', $category->getId()) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $category->isActive() ? 'btn-success' : 'btn-secondary' }} rounded-0 px-2 py-1 small">
                                                {{ $category->getStatus()?->getName() ?? 'N/A' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.categories.edit', $category->getId()) }}" class="btn btn-sm btn-outline-dark rounded-0 px-2 py-1" title="Edit">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>

                                            <form action="{{ route('admin.categories.destroy', $category->getId()) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-0 px-2 py-1" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No categories registered.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection