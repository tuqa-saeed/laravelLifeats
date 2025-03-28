<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\StartSession;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes for registration and login
    Route::post('/register', [RegisteredUserController::class, 'registerUser']);
    Route::post('/login', [AuthenticatedSessionController::class, 'loginUser']);
    
    
    
    
// Logout route

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');

// Sanctum protected routes
    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $request->user();
    });
    Route::put('/user', [UserController::class, 'updateUserProfile']);
    Route::get('/user', [UserController::class, 'getUserProfile']);


    // For TESTing purposes - consider removing in production
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
});
