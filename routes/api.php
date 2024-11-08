<?php

use App\Http\Controllers\API\productoController;
use App\Http\Controllers\API\entradaController;
use App\Http\Controllers\API\salidaController;
use App\Http\Controllers\API\informeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas de la tabla 'Producto'
Route::get('/productos', [productoController::class, 'index']);
Route::post('/productos', [productoController::class, 'store']);
Route::get('/productos/{id}', [productoController::class, 'show']);
Route::delete('/productos/{id}', [productoController::class, 'destroy']);
Route::put('/productos/{id}', [productoController::class, 'update']);
Route::patch('/productos/{id}', [productoController::class, 'updatePartial']);

// Rutas de la tabla 'Entrada'
Route::get('/entradas', [entradaController::class, 'index']);
Route::post('/entradas', [entradaController::class, 'store']);
Route::get('/entradas/{id}', [entradaController::class, 'show']);
Route::delete('/entradas/{id}', [entradaController::class, 'destroy']);
Route::put('/entradas/{id}', [entradaController::class, 'update']);
Route::patch('/entradas/{id}', [entradaController::class, 'updatePartial']);

// Rutas de la tabla 'Salida'
Route::get('/salidas', [salidaController::class, 'index']);
Route::post('/salidas', [salidaController::class, 'store']);
Route::get('/salidas/{id}', [salidaController::class, 'show']);
Route::delete('/salidas/{id}', [salidaController::class, 'destroy']);
Route::put('/salidas/{id}', [salidaController::class, 'update']);
Route::patch('/salidas/{id}', [salidaController::class, 'updatePartial']);

// Rutas de la tabla 'Informes'
Route::get('/informes', [informeController::class, 'index']);
Route::get('/informes/{id}', [informeController::class, 'show']);
Route::post('/informes', [informeController::class, 'store']);
Route::delete('/informes/{id}', [informeController::class, 'destroy']);
Route::put('/informes/{id}', [informeController::class, 'update']);
Route::patch('/informes/{id}', [informeController::class, 'updatePartial']);

