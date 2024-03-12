<?php

use App\Http\Controllers\admin as admin;
use App\Http\Controllers\CartController;
use App\Http\Controllers\open as open;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [open\homeController::class, 'index'])->name('home');

// Cart routes definitions.

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::put('/cart/update/{rowId}', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/price', [CartController::class, 'getCartPrice'])->name('cart.price');

// Product routes definitions for users.

Route::get('/products', [open\ProductController::class, 'index'])->name('open.products.index');
Route::get('/products/{product}', [open\ProductController::class, 'show'])->name('open.products.show');

// Routes for admin, only accessible by users with the admin role.

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::resource('admin/product', admin\ProductController::class);
    Route::resource('admin/users', admin\UserController::class);
    Route::resource('admin/category', admin\CategoryController::class);
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');


// Profile routes definitions.

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
