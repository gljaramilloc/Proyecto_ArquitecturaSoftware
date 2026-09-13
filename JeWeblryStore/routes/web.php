<?php

use App\Http\Controllers\HomeController; 
use Illuminate\Support\Facades\Route;

// Rutas estáticas
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');