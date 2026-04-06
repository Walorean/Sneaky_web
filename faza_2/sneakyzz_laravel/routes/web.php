<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Register;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/login', function () {
    return view('/auth/login');
})->name('login');

Route::get('/register', [Register::class, 'showForm'])->name('register');
Route::post('/register', [Register::class, 'register'])->name('register.submit');

Route::get('/my_profile', function () {
    return view('profile');
})->name('my_profile');

Route::post('/logout', [Register::class, 'logout'])->name('logout');

Route::get('/profile', [Register::class, 'showProfile'])
    ->name('my_profile')
    ->middleware('auth');
