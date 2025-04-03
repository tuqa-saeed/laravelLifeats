<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\UserController;

// لا تستخدمه ابدا كأنه غير موجود
// روح الى api.php

// Route::apiResource('products', ProductsController::class);
// use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Http\Controllers\GoogleController;


Route::get('login/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

