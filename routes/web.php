<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\UserController;

// لا تستخدمه ابدا كأنه غير موجود
// روح الى api.php

// Route::apiResource('products', ProductsController::class);
/* use Illuminate\Support\Facades\Session;

Route::get('/set-session', function () {
    Session::put('user', 'Toqa');
    return response()->json(['message' => 'Session set!']);
});

Route::get('/get-session', function () {
    return response()->json(['session_data' => session()->all()]);
}); */

Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::get('/login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');

Route::get('/profile', [UserProfileController::class, 'showProfile'])->name('profile')->middleware('auth');


