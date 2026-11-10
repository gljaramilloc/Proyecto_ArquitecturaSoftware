{{-- Admin section sub-navigation bar --}}
<nav aria-label="{{ __('admin.navigation_label') }}" class="admin-subnav shadow-sm p-2 px-3 mb-4 d-flex flex-wrap align-items-center justify-content-between gap-2">
    <div class="d-flex flex-wrap align-items-center gap-1">
        <a href="{{ route('admin.index') }}" class="admin-subnav__link {{ request()->routeIs('admin.index') ? 'admin-subnav__link--active' : '' }}">
            <i class="bi bi-speedometer2 me-1" aria-hidden="true"></i>{{ __('admin.dashboard') }}
        </a>
        <a href="{{ route('admin.users.index') }}" class="admin-subnav__link {{ request()->routeIs('admin.users.*') ? 'admin-subnav__link--active' : '' }}">
            <i class="bi bi-people me-1" aria-hidden="true"></i>{{ __('admin.users') }}
        </a>
        <a href="{{ route('admin.jewels.index') }}" class="admin-subnav__link {{ request()->routeIs('admin.jewels.*') ? 'admin-subnav__link--active' : '' }}">
            <i class="bi bi-gem me-1" aria-hidden="true"></i>{{ __('admin.jewels') }}
        </a>
        <a href="{{ route('admin.categories.index') }}" class="admin-subnav__link {{ request()->routeIs('admin.categories.*') ? 'admin-subnav__link--active' : '' }}">
            <i class="bi bi-tags me-1" aria-hidden="true"></i>{{ __('admin.categories') }}
        </a>
    </div>

    <a href="{{ route('home.index') }}" class="btn btn-sm btn-brand-outline py-1 px-3">
        <i class="bi bi-shop me-1" aria-hidden="true"></i>{{ __('admin.back_to_store') }}
    </a>
</nav>
