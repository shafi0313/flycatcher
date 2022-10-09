<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Rider\AuthController;
use App\Http\Controllers\Api\Rider\CollectionController as RiderCollectionController;
use App\Http\Controllers\Api\Rider\InvoiceController  as RiderInvoiceController;
use App\Http\Controllers\Api\Rider\ParcelController as RiderParcelController;
use App\Models\Parcel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1/rider', 'as' => 'riderApi.'], function () {

    Route::post('login', [AuthController::class, 'login']);

    // Route::group(['middleware' => ['auth:rider-api', 'scopes:rider']], function () {
        Route::get('all/parcel', [RiderParcelController::class, 'index']);
        Route::get('all/collection/{rider_id}', [RiderCollectionController::class, 'index']);
        Route::get('all/invoice/{rider_id}', [RiderInvoiceController::class, 'index']);
        Route::get('show/invoice/{invoice_id}', [RiderInvoiceController::class, 'show']);
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // });
});
