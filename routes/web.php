<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Nhóm các route liên quan đến authentication
Route::controller(AuthController::class)->group(function () {
    Route::view('/register', 'auth.register');
    Route::view('/login', 'auth.login')->name('login.form');
    Route::view('/forgot_password', 'auth.forgot_password');

    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');

    Route::post('/logout', 'logout')->name('logout')->middleware('client');
});

// Test routes
Route::controller(TestController::class)->group(function () {
    Route::get('/test', 'test');
    Route::post('/test', 'store')->name('test.store');
});
