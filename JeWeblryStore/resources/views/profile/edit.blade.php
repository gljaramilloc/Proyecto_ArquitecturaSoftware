@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/profile/edit.css') }}" rel="stylesheet">
@endpush

@section('title', __('profile.title'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ __('profile.title') }}</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>{{ __('profile.name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $viewData['user']->getName()) }}">
                </div>

                <div class="mb-3">
                    <label>{{ __('profile.last_names') }}</label>
                    <input type="text" name="lastNames" class="form-control" value="{{ old('lastNames', $viewData['user']->getLastNames()) }}">
                </div>

                <div class="mb-3">
                    <label>{{ __('profile.phone_number') }}</label>
                    <input type="text" name="phoneNumber" class="form-control" value="{{ old('phoneNumber', $viewData['user']->getPhoneNumber()) }}">
                </div>

                <div class="mb-3">
                    <label>{{ __('profile.address') }}</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $viewData['user']->getAddress()) }}">
                </div>

                <button type="submit" class="btn btn-primary">{{ __('profile.save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection