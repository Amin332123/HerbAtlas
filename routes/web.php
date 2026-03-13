<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
Route::get('/', function () {
    return view('welcome');
});



use App\Http\Controllers\AuthController;




Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard' , [UserController::class , 'index'])->name('dashboard');
    Route::get('/email/verify', [AuthController::class, 'showVerification'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])
        ->middleware(['throttle:6,1'])->name('verification.send');



    Route::get('/products' , [ProductController::class , 'index'])->name('product.show');
    Route::get('/order' , [OrderController::class , 'index'])->name('order.show');
    Route::get('/profile' , [ProfileController::class , 'index'])->name('profile.show');
    
});
