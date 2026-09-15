@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="text-brand-gold text-uppercase fw-bold small mb-1">Administration</p>
                <h1 class="h2 font-display text-dark mb-0">Admin Dashboard</h1>
            </div>
            <a href="{{ route('home.index') }}" class="btn btn-outline-dark rounded-0">Back to store</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-5">
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-people fs-2 text-brand-gold"></i>
                        <p class="text-muted text-uppercase small fw-bold mt-3 mb-1">Users</p>
                        <p class="display-6 mb-0">{{ $viewData['userCount'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-gem fs-2 text-brand-gold"></i>
                        <p class="text-muted text-uppercase small fw-bold mt-3 mb-1">Jewels</p>
                        <p class="display-6 mb-0">{{ $viewData['jewelCount'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-tags fs-2 text-brand-gold"></i>
                        <p class="text-muted text-uppercase small fw-bold mt-3 mb-1">Categories</p>
                        <p class="display-6 mb-0">{{ $viewData['categoryCount'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-bag-check fs-2 text-brand-gold"></i>
                        <p class="text-muted text-uppercase small fw-bold mt-3 mb-1">Orders</p>
                        <p class="display-6 mb-0">{{ $viewData['orderCount'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ route('admin.users.index') }}" class="card h-100 border shadow-sm text-decoration-none text-dark">
                    <div class="card-body">
                        <h2 class="h5">Manage Users</h2>
                        <p class="text-muted mb-0">Grant or revoke administrator access.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.jewels.index') }}" class="card h-100 border shadow-sm text-decoration-none text-dark">
                    <div class="card-body">
                        <h2 class="h5">Manage Jewels</h2>
                        <p class="text-muted mb-0">Create, edit, and manage inventory.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.categories.index') }}" class="card h-100 border shadow-sm text-decoration-none text-dark">
                    <div class="card-body">
                        <h2 class="h5">Manage Categories</h2>
                        <p class="text-muted mb-0">Organize the store catalog.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
