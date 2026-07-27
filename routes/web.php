<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.index');
})->middleware('auth')->name('dashboard');


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
