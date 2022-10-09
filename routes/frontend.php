<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\LiveTrackingController;

Route::controller(LiveTrackingController::class)->group(function(){
    Route::get('/live-tracking','search')->name('frontend.liveTracking');
});
