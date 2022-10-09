<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController as AdminRegisteredUserController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// Route::get('/_debugbar/assets/stylesheets', [
//     'as' => 'debugbar-css',
//     'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@css'
// ]);

// Route::get('/_debugbar/assets/javascript', [
//     'as' => 'debugbar-js',
//     'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@js'
// ]);

// Route::get('/_debugbar/open', [
//     'as' => 'debugbar-open',
//     'uses' => '\Barryvdh\Debugbar\Controllers\OpenController@handler'
// ]);


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    //admin authentication system
    // Route::get('dashboard', function () {
    //     return view('admin.dashboard');
    // })->middleware(['auth:admin'])->name('dashboard');
    Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])
        ->middleware('auth:admin')
        ->name('dashboard');

    Route::get('register', [AdminRegisteredUserController::class, 'create'])
        ->middleware('guest:admin')
        ->name('register');

    Route::post('register', [AdminRegisteredUserController::class, 'store'])
        ->middleware('guest:admin');

    Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])
        ->middleware('guest:admin')
        ->name('login');


    Route::post('login', [AdminAuthenticatedSessionController::class, 'store'])
        ->middleware('guest:admin')
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


    Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])
        ->name('logout')
        ->middleware('auth:admin');
});
