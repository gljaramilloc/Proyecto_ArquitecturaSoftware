@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Manage Jewels</h1>
            <a href="{{ route('admin.jewels.create') }}" class="btn btn-brand">
                <i class="bi bi-plus-lg"></i> New Jewel
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($viewData['jewels'] as $jewel)
                            <tr>
                                <td class="admin-jewel-thumb-cell">
                                    @if ($jewel->getImage())
                                        <img src="{{ Storage::url($jewel->getImage()) }}" alt="{{ $jewel->getName() }}" class="admin-jewel-thumb rounded">
                                    @else
                                        <div class="admin-jewel-thumb admin-jewel-thumb--placeholder bg-light rounded d-flex align-items-center justify-content-center text-muted">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $jewel->getName() }}</td>
                                <td>{{ $jewel->getCategory()?->getName() }}</td>
                                <td>${{ number_format($jewel->getPrice(), 2) }}</td>
                                <td>{{ $jewel->getStock() }}</td>
                                <td>
                                    <span class="badge {{ $jewel->isActive() ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $jewel->getStatus()?->getName() }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.jewels.edit', $jewel->getId()) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.jewels.toggleStatus', $jewel->getId()) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-warning">
                                            {{ $jewel->isActive() ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>

                                    <form
                                        action="{{ route('admin.jewels.destroy', $jewel->getId()) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this jewel? This action cannot be undone.');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No jewels registered yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection