<?php

use App\Http\Controllers\API\salidaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas de la tabla 'Producto'


// Rutas de la tabla 'Entrada'


// Rutas de la tabla 'Salida'
Route::get('/salidas', [salidaController::class, 'index']);
Route::post('/salidas', [salidaController::class, 'store']);

// Rutas de la tabla 'Informes'
