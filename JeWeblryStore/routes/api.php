<?php

use App\Http\Controllers\Api\JewelApiController;
use Illuminate\Support\Facades\Route;

// Servicio Json para ser consumido por el otro equipo
Route::get('/jewels', [JewelApiController::class, 'index'])->name('api.jewels.index');
