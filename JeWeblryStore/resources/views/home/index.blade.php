@extends('layouts.app')

@section('title', 'Home')

@section('content')

    @include('home.sections.hero-carousel')
    @include('home.sections.about-store')
    @include('home.sections.trust-strip')
    @include('home.sections.featured-jewels')

    @push('scripts')
        <script src="{{ asset('js/home.js') }}" defer></script>
    @endpush

@endsection