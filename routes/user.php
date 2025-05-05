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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Client\CommentController;
use App\Models\Banner;
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

Route::get('/api/shop', [ShopController::class, 'listProducts']);
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/filter', [ShopController::class, 'filter'])->name('shop.filter');
Route::get('/detail/{slug}', [DetailController::class, 'index'])->name('detail.index');
Route::get('api/detail/{slug}', [DetailController::class, 'productDetail'])->name('api.detail.index');
Route::get('/get-product', [HomeController::class, 'getProductById'])->name('get.product');

Route::get('/api/get-cart', [CartController::class, 'indexHeader'])->name('get.cart.api');
Route::get('/api/get-related-products/{slug}', [DetailController::class, 'relatedProducts']);
Route::get('/api/get-recommend-products/{slug}', [DetailController::class, 'show']);


Route::middleware('client', 'checkBanUser')->group(function () {
    Route::get('/cart', [CartController::class, 'indexPage'])->name('cart.index');
    Route::get('/api/cart', [CartController::class, 'index'])->name('api.cart.index');
    Route::put('/api/cart/update', [CartController::class, 'update'])->name('api.cart.update');
    Route::delete('/api/cart/delete/{id}', [CartController::class, 'destroy'])->name('api.cart.item.destroy');
    Route::delete('/api/cart/clear', [CartController::class, 'clear'])->name('api.cart.clear');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/api/add-to-cart', [CartController::class, 'addToCartAPI'])->name('cartApi.add');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/api/addresses', [ProfileController::class, 'addresses'])->name('index.address.api');
    Route::post('/api/save-address', [ProfileController::class, 'createAddressAPI'])->name('create.address.api');
    Route::put('/api/addresses/{id}', [ProfileController::class, 'updateAddressAPI'])->name('update.address.api');
    Route::patch('/api/addresses/{id}/set-default', [ProfileController::class, 'setDefault'])->name('default.address.api');
    Route::delete('/api/addresses/{id}', [ProfileController::class, 'deleteAddressAPI'])->name('delete.address.api');

    Route::post('/api/change-password', [ProfileController::class, 'changePassword'])->name('change-password.api');



    Route::get('/order-list', [OrderController::class, 'ordersListPage'])->name('order.list');
    Route::get('/api/orders', [OrderController::class, 'ordersList'])->name('order.list.test');
    Route::post('/orders/{orderId}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');

    Route::get('/order-detail/{orderCode}', [OrderController::class, 'orderDetailPage']);
    Route::get('/api/order-detail/{orderCode}', [OrderController::class, 'orderDetail']);
    Route::get('/api/order-cancel-reasons', [OrderController::class, 'CancelReason']);



    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
    Route::get('/blog/{slug}', [BlogController::class, 'details'])->name('blog.details');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact-store', [ContactController::class, 'store'])->name('contact.store');

    Route::middleware('verified')->group(function () {
        Route::get('/checkout', [OrderController::class, 'index'])->name('order.index');
        Route::get('/api/checkout', [OrderController::class, 'indexAPI'])->name('api.order.index');
        Route::post('/api/coupon-apply', [OrderController::class, 'applyCoupon'])->name('coupon.apply');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('vnpay_return', [CheckoutController::class, 'vnpay_return'],)->name('vnpay.return');
        Route::post('/blog/{slug}/comment', [BlogController::class, 'storeComment'])->name('blog.comment');
        Route::post('address', [OrderController::class, 'createAddress'])->name('create.address');
    });
});



Route::get('/api/products/{slug}/comments', [CommentController::class, 'comments'])->name('detail.comments');
Route::post('/products/{slug}/comments', [CommentController::class, 'storeComment'])->name('detail.comments.store');

Route::put('/api/orders/{orderId}/cancel', [OrderController::class, 'cancelOrder'])->name('profile.orders.cancel');




// // checkout
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');


// // about-us
// Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');

// // Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'details'])->name('blog.details');
Route::post('/blog/{slug}/comment', [BlogController::class, 'storeComment'])
    ->name('blog.comment');
Route::delete('/blog/delete-comment/{postComment}', [BlogController::class, 'destroyComment'])
    ->name('blog.comment.delete');

// // Contact
// Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// //commment
