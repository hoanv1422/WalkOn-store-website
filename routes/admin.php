<?php

use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\admin\PostCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);
    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);
    Route::resource('brands', BrandController::class)->except(['create', 'edit', 'show']);

    Route::prefix('attributes')->group(function () {
        Route::get('/', [SizeController::class, 'index'])->name('attributes.index');

        Route::post('size', [SizeController::class, 'store'])->name('sizes.store');
        Route::put('size/{size}', [SizeController::class, 'update'])->name('sizes.update');
        Route::delete('size/{size}', [SizeController::class, 'destroy']);

        Route::post('color', [ColorController::class, 'store'])->name('colors.store');
        Route::put('color/{color}', [ColorController::class, 'update'])->name('colors.update');
        Route::delete('color/{color}', [ColorController::class, 'destroy']);
    });

    Route::resource('post-categories', PostCategoryController::class)->except(['create', 'edit', 'show']);
    Route::resource('post-comments', PostCommentController::class)->except(['create', 'edit', 'show']);
    Route::resource('posts', PostController::class)->except(['create', 'edit', 'show']);
});

Route::prefix('admin')->group(function () {
    Route::get('signin', function () {
        return view('auth.admin.signin');
    })->name('admin.login');

    Route::post('signin', [AuthController::class, 'signinAdmin'])->name('signin.post');

    Route::get('signup', function () {
        return view('auth.admin.signup');
    })->name('signup.index');

    Route::get('pass-reset', function () {
        return view('auth.admin.pass-reset');
    })->name('pass-reset.index');

    Route::get('pass-change', function () {
        return view('auth.admin.pass-change');
    })->name('pass-change.index');

    Route::get('pass-confirm', function () {
        return view('auth.admin.pass-confirm');
    })->name('pass-confirm.index');
});
