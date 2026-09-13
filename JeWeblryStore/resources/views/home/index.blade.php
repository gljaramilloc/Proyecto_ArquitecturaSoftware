{{-- Extend the main application layout --}}
@extends('layouts.app')

{{-- Define the page title --}}
@section('title', 'Home Page - Online Store')

{{-- Define the main content section --}}
@section('content')
    <div class="text-center">
        <h1>Welcome to the application</h1>
    </div>
@endsection

{{-- Display error message from session if it exists --}}
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif