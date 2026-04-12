<?php
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
return view('index');
})->name('home');

Route::get('/login', function () {
return view('auth.login');
})->name('login');

Route::get('/register', [Register::class, 'showForm'])->name('register');
Route::post('/register', [Register::class, 'register'])->name('register.submit');
Route::post('/login', Login::class )->name('login.submit');

Route::get('/profile', [Register::class, 'showProfile'])
->name('my_profile')
->middleware('auth');

Route::post('/logout', [Register::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index_display'])->name('home');

Route::get('/product/{product_code}/{color_id?}', [ProductController::class, 'show'])->name('product.show');
