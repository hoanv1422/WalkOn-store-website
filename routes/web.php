<?php

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
    return view('admin.index');
});
Route::get('/categories', function () {
    return view('admin.categories.index');
});
Route::get('/categories/create', function () {
    return view('admin.categories.create');
});
Route::get('/categories/edit', function () {
    return view('admin.categories.edit');
});
Route::get('/products', function () {
    return view('admin.products.index');
});
Route::get('/products/create', function () {
    return view('admin.products.create');
});
Route::get('/products/edit', function () {
    return view('admin.products.edit');
});
