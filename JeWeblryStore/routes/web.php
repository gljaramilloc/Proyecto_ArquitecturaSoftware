<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Static routes
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

// Language switch route
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// Authentication routes
Auth::routes();
