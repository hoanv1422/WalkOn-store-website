<?php

use App\Http\Controllers\shipper\ShipperController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'shipper'])->group(function () {});


Route::resource('shippers', ShipperController::class);
Route::post('shippers/{id}/delivered', [ShipperController::class, 'delivered'])->name('shippers.delivered');
