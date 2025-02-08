<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\SizeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('client.index');
})->name('client.index');

Route::get('/register', function () {
    return view('client.auth.register');
});
Route::get('/login', function () {
    return view('client.auth.login');
});
Route::get('/forgot_password', function () {
    return view('client.auth.forgot_password');
});
Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/admin/categories', function () {
    return view('admin.categories.index');
});
Route::get('/admin/categories/create', function () {
    return view('admin.categories.create');
});
Route::get('/admin/categories/edit', function () {
    return view('admin.categories.edit');
});
Route::get('/admin/products', function () {
    return view('admin.products.index');
});
Route::get('/admin/products/create', function () {
    return view('admin.products.create');
});
Route::get('/admin/products/edit', function () {
    return view('admin.products.edit');
});

Route::get('/admin/users/create', function () {
    return view('admin.users.create');
});
Route::get('/admin/users', [UserController::class, 'users'])->name('admin.users');
Route::delete('/admin/user/{id}/delete', [UserController::class, 'delete_user'])->name('admin.user.delete');
Route::get('/admin/user/create', [UserController::class, 'create_user'])->name('admin.user.create');
Route::post('/admin/user/add', [UserController::class, 'add_user'])->name('admin.user.add');
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit_user'])->name('admin.user.edit');
Route::put('/admin/user/update', [UserController::class, 'update_user'])->name('admin.user.update');

Route::post('/register', [AuthController::class, 'register'])->name('register');;
Route::post('/login', [AuthController::class, 'login'])->name('login');;

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin', function () {
//         return view('admin.index');
//     })->name('admin.index')->middleware('admin');
//     Route::get('/', function () {})->name('client.index');
// });
Route::resource('admin/colors', ColorController::class);
Route::resource('admin/sizes',SizeController::class);