<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CotizadorController;

Route::get('/', [CotizadorController::class, 'index']);
Route::post('/calcular', [CotizadorController::class, 'calcular'])->name('calcular');
