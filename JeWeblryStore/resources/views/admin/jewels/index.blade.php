@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-5">
        @include('admin.partials.nav')

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-brand-gold text-uppercase fw-bold small mb-1">{{ __('admin.administration') }}</p>
                <h1 class="h2 font-display text-dark mb-0">{{ __('admin.manage_jewels') }}</h1>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.index') }}" class="btn btn-brand-outline">{{ __('admin.back_to_dashboard') }}</a>
                <a href="{{ route('admin.jewels.create') }}" class="btn btn-brand">
                    <i class="bi bi-plus-lg me-1"></i>{{ __('admin.new_jewel') }}
                </a>
            </div>
        </div>

        <div class="card border shadow-sm rounded-0 bg-white">
            <div class="table-responsive p-3">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr class="text-uppercase small text-muted">
                            <th scope="col">{{ __('admin.image') }}</th>
                            <th scope="col">{{ __('admin.name') }}</th>
                            <th scope="col">{{ __('admin.category') }}</th>
                            <th scope="col">{{ __('admin.price') }}</th>
                            <th scope="col">{{ __('admin.stock') }}</th>
                            <th scope="col">{{ __('admin.status') }}</th>
                            <th scope="col" class="text-end">{{ __('admin.actions') }}</th>
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
                                    <x-status-badge :status="$jewel->getStatus()" />
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

        <div class="d-flex justify-content-center mt-4">
            {{ $viewData['jewels']->links() }}
        </div>
    </div>
@endsection
