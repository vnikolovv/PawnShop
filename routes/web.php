<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('contacts');
})->name('contacts');

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

//Route::POST('/products', [ProductController::class, 'loadAll'])->name('products');

Route::get('/products', [ProductController::class, 'loadAll'])->name('products');

Route::POST('/users/register', [UserController::class, 'register'])->name('user.register');

Route::POST('/users/login', [UserController::class, 'login'])->name('user.login');

Route::POST('/users/logout', [UserController::class, 'logout'])->name('user.logout');