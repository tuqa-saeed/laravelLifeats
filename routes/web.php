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

Route::get('/login', function () {
    $user = User::find(1); 
    Auth::login($user);
    return redirect('/profile
    '); 
});
