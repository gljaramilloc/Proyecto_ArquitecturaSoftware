<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
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

// Profile routes (authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Payment routes (authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/orders/{orderId}/payment/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/orders/{orderId}/payment', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/orders/{orderId}/payment', [PaymentController::class, 'show'])->name('payments.show');
});
