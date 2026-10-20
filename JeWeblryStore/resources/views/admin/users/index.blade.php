@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-brand-gold text-uppercase fw-bold small mb-1">{{ __('admin.administration') }}</p>
                <h1 class="h2 font-display text-dark mb-0">{{ __('admin.manage_users') }}</h1>
            </div>
            <a href="{{ route('admin.index') }}" class="btn btn-outline-dark rounded-0">{{ __('admin.back_to_dashboard') }}</a>
        </div>

        <div class="card border shadow-sm rounded-0 bg-white">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-uppercase small text-muted">
                                <th>{{ __('admin.user_name') }}</th>
                                <th>{{ __('admin.email') }}</th>
                                <th>{{ __('admin.role') }}</th>
                                <th class="text-end">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($viewData['users'] as $user)
                                <tr>
                                    <td class="fw-bold">{{ $user->getName() }} {{ $user->getLastNames() }}</td>
                                    <td>{{ $user->getEmail() }}</td>
                                    <td>
                                        <span class="badge {{ $user->isAdmin() ? 'bg-dark' : 'bg-secondary' }}">
                                            {{ __('admin.'.$user->getRole()) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        @if (Auth::id() !== $user->getId())
                                            <form action="{{ route('admin.users.updateRole', $user->getId()) }}" method="POST" class="d-inline-flex align-items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" class="form-select form-select-sm" aria-label="{{ __('admin.select_user_role') }}">
                                                    <option value="customer" {{ $user->isCustomer() ? 'selected' : '' }}>{{ __('admin.customer') }}</option>
                                                    <option value="admin" {{ $user->isAdmin() ? 'selected' : '' }}>{{ __('admin.admin') }}</option>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-outline-dark">{{ __('admin.save_role') }}</button>
                                            </form>
                                        @else
                                            <span class="text-muted small">{{ __('admin.current_account') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">{{ __('admin.no_users') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
