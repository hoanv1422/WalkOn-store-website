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
| Đây là nơi bạn có thể đăng ký các tuyến đường web cho ứng dụng của mình.
| Các tuyến đường này được tải bởi RouteServiceProvider và tất cả chúng
| sẽ được gán vào nhóm middleware "web".
|
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Shop
Route::get('/api/shop', [ShopController::class, 'listProducts']);
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/api/shop', [ShopController::class, 'listProducts']);
Route::get('/get-product', [HomeController::class, 'getProductById'])->name('get.product');
// Detail
Route::get('/detail/{slug}', [DetailController::class, 'productDetail'])->name('detail.index');
// // Profile


// Cart (Chỉ cho phép người dùng đã đăng nhập)
Route::middleware('client')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/api/add-to-cart', [CartController::class, 'addToCartAPI'])->name('cartApi.add');
    Route::delete('/cart/{cartItemId}', [CartController::class, 'delete'])->name('cart.delete');
    Route::put('/cart/update/{cartItemId}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/items/clear', [CartController::class, 'clearCartItems'])->name('cart.items.clear');

    //coupon
    Route::post('/coupon-apply', [OrderController::class, 'applyCoupon'])->name('coupon.apply');
    // Order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    // Profile
    // Trang thông tin cá nhân
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Trang lịch sử đơn hàng
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    // update thong tin khách hàng
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Hủy đơn hàng
    Route::post('/profile/orders/{orderId}/cancel', [App\Http\Controllers\Client\ProfileController::class, 'cancelOrder'])->name('profile.orders.cancel');

    // update thong tin khách hàng
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    // Blog comment
    Route::post('/blog/{slug}/comment', [BlogController::class, 'storeComment'])->name('blog.comment');
    Route::post('address', [ProfileController::class, 'createAddress'])->name('create.address');

    // Checkout
    Route::post('/checkout/cod', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/vnpay', [CheckoutController::class, 'store'],)->name('checkout.vnpay');
    Route::get('vnpay_return', [CheckoutController::class, 'vnpay_return'],)->name('vnpay.return');
});






// wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');



// checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');


// about-us
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'details'])->name('blog.details');
Route::delete('/blog/comments/{comment}/delete', [BlogController::class, 'destroyComment'])
    ->name('blog.comment.delete');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
