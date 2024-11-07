<?php

use App\Http\Controllers\API\salidaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas de la tabla 'Producto'


// Rutas de la tabla 'Entrada'


// Rutas de la tabla 'Salida'
Route::get('/salidas', [salidaController::class, 'index']);
Route::post('/salidas', [salidaController::class, 'store']);
Route::get('/salidas/{id}', [salidaController::class, 'show']);
Route::delete('/salidas/{id}', [salidaController::class, 'destroy']);
Route::put('/salidas/{id}', [salidaController::class, 'update']);
Route::patch('/salidas/{id}', [salidaController::class, 'updatePartial']);

// Rutas de la tabla 'Informes'
