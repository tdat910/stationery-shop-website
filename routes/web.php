<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Route để hiển thị home (danh sách sản phẩm)
Route::get('/home', [ProductController::class, 'home'])->middleware('guest_or_user')->name('home');
Route::get('/products', [ProductController::class, 'index'])->middleware('guest_or_user')->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->middleware('guest_or_user')->name('products.show');

// Route cho Authentication
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Route cho User (sau khi đăng nhập)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    // Các route khác cho User
});

// Route cho Admin (sau khi đăng nhập với role admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Quản lý sản phẩm
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products.index');
    Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.destroy');

    // Quản lý người dùng
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');

    // Quản lý đơn hàng
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::put('/admin/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update-status');

    // Quản lý danh mục
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories.index');
    Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/admin/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/admin/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.destroy');
});
