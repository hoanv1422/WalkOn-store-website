<?php

use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
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

    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);
    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);
    Route::resource('brands', BrandController::class)->except(['create', 'edit', 'show']);
    Route::resource('coupons', CouponController::class);

    // Kho hàng
    Route::resource('inventory', InventoryController::class)->only(['index']);
    Route::get('/inventory/variant/{id}', [InventoryController::class, 'show'])->name('inventory.show');
    Route::delete('inventory/{inventory}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
    Route::put('inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
    // Route::resource('shippers',ShipperController::class);
    // Route::post('shippers/{id}/delivered', [ShipperController::class, 'delivered'])->name('shippers.delivered');
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
    Route::resource('post-comments', PostCommentController::class)->except(['create', 'edit', 'show']);
    Route::resource('posts', PostController::class)->except(['create', 'edit', 'show']);

    
    Route::resource('orders', OrderController::class);
    Route::put('orders/{order}/updateStatus', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');
    Route::put('orders/{order}/cancel', [OrderController::class, 'cancel'])
        ->name('orders.cancel');
        Route::get('order-backups', [OrderController::class, 'showBackups'])
        ->name('orders.backups');
    Route::put('order-backups/restore/{backupId}', [OrderController::class, 'restoreBackup'])
        ->name('orders.restoreBackup');
        Route::put('order-backups/restore-by-date', [OrderController::class, 'restoreBackupsByDate'])->name('orders.restoreBackupsByDate');
});


