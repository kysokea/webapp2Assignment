<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
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
        Route::get('/', 'index')->name('user.index');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::post('/update/{id}', 'userUpdate')->name('user.update');
    });

    Route::prefix('/customer')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('customer.index');
        Route::get('/create', 'create')->name('customer.create');
        Route::post('/create', 'createCustomer');
        Route::get('/edit/{id}', 'update')->name('customers.edit');
        Route::post('/update/{id}', 'updateCustomer')->name('customer.update');
        Route::delete('/delete/{id}', 'drop')->name('customer.drop');
    });

    Route::prefix('/category')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('category.index');
        Route::get('/create', 'create')->name('category.create');
        Route::post('/create', 'createCategory')->name('category.created');
        Route::get('/edit/{id}', 'edit')->name('category.edit');
        Route::post('/edit/{id}', 'updateCategory')->name('category.update');
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

    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginPage');

        Route::get('/register', 'register');
        Route::post('/register', 'registerUser');
    });

    Route::post('/logout', 'logout')
        ->middleware('auth')
        ->name('logout');
});
