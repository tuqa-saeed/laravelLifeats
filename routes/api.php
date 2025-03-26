<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

// For TESTing purposes
// --------------------------------------------------------------------
// Route::apiResource('products', ProductsController::class);
Route::post('/products', [ProductsController::class, 'store']);
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/{id}', [ProductsController::class, 'show']);
Route::put('/products/{id}', [ProductsController::class, 'update']);
Route::patch('/products/{id}', [ProductsController::class, 'update']);
Route::delete('/products/{id}', [ProductsController::class, 'destroy']);
// --------------------------------------------------------------------
// END
