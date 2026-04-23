<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Route để hiển thị home (danh sách sản phẩm)
Route::get('/home', [ProductController::class, 'home'])->middleware('guest_or_user')->name('home');
Route::get('/products', [ProductController::class, 'index'])->middleware('guest_or_user')->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->middleware('guest_or_user')->name('products.show');
Route::get('/services', function () {
    return view('layouts.services');
});
Route::get('/contact', function () {
    return view('layouts.contact');
})->name('contact');
Route::post('/contact', [ProductController::class, 'submitContact'])->name('contact.submit');

// Hiển thị form
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

// Xử lý form
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Google OAuth routes
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Route cho User (sau khi đăng nhập)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'show'])->name('dashboard'); // Redirect to profile
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

Route::middleware(['auth'])->group(function () {
    // ========== GIỎ HÀNG ==========
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove-item');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
    Route::post('/cart/toggle-selected', [CartController::class, 'toggleSelected'])->name('cart.toggle-selected');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

    // ========== THANH TOÁN ==========
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.index');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');

    // ========== ĐƠN HÀNG CỦA USER ==========
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // ========== PROFILE ==========
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/add-address', [ProfileController::class, 'addAddress'])->name('profile.add-address');
    Route::delete('/profile/address/{id}', [ProfileController::class, 'deleteAddress'])->name('profile.delete-address');
});
