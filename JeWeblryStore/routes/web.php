<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminJewelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JewelController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Static routes
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Authentication routes
Auth::routes();

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
