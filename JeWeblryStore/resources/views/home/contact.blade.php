{{-- Extend the main application layout --}}
@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/pages/home/contact.css') }}" rel="stylesheet">
@endpush

{{-- Define the page title and subtitle --}}
@section('title', 'Contact - Online Store')
@section('subtitle', 'Contact')

{{-- Define the main content section --}}
@section('content')
    <div class="container">
        <h2>{{ __('home.contact_name') }}</h2>
        <p>{{ __('home.contact_address') }}</p>
        <p>{{ __('home.contact_phone') }}</p>
    </div>
@endsection