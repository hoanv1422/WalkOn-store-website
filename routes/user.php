<?php

use App\Http\Controllers\Client\AboutUsController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\DetailController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\Client\WishlistController;
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


// Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');



// Shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');



// Detail
Route::get('/detail/{slug}', [DetailController::class, 'productDetail'])->name('detail.index');
// Route::get('/detail', [DetailController::class, 'index'])->name('detail.index');



// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{cartItemId}', [CartController::class, 'delete'])->name('cart.delete');

// Order 
Route::get('/order', [OrderController::class, 'index'])->name('order.index');



// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');



// wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('profile.index');




// checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');


// about-us
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');


// blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'details'])->name('blog.details');
Route::post('/blog/{slug}/comment', [BlogController::class, 'storeComment'])->name('blog.comment');

// contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');