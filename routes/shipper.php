<?php

use App\Http\Controllers\shipper\ShipperController;
use Illuminate\Support\Facades\Route;

Route::middleware('shipper')->group(function () {
    // Route::resource('shippers', ShipperController::class);
    Route::get('shippers', [ShipperController::class, 'index'])->name('shippers.index');

    Route::get('/api/order/shipper', [ShipperController::class, 'loadOrderForShipper'])->name('shippers.order.api');
    Route::post('/api/order/{id}/update-status', [ShipperController::class, 'updateStatus']);

    Route::post('shippers/{id}/delivered', [ShipperController::class, 'delivered'])->name('shippers.delivered');
});


