@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/home/about.css') }}" rel="stylesheet">
@endpush

@section('title', 'About us - Online Store')
@section('subtitle', 'About us')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 ms-auto">
            <p class="lead">{{ __('home.about_lead') }}</p>
        </div>
        <div class="col-lg-4 me-auto">
            <p class="lead">{{ __('home.about_author') }}</p>
        </div>
    </div>
</div>
@endsection