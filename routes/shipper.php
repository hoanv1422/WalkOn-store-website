<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipperController;

Route::middleware(['auth', 'shipper'])->group(function () {});
//Attempt to read property "headers" on null , cho vào middleware bị vậy

Route::get('/shipper', [ShipperController::class, 'index'])->name('shipper.dashboard');
Route::post('/shipper/logout', [ShipperController::class, 'logout'])->name('shipper.logout');
