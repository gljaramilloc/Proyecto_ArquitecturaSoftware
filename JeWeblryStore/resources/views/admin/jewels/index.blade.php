@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">{{ __('admin.manage_jewels') }}</h1>
            <a href="{{ route('admin.jewels.create') }}" class="btn btn-brand">
                <i class="bi bi-plus-lg"></i> {{ __('admin.new_jewel') }}
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>{{ __('admin.image') }}</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.category') }}</th>
                            <th>{{ __('admin.price') }}</th>
                            <th>{{ __('admin.stock') }}</th>
                            <th>{{ __('admin.status') }}</th>
                            <th class="text-end">{{ __('admin.actions') }}</th>
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
                                        {{ $jewel->getStatus() ? __('status.'.$jewel->getStatus()->getName()) : __('admin.not_available') }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.jewels.edit', $jewel->getId()) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> {{ __('admin.edit') }}
                                    </a>

                                    <form action="{{ route('admin.jewels.toggleStatus', $jewel->getId()) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-warning">
                                            {{ $jewel->isActive() ? __('admin.deactivate') : __('admin.activate') }}
                                        </button>
                                    </form>

                                    <form
                                        action="{{ route('admin.jewels.destroy', $jewel->getId()) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm(@js(__('admin.confirm_delete_jewel')));"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ __('admin.delete') }}" aria-label="{{ __('admin.delete') }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">{{ __('admin.no_jewels') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection