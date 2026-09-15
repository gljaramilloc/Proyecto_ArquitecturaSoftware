<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminJewelController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JewelController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Static routes
Route::get('/', [HomeController::class, 'index'])->name('home.index');

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

// Order history routes (authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// Cart routes (authenticated users only)
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/buy/{id}', [CartController::class, 'buyNow'])->name('cart.buyNow');
    Route::get('/cart/removeAll', [CartController::class, 'removeAll'])->name('cart.removeAll');
    Route::post('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');
});

/*
|--------------------------------------------------------------------------
| Storefront (public catalog)
|--------------------------------------------------------------------------
*/
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// The listing/search route must come before {jewel} to avoid segment collisions.
Route::get('/jewels', [JewelController::class, 'index'])->name('jewels.index');
Route::get('/jewels/{jewel}', [JewelController::class, 'show'])->name('jewels.show');

/*
|--------------------------------------------------------------------------
| Administration section (fully separated from the storefront)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::patch('categories/{category}/toggle-status', [AdminCategoryController::class, 'toggleStatus'])
        ->name('categories.toggleStatus');

    Route::resource('jewels', AdminJewelController::class)->except(['show']);
    Route::patch('jewels/{jewel}/toggle-status', [AdminJewelController::class, 'toggleStatus'])
        ->name('jewels.toggleStatus');
});
