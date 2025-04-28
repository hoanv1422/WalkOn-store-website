<?php

use App\Http\Controllers\admin\FooterController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\admin\PostCommentController;
use App\Mail\ContactReplyMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CommentHiddenController;
use Illuminate\Http\Request;

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::resource('products', ProductController::class);
    Route::post('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
    Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);
    Route::get('/users/filter', [UserController::class, 'filterUsers'])->name('users.filter');
    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);
    Route::resource('brands', BrandController::class)->except(['create', 'edit', 'show']);
    Route::resource('coupons', CouponController::class);
    Route::resource('contacts', ContactController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::get('contacts/{contact}/reply', [ContactController::class, 'reply'])->name('contacts.reply');
    Route::post('contacts/{contact}/reply', [ContactController::class, 'sendReply'])->name('contacts.sendReply');
    Route::post('/contacts/reply/{id}', [ContactController::class, 'sendReply'])->name('contacts.reply.send');

    Route::get('test-email', function () {
        $contact = Contact::first();
        $responseMessage = "Đây là email thử nghiệm gửi từ hệ thống.";
        try {
            Mail::to($contact->email)->send(new ContactReplyMail($contact, $responseMessage));
            return 'Email đã được gửi thành công!';
        } catch (\Exception $e) {
            return 'Có lỗi xảy ra: ' . $e->getMessage();
        }
    })->name('test-email');
    // Kho hàng
    Route::resource('inventory', InventoryController::class)->only(['index']);
    Route::get('/inventory/variant/{id}', [InventoryController::class, 'show'])->name('inventory.show');
    Route::delete('inventory/{inventory}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
    Route::put('inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
    // Route::resource('shippers',ShipperController::class);
    // Route::post('shippers/{id}/delivered', [ShipperController::class, 'delivered'])->name('shippers.delivered');
    Route::resource('footers',FooterController::class)->except(['create', 'edit', 'show']);
    
    Route::match(['put', 'patch'], 'admin/footers/{id}', [FooterController::class, 'update'])->name('footers.update');

    

    //kho hàng
    Route::resource('inventories', InventoryController::class)->only(['index']);

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
    Route::get('post-categories/filter', [PostCategoryController::class, 'filter'])
        ->name('post-categories.filter');
    Route::resource('post-comments', PostCommentController::class)->except(['create', 'edit', 'show']);
    Route::get('post-comments/filter', [PostCommentController::class, 'filter'])
    ->name('post-comments.filter');
    Route::resource('posts', PostController::class)->except(['create', 'edit', 'show']);

    Route::resource('orders', OrderController::class);
    Route::put('orders/{order}/updateStatus', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');
    Route::put('orders/{order}/cancel', [OrderController::class, 'cancel'])
        ->name('orders.cancel');
});


