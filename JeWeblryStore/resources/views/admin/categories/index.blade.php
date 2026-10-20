@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 font-display text-dark mb-0">{{ __('admin.manage_categories') }}</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-brand rounded-0 px-4 py-2 text-uppercase small fw-bold">{{ __('admin.new_category') }}</a>
        </div>

        <div class="card border shadow-sm rounded-0 bg-white">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-uppercase small text-muted">
                                <th>{{ __('admin.id') }}</th>
                                <th>{{ __('admin.name') }}</th>
                                <th>{{ __('admin.slug') }}</th>
                                <th>{{ __('admin.status') }}</th>
                                <th class="text-end">{{ __('admin.actions') }}</th>
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
                                                {{ $category->getStatus() ? __('status.'.$category->getStatus()->getName()) : __('admin.not_available') }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.categories.edit', $category->getId()) }}" class="btn btn-sm btn-outline-dark rounded-0 px-2 py-1" title="{{ __('admin.edit') }}">
                                                <i class="bi bi-pencil"></i> {{ __('admin.edit') }}
                                            </a>

                                            <form action="{{ route('admin.categories.destroy', $category->getId()) }}" method="POST" onsubmit="return confirm(@js(__('admin.confirm_delete_category')));">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-0 px-2 py-1" title="{{ __('admin.delete') }}" aria-label="{{ __('admin.delete') }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">{{ __('admin.no_categories') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection