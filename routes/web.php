<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('layouts.admin');
    });
    Route::get('/', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');
    Route::prefix('user')->controller(UserController::class)->group(function () {
        // Route::get('/', function () {
        //     return view('users.index');
        // });
        Route::get('/','index')->name('user.index');
    });
    Route::prefix('/customer')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('customer.index');
    });
    Route::prefix('/product')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('products.index');
    });
    Route::prefix('/sale')->group(function () {
        Route::get('/', function () {
            return view('sales.index');
        })->name('sales.index');
    });
});


Route::prefix('auth')->controller(AuthController::class)->group(function () {

    // Only guests (not logged in) can access these routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginPage');

        Route::get('/register', 'register');
        Route::post('/register', 'registerUser');
    });

    // Only authenticated users can logout
    Route::post('/logout', 'logout')
        ->middleware('auth')
        ->name('logout');
});
