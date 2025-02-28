<?php

<<<<<<< HEAD
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\SizeController;
=======
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\AuthController;
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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



Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/forgot_password', function () {
    return view('auth.forgot_password');
});
Route::post('/register', [AuthController::class, 'register'])->name('register');;
Route::post('/login', [AuthController::class, 'login'])->name('login');;

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

<<<<<<< HEAD
// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin', function () {
//         return view('admin.index');
//     })->name('admin.index')->middleware('admin');
//     Route::get('/', function () {})->name('client.index');
// });
Route::resource('admin/colors', ColorController::class);
Route::resource('admin/sizes',SizeController::class);
=======

Route::get('/test', [TestController::class, 'test']);
Route::post('/test', [TestController::class, 'store'])->name('test');
>>>>>>> 1db1b85ac8b749011ceabd9b4c37487b9726576f
