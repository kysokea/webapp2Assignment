<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layouts.index');
// })->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('layouts.admin');
    });
    Route::get('/', function () {
        return view('dashboard.dashboard');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', function () {
            return view('users.index');
        });
    });
    Route::prefix('/customer')->group(function () {
        Route::get('/', function () {
            return view('customers.index');
        })->name('customer.index');
    });
    Route::prefix('/product')->group(function () {
        Route::get('/', function () {
            return view('products.index');
        })->name('products.index');
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
