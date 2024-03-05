<?php

use App\Http\Controllers\admin as admin;
use App\Http\Controllers\open as open;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [open\homeController::class, 'index'])->name('home');

Route::get('/products', [open\ProductController::class, 'index'])->name('open.products.index');
Route::get('/products/{product}', [open\ProductController::class, 'show'])->name('open.products.show');
Route::get('search/{term}', [open\ProductController::class, 'search'])->name('open.products.search');

Route::get('/about', function () {
    return 'About page.';
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::resource('admin/products', admin\ProductController::class);
    Route::resource('admin/users', admin\UserController::class);
});



Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
