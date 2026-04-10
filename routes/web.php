<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
// use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\AiController;
Route::get('/', function () {
    return view('welcome');
});





Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');


Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [AuthController::class, 'showVerification'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])
        ->middleware(['throttle:6,1'])->name('verification.send');



    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/order', [OrderController::class, 'index'])->name('order.show');


    // Profile 

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.show');
    Route::put('/profile/name', [ProfileController::class, 'updateName'])->name('profileName.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profilePassword.update');
    Route::put('/profile/phone', [ProfileController::class, 'updatePhone'])->name('profilePhone.update');
    Route::put('/profile/address', [ProfileController::class, 'updateAddress'])->name('profileAddress.update');
    Route::put('/profile/Image', [ProfileController::class, 'updateImage'])->name('profileImage.update');
    Route::put('/profile/address', [ProfileController::class, 'updateAddress'])->name('profileAddress.update');



    // Product


    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/ai/generate-description', [AiController::class, 'generateDescription'])->name('ai.generate-description');



    Route::get('/orders', [OrderController::class , 'index'])->name('orders.index');
    Route::get('/orders/{id}' , [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/checkout', [OrderController::class, 'store'])->name('orders.checkout');
});
