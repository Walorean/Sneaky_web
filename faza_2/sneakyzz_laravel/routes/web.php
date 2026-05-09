<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Cart\CartController;

Route::get('/', function () {
    return view('index');
})->name('home');
Route::get('/category/{name}', [ProductController::class, 'category'])->name('category');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/register', [Register::class, 'showForm'])->name('register');
Route::get('/profile', [Register::class, 'showProfile'])
->name('my_profile')
->middleware('auth');
Route::post('/logout', [Register::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index_display'])->name('home');
Route::get('/product/{product_code}/{color_id?}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/summary', [CartController::class, 'summary'])->name('cart.summary');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/admin/stock', [AdminController::class, 'showProducts'])->name('admin_stock');
Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.panel');

Route::get('/admin/create-product', [AdminController::class, 'createProduct'])
    ->name('admin.create.product');
Route::middleware(['role:ADMIN'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.admin_panel');
    })->name('admin.panel')->middleware(['auth','role:ADMIN']);
});

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear')
;
Route::get('/delivery', [CartController::class, 'delivery'])->name('cart.delivery');
Route::post('/delivery', [CartController::class, 'saveDelivery'])->name('cart.delivery.save');

Route::get('/address', [CartController::class, 'address'])->name('cart.address');
Route::post('/address', [CartController::class, 'saveAddress'])->name('cart.address.save');

Route::get('/summary', [CartController::class, 'summary'])->name('cart.summary');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/register', [Register::class, 'register'])->name('register.submit');
Route::post('/login', Login::class )->name('login.submit');
Route::post('/admin/create-product', [AdminController::class, 'store'])->name('admin.product.store');
