<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipperController;

Route::middleware(['auth', 'shipper'])->group(function () {});

Route::get('/shipper', [ShipperController::class, 'index'])->name('shipper.dashboard');
Route::post('/shipper/logout', [ShipperController::class, 'logout'])->name('shipper.logout');
