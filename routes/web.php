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
    Route::view('/register', 'auth.register')->middleware('guest.to.home');
    Route::view('/login', 'auth.login')->name('login.form')->middleware('guest.to.home');

    Route::post('/clear-verify-session', [AuthController::class, 'clearVerifySession'])->name('clear.verify.session');

    Route::view('/forgot_password', 'auth.forgot_password');

    Route::post('/api/register', 'register')->name('api.register');
    Route::post('/api/login', 'login')->name('api.login');
    Route::post('/logout', 'logout')->name('logout')->middleware('client');


    Route::get('/forgot-password', function () {
        return view('auth.forgot_password');
    })->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    Route::get('/password-confirmation', function () {
        return view('auth.confirmation_password');
    })->name('confirmation.password')->middleware('password.reset.check');

    Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])->name('verification.send');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
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


    Route::prefix('admin')->group(function () {
        Route::get('login', function () {
            return view('auth.admin.signin');
        })->middleware('guest.to.home')->name('admin.login.index');
        Route::post('api/login', [AuthController::class, 'signinAdmin'])->name('api.admin.signin');


        Route::get('pass-reset', function () {
            return view('auth.admin.pass-reset');
        })->name('pass-reset.index');
        Route::post('/api/mail-reset-password', [AuthController::class, 'sendResetCode'])->name('api.admin.sendResetCode');


        Route::get('/pass-confirm/{token}', [AuthController::class, 'showConfirmForm'])
            ->name('password.confirm.form');
        Route::post('/api/confirm-code', [AuthController::class, 'confirmResetCode'])
            ->name('api.password.confirm');
        Route::post('/api/resend-code', [AuthController::class, 'resendCode'])
            ->name('api.password.resend.code');

        Route::get('/pass-change/{token}', [AuthController::class, 'showChangePasswordForm'])
            ->name('password.change.admin');

        Route::post('/api/change-password', [AuthController::class, 'changePasswordAdmin'])
            ->name('api.change.password.admin');    
    });
});
