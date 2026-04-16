<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Public routes (không cần login)
|--------------------------------------------------------------------------
*/

// Trang chủ (ai cũng vào được)
Route::get('/home', [AuthController::class, 'home'])->name('home');


//Sản phẩm 
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google login
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Trang public
Route::get('/services', function () {
    return view('layouts.services');
})->name('services');

Route::get('/contact', function () {
    return view('layouts.contact');
})->name('contact');

Route::post('/contact', function () {
    return back()->with('success', 'Gửi liên hệ thành công!');
})->name('contact.submit');


/*
|--------------------------------------------------------------------------
| Protected routes (phải login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Trang home sau login (nếu bạn muốn riêng)
    Route::get('/dashboard', [AuthController::class, 'home'])->name('dashboard');

});
