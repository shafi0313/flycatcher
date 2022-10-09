<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\Auth\NewPasswordController;
use App\Http\Controllers\Merchant\Auth\VerifyEmailController;
use App\Http\Controllers\Merchant\Auth\PasswordResetLinkController;
use App\Http\Controllers\Merchant\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Merchant\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Merchant\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Merchant\Auth\RegisteredUserController as MerchantRegisteredUserController;
use App\Http\Controllers\Merchant\Auth\AuthenticatedSessionController as MerchantAuthenticatedSessionController;


Route::group(['prefix' => 'merchant', 'as' => 'merchant.'], function () {
    //merchant authentication system
//    Route::get('dashboard', function () {
//        return view('merchant.dashboard');
//    })->middleware(['auth:merchant'])->name('dashboard');

    Route::get('dashboard', [\App\Http\Controllers\Merchant\DashboardController::class, 'index'])->middleware(['auth:merchant'])->name('dashboard');
    Route::get('register', [MerchantRegisteredUserController::class, 'create'])
        ->middleware('guest:merchant')
        ->name('register');

    Route::post('register', [MerchantRegisteredUserController::class, 'store'])
        ->middleware('guest:merchant')
        ->name('registerCheck');

    Route::get('login', [MerchantAuthenticatedSessionController::class, 'create'])
        ->middleware('guest:merchant')
        ->name('login');

    Route::post('login', [MerchantAuthenticatedSessionController::class, 'store'])
        ->middleware('guest:merchant')
        ->name('loginCheck');


    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware('guest')
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest')
        ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('password.update');

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->middleware('auth')
        ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['auth', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->middleware('auth')
        ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware('auth');


    Route::post('logout', [MerchantAuthenticatedSessionController::class, 'destroy'])
        ->name('logout')
        ->middleware('auth:merchant');
});
