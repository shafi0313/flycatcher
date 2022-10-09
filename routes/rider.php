<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rider\Auth\NewPasswordController;
use App\Http\Controllers\Rider\Auth\VerifyEmailController;
use App\Http\Controllers\Rider\Auth\PasswordResetLinkController;
use App\Http\Controllers\Rider\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Rider\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Rider\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Rider\Auth\RegisteredUserController as RiderRegisteredUserController;
use App\Http\Controllers\Rider\Auth\AuthenticatedSessionController as RiderAuthenticatedSessionController;
use App\Http\Controllers\Rider\DashboardController as RiderDashboardController;


Route::group(['prefix' => 'rider', 'as' => 'rider.'], function () {
    //admin authentication system
    // Route::get('dashboard', function () {
    //     return view('admin.dashboard');
    // })->middleware(['auth:rider'])->name('dashboard');
    Route::get('dashboard', [RiderDashboardController::class, 'dashboard'])
        ->middleware('auth:rider')
        ->name('dashboard');

    Route::get('register', [RiderRegisteredUserController::class, 'create'])
        ->middleware('guest:rider')
        ->name('register');

    Route::post('register', [RiderRegisteredUserController::class, 'store'])
        ->middleware('guest:rider');

    Route::get('login', [RiderAuthenticatedSessionController::class, 'create'])
        ->middleware('guest:rider')
        ->name('login');


    Route::post('login', [RiderAuthenticatedSessionController::class, 'store'])
        ->middleware('guest:rider')
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


    Route::post('logout', [RiderAuthenticatedSessionController::class, 'destroy'])
        ->name('logout')
        ->middleware('auth:rider');
});
