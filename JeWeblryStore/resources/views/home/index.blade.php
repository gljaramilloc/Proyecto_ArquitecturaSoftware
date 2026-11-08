@extends('layouts.app')

@section('title', __('home.title'))

@push('styles')
    <link href="{{ asset('css/pages/home/index.css') }}" rel="stylesheet">
@endpush

@section('content')

    @include('home.sections.top-banner')
    @include('home.sections.hero-carousel')
    @include('home.sections.about-store')
    @include('home.sections.promo-banner')
    @include('home.sections.trust-strip')
    @include('home.sections.featured-jewels')

    @push('scripts')
        <script src="{{ asset('js/home.js') }}" defer></script>
    @endpush

@endsection