<?php

use App\Http\Middleware\AdminAuthenticator;
use App\Http\Middleware\NotLoggedInAuthenticator;
use App\Http\Middleware\LoggedInAuthenticator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;

// Common
Route::get('/',)->middleware(LoggedInAuthenticator::class)->middleware(NotLoggedInAuthenticator::class);


Route::get('/contacts', [ContactController::class, 'show'])->name('contact.show');

Route::POST('/contacts', [ContactController::class, 'submit'])->name('contact.submit')->middleware(AdminAuthenticator::class);

// User-based
Route::get('/login', function () {
    return view('login');
})->name('login')->middleware(NotLoggedInAuthenticator::class);

Route::get('/register', function () {
    return view('register');
})->name('register')->middleware(NotLoggedInAuthenticator::class);

Route::POST('/users/register', [UserController::class, 'register'])->name('user.register')->middleware(NotLoggedInAuthenticator::class);

Route::POST('/users/login', [UserController::class, 'login'])->name('user.login')->middleware(NotLoggedInAuthenticator::class);

Route::POST('/users/logout', [UserController::class, 'logout'])->name('user.logout')->middleware(LoggedInAuthenticator::class);

// Product-based
Route::get('/add-product', function () {
    return view('add-product');
})->name('add-product')->middleware(AdminAuthenticator::class);

Route::get('/products', [ProductController::class, 'loadAll'])->name('products')->middleware(LoggedInAuthenticator::class);

Route::get('/edit-product/{id}', [ProductController::class, 'loadById'])->name('product.edit')->middleware(AdminAuthenticator::class)->defaults('view', 'edit-product');

Route::get('/product/{id}', [ProductController::class, 'loadById'])->name('product.view')->middleware(LoggedInAuthenticator::class)->defaults('view', 'product');

Route::POST('/products/add-product', [ProductController::class, 'addProduct'])->name('product.add-product')->middleware(AdminAuthenticator::class);

Route::POST('/products/edit-product/{id}', [ProductController::class, 'editProduct'])->name('product.edit-product')->middleware(AdminAuthenticator::class);

Route::POST('/products/delete-product', [ProductController::class, 'deleteProduct'])->name('product.delete-product')->middleware(AdminAuthenticator::class);

Route::POST('/products/delete-aditional-image', [ProductController::class, 'deleteAdditionalImage'])->name('product.delete-additional-image')->middleware(AdminAuthenticator::class);

Route::POST('/products/add-additional-images', [ProductController::class, 'addAdditionalImages'])->name('product.add-additional-images')->middleware(AdminAuthenticator::class);

Route::POST('/products/reserve', [ProductController::class, 'reserveProduct'])->name('product.reserve')->middleware(LoggedInAuthenticator::class);

Route::POST('/products/negotiate', [ProductController::class, 'negotiateProduct'])->name('product.negotiate')->middleware(LoggedInAuthenticator::class);