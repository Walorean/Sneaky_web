<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('index');
})->name('index');

Route::get('/login', function () {
    return view('login');
})->name('login');

