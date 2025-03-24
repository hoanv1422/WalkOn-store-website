<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\AuthController;
use App\Mail\ResetPasswordMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\WishlistController;
use App\Http\Middleware\EnsureEmailIsVerified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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

// Nhóm các route liên quan đến authentication
Route::controller(AuthController::class)->group(function () {
    Route::view('/register', 'auth.register');
    Route::view('/login', 'auth.login')->name('login.form');
    Route::view('/forgot_password', 'auth.forgot_password');

    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');

    Route::post('/logout', 'logout')->name('logout')->middleware('client');

    Route::get('/forgot-password', function () {
        return view('auth.forgot_password');
    })->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    //  gửi thông tin mail rồi mới có thông báo là đổi mật khẩu từ email là ok
    Route::get('/password-confirmation', function () {
        return view('auth.confirmation_password');
    })->name('confirmation.password')->middleware('password.reset.check');

    // phần xác thực email
    Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])->name('verification.send');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        session()->forget('email_verification_sent');
        return redirect()->route('verified.email')->with('message', 'Email đã được xác thực thành công!');
    })->middleware('signed')->name('verification.verify');

    Route::get('/verified-email', function () {
        return view('auth.verified_email');
    })->name('verified.email')->middleware('verified');
    Route::get('/email/verify', function () {
        return view('auth.verified-email');
    })->name('verification.notice');

    Route::get('/email-sent', function () {
        return view('auth.email_sent');
    })->name('email.sent')->middleware('email.sent');

    Route::middleware(['auth', EnsureEmailIsVerified::class])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home.index');
    });
});

// Test routes
Route::controller(TestController::class)->group(function () {
    Route::get('/test', 'test');
    Route::post('/test', 'store')->name('test.store');
});
require base_path('routes/shipper.php');
