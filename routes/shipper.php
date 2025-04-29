<?php

use App\Http\Controllers\shipper\ShipperController;
use Illuminate\Support\Facades\Route;

Route::middleware('shipper')->group(function () {
    // Route::resource('shippers', ShipperController::class);
    Route::get('shippers', [ShipperController::class, 'index'])->name('shippers.index');
    Route::post('shippers/{id}/delivered', [ShipperController::class, 'delivered'])->name('shippers.delivered');
});


