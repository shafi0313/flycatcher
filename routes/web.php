<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HubController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\BadDebtController;
use App\Http\Controllers\SubAreaController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EnvDynamicController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ParcelTypeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SmsSettingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RiderController;
use App\Http\Controllers\ExpenseHeadController;
use App\Http\Controllers\PrintParcelController;
use App\Http\Controllers\Admin\ParcelController;
use App\Http\Controllers\Admin\ReasonController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\CancleInvoiceController;
use App\Http\Controllers\DeliveryChargeController;
use App\Http\Controllers\ParcelReassignController;
use App\Http\Controllers\Admin\ParcelNoteController;
use App\Http\Controllers\Admin\WeightRangeController;
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Http\Controllers\Merchant\SettingsController;
use App\Http\Controllers\Admin\MerchantDeliveryCharge;
use App\Http\Controllers\Admin\PickupRequestController;
use App\Http\Controllers\Merchant\PaymentRequestController;
use App\Http\Controllers\Rider\ParcelController as RiderParcelController;
use App\Http\Controllers\Merchant\ExcelController as MerchantExcelController;
use App\Http\Controllers\Rider\SettingsController as RiderSettingsController;
use App\Http\Controllers\Merchant\ParcelController as MerchantParcelController;
use App\Http\Controllers\Rider\PickupRequestController as RiderPickupRequestController;
use App\Http\Controllers\Merchant\PickupRequestController as MerchantPickupRequestController;
use App\Http\Controllers\Merchant\DeliveryChargeController as MerchantDeliveryChargeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::view('/', 'layouts.app');


Route::get('/', [FrontEndController::class, 'home'])->name('frontend.home');
Route::get('/about', [FrontEndController::class, 'about'])->name('frontend.about');
Route::get('/services', [FrontEndController::class, 'services'])->name('frontend.services');
Route::get('/pricing', [FrontEndController::class, 'pricing'])->name('frontend.pricing');
Route::get('/help', [FrontEndController::class, 'help'])->name('frontend.help');

Route::get('/allclear', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');

    return 'allcleared'; //Return anything
});
Route::get('localization/{locale}', [LocalizationController::class, 'index']);
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/phpinfo', function () {
    return phpinfo();
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/merchant.php';
require __DIR__ . '/rider.php';

Route::group(['middleware' => 'auth:admin', 'prefix' => 'access-control', 'as' => 'admin.'], function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);

    Route::get('/admin/login/{adminId}', [AdminController::class, 'login'])->name('admin.login');
    Route::put('password-reset/{id}', [AdminController::class, 'passwordReset'])->name('admin.password.reset');
    Route::resource('admin', AdminController::class);
});
Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard/parcel-summary-search-by-hub', [\App\Http\Controllers\Admin\DashboardController::class, 'parcelSummarySearchByHub'])->name('dashboard.parcel-summary-search-by-hub');
    Route::get('barcode/{id}', [ExcelController::class, 'barcode'])->name('barcode');
    Route::get('batch/upload', [ExcelController::class, 'parcelImportAdmin'])->name('batchUpload');
    Route::post('import/form', [ExcelController::class, 'importFormData'])->name('import.form');
    Route::get('excelform/batch/upload', [ExcelController::class, 'parcelImportFormData'])->name('batchUploadForm');
    Route::post('import/form/store', [ExcelController::class, 'parcelExcelStore'])->name('parcel.excelStore');
    Route::get('customer-export', [\App\Http\Controllers\CustomerExportController::class, 'index'])->name('customer-export.index');
    Route::post('customer-export-download', [\App\Http\Controllers\CustomerExportController::class, 'export'])->name('customer-export.download');
    Route::post('import', [ExcelController::class, 'importAdmin'])->name('import');

    Route::POST('profile-settings', [\App\Http\Controllers\Admin\SettingsController::class, 'profileSettings'])->name('settings.profile');
    Route::put('password-reset', [\App\Http\Controllers\Admin\SettingsController::class, 'passwordReset'])->name('settings.password.reset');
    Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'settings'])->name('settings');

    Route::resource('/status-meanings', \App\Http\Controllers\Admin\StatusMeaningController::class);
    Route::resource('expense-head', ExpenseHeadController::class);
    Route::get('expense/print', [ExpenseController::class, 'print'])->name('expense.print');
    Route::resource('expense', ExpenseController::class);
    Route::post('/advance/adjust', [AdvanceController::class, 'adjust'])->name('advance.adjust');

    Route::get('/advance/print', [AdvanceController::class, 'print'])->name('advance.print');
    Route::get('/advance/rider', [AdvanceController::class, 'rider'])->name('advance.rider');
    Route::get('/advance/admin', [AdvanceController::class, 'admin'])->name('advance.admin');
    Route::resource('advance', AdvanceController::class);

    Route::resource('loans', LoanController::class);
    Route::resource('loan-adjustments', \App\Http\Controllers\Admin\LoanAdjustmentController::class);

    Route::resource('bad-debts', BadDebtController::class);
    Route::resource('bad-debt-adjusts', \App\Http\Controllers\Admin\BadDebtAdjustController::class);

    Route::resource('investments', InvestmentController::class);
    Route::resource('division', DivisionController::class);
    Route::resource('district', DistrictController::class);
    Route::resource('upazila', UpazilaController::class);

    Route::get('incharge-invoice/{id}', [\App\Http\Controllers\Admin\InchargeInvoiceController::class, 'show'])->name('incharge.invoice.show');
    Route::get('incharge-invoice/pdf/{id}', [\App\Http\Controllers\Admin\InchargeInvoiceController::class, 'pdf'])->name('incharge.invoice.pdf');
    Route::get('incharge-invoice/slip/{id}', [\App\Http\Controllers\Admin\InchargeInvoiceController::class, 'slip'])->name('incharge.invoice.slip');
    Route::get('incharge-invoice', [\App\Http\Controllers\Admin\InchargeInvoiceController::class, 'invoiceList'])->name('incharge.invoice.index');

    Route::get('rider-invoice/{id}', [\App\Http\Controllers\Admin\RiderInvoiceController::class, 'show'])->name('rider.invoice.show');
    Route::get('rider-invoice/pdf/{id}', [\App\Http\Controllers\Admin\RiderInvoiceController::class, 'pdf'])->name('rider.invoice.pdf');
    Route::get('rider-invoice', [\App\Http\Controllers\Admin\RiderInvoiceController::class, 'invoiceList'])->name('rider.invoice.index');

    Route::get('invoice/pdf/{invoiceId}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');
    Route::get('invoice/excel/{invoiceId}', [InvoiceController::class, 'excel'])->name('invoice.excel');
    Route::resource('invoice', InvoiceController::class);
    Route::resource('cancle-invoice', CancleInvoiceController::class);
    Route::get('cancle-invoice/pdf/{invoiceId}', [CancleInvoiceController::class, 'pdf'])->name('cancle-invoice.pdf');
    Route::get('merchant-wise-unpaid-parcel-search', [InvoiceController::class, 'merchantWiseUnpaidParcelSearch'])->name('merchant-wise-unpaid-parcel-search');

    Route::get('due-print', [\App\Http\Controllers\Admin\DueController::class, 'print'])->name('account.due.print');
    Route::get('due-list', [\App\Http\Controllers\Admin\DueController::class, 'list'])->name('account.due');

    Route::get('incharge-collection-list', [\App\Http\Controllers\Admin\CollectionController::class, 'inchargeCollectionList'])->name('incharge.collection.list');
    Route::get('incharge-collection-history', [\App\Http\Controllers\Admin\CollectionController::class, 'inchargeCollectionHistory'])->name('incharge.collection.history');
    Route::put('collection/collect/incharge/{riderId}', [\App\Http\Controllers\Admin\CollectionController::class, 'inchargeCollectionCollect'])->name('collection.incharge.collect');
    Route::put('collection/transfer/incharge', [\App\Http\Controllers\Admin\CollectionController::class, 'inchargeCollectionTransfer'])->name('collection.incharge.transfer');
    Route::get('incharge-collection/show/{riderId}', [\App\Http\Controllers\Admin\CollectionController::class, 'inchargeCollectionShow'])->name('incharge.collection.show');
    Route::get('incharge-collection', [\App\Http\Controllers\Admin\CollectionController::class, 'index'])->name('incharge.collection.index');

    Route::get('account-collection-history', [\App\Http\Controllers\Admin\CollectionController::class, 'accountCollectionHistory'])->name('account.collection.history');
    Route::put('collection/collect/account/{inchargeId}', [\App\Http\Controllers\Admin\CollectionController::class, 'accountCollectionCollect'])->name('collection.account.collect');
    Route::get('account-collection/show/{inchargeId}', [\App\Http\Controllers\Admin\CollectionController::class, 'accountCollectionShow'])->name('account.collection.show');
    Route::get('account-collection', [\App\Http\Controllers\Admin\CollectionController::class, 'accountIndex'])->name('account.collection.index');
    //    Route::resource('collection', \App\Http\Controllers\Admin\CollectionController::class);

    Route::resource('area', AreaController::class);
    Route::resource('sub-area', SubAreaController::class);
    Route::resource('hub', HubController::class);
    Route::put('/rider/password-reset/{riderId}', [RiderController::class, 'passwordReset'])->name('rider.password.reset');
    //	Back to dashboard
    Route::get('/rider/login/{riderId}', [RiderController::class, 'login'])->name('rider.login');
    Route::get('/merchant/login/{merchantId}', [MerchantController::class, 'login'])->name('merchant.login');
    //
    Route::resource('rider', RiderController::class);
    Route::resource('delivery-charge', DeliveryChargeController::class);
    Route::resource('parcel-type', ParcelTypeController::class);
    Route::resource('sms-settings', SmsSettingController::class);

    Route::put('/hold-parcel/{id}/reassign', [ParcelController::class, 'holdParcelReassign'])->name('hold.parcel.reassign');
    Route::put('/parcel/{id}/undo', [ParcelController::class, 'parcelUndo'])->name('parcel.undo');
    Route::put('/parcel/{id}/accept', [ParcelController::class, 'parcelAccept'])->name('parcel.accept');
    Route::get('/parcel/accept/{id}', [ParcelController::class, 'SingleParcelAccept'])->name('single.parcel.accept');
    Route::put('/parcel/{id}/rider-reassign', [ParcelController::class, 'reassignRider'])->name('parcel.rider.reassign');
    Route::put('/parcel/{id}/rider-assign', [ParcelController::class, 'assignRider'])->name('parcel.rider-assign');

    //Route::post('/rider-parcel-list', [ParcelController::class, 'riderParcelList'])->name('parcel.rider.list');
    //Route::get('/print-rider-parcel', [ParcelController::class, 'printRiderParcel'])->name('print.rider.parcel');


    Route::get('/parcel-transfer', [\App\Http\Controllers\Admin\ParcelRequestController::class, 'index'])->name('parcel.request');
    Route::get('/parcel-transfer-merchant', [\App\Http\Controllers\Admin\ParcelRequestController::class, 'parcelRequestMerchantBasis'])->name('parcel.request.merchant');
    Route::post('/parcel-transfer-accept', [\App\Http\Controllers\Admin\ParcelRequestController::class, 'accept'])->name('parcel.request.accept');

    Route::post('/parcel/cancel/{id}', [ParcelController::class, 'cancel'])->name('parcel.cancel');
    Route::post('/parcel/hold/{id}', [ParcelController::class, 'hold'])->name('parcel.hold');
    Route::put('/parcel/delivered/{id}', [ParcelController::class, 'delivered'])->name('parcel.deliver');
    Route::get('/parcel/multiple/create', [ParcelController::class, 'multipleCreate'])->name('parcel.multiple.create');
    Route::post('/parcel/multiple/store', [ParcelController::class, 'multipleStore'])->name('parcel.multiple.store');
    Route::get('/date-adjust', [ParcelController::class, 'parcelDateAdjust'])->name('parcel.date.adjust');
    Route::get('/parcel/date/adjust/apply', [ParcelController::class, 'parcelDateAdjustApply'])->name('parcel.date.adjust.apply');
    Route::resource('parcel', ParcelController::class);
    Route::resource('parcel-note', ParcelNoteController::class);

    Route::put('/rider-parcel-transfer/reject/{parcelTransferID}', [\App\Http\Controllers\Admin\ParcelTransferController::class, 'reject'])->name('parcel.transfer.reject');
    Route::put('/rider-parcel-transfer/accept/{parcelTransferID}', [\App\Http\Controllers\Admin\ParcelTransferController::class, 'accept'])->name('parcel.transfer.accept');
    Route::get('/parcel/transfer/{parcelId}', [\App\Http\Controllers\Admin\ParcelTransferController::class, 'index'])->name('parcel.transfer.index');

    Route::resource('weight-range', WeightRangeController::class);

    Route::delete('/merchant/{id}/delivery-charge/delete', [MerchantDeliveryCharge::class, 'delete'])->name('merchant.delivery.charge.delete');
    Route::put('/merchant/{id}/delivery-charge/update', [MerchantDeliveryCharge::class, 'update'])->name('merchant.delivery.charge.update');
    Route::get('/merchant/{id}/delivery-charge/edit', [MerchantDeliveryCharge::class, 'edit'])->name('merchant.delivery.charge.edit');
    Route::post('/merchant/{id}/delivery-charge/store', [MerchantDeliveryCharge::class, 'store'])->name('merchant.delivery.charge.store');
    Route::get('/merchant/{id}/delivery-charge/create', [MerchantDeliveryCharge::class, 'create'])->name('merchant.delivery.charge.create');
    Route::put('/merchant/inactive/{id}', [MerchantController::class, 'inactive'])->name('merchant.inactive');
    Route::put('/merchant/active/{id}', [MerchantController::class, 'active'])->name('merchant.active');
    Route::put('/merchant/pending/{id}', [MerchantController::class, 'pending'])->name('merchant.pending');
    Route::resource('merchant', MerchantController::class);
    Route::get('/collection-summary', [\App\Http\Controllers\Admin\CollectionSummaryController::class, 'index'])->name('collection.summary');

    Route::put('/pickup-request/assign/{id}', [PickupRequestController::class, 'riderAssign'])->name('pickup-request.rider-assign');
    Route::resource('pickup-request', PickupRequestController::class);

    Route::get('fetch-district-by-division-id/{id}', [App\Http\Controllers\ApiController::class, 'fetch_district']);
    Route::get('fetch-upazila-by-district-id/{id}', [App\Http\Controllers\ApiController::class, 'fetch_upazila']);

    //rider-assign-parcel
    Route::post('rider-wise-assign-parcel', [App\Http\Controllers\Admin\ParcelReportController::class, 'assignParcelRiderWise'])->name('rider-wise-assign-parcel');
    Route::get('rider-assign-parcel-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'riderAssignParcelSearch'])->name('rider-assign-parcel-search');
    Route::get('rider-assign-parcel', [App\Http\Controllers\Admin\ParcelReportController::class, 'riderAssignParcel'])->name('rider-assign-parcel');
    //End rider-assign-parcel
    //parcel-reassign
    Route::resource('parcel-reassigns', ParcelReassignController::class);
    //End parcel-reassign
    Route::get('search-parcel', [App\Http\Controllers\Admin\SearchParcelController::class, 'index'])->name('search-parcel');
    Route::post('search-parcel-pdf', [App\Http\Controllers\Admin\SearchParcelController::class, 'pdf'])->name('search-parcel.pdf');

    Route::resource('print-parcels', PrintParcelController::class);
    Route::get('print-parcel-search', [App\Http\Controllers\PrintParcelController::class, 'riderWiseParcelSearch'])->name('print-parcel-search');
    Route::get('print-sheet-search', [App\Http\Controllers\PrintParcelController::class, 'printSheetSearch'])->name('print-sheet-search');
    Route::post('print-parcel-rider-wise-save', [App\Http\Controllers\PrintParcelController::class, 'printParcelRiderWise'])->name('print-parcel-rider-wise-save');
    Route::get('sheet-print/{sheet}', [App\Http\Controllers\PrintParcelController::class, 'sheetPrint'])->name('sheet-print');
    Route::get('sheet-hisab/{sheet}', [App\Http\Controllers\PrintParcelController::class, 'sheetHisab'])->name('sheet-hisab');
    Route::post('sheet-all-hisab-accept', [App\Http\Controllers\PrintParcelController::class, 'sheetAllHisabAccept'])->name('sheet-all-hisab-accept');
    Route::get('sheet-hisab-accept/{status}/{parcel_id}/{sheet_id}', [App\Http\Controllers\PrintParcelController::class, 'sheetHisabAccept'])->name('sheet-hisab-accept');

    Route::group(['prefix' => 'report'], function () {

        //rider-wise Report
        Route::post('rider-wise-parcel-print', [App\Http\Controllers\Admin\ParcelReportController::class, 'printParcelRiderWise'])->name('print-parcel-rider-wise');
        Route::get('rider-wise-parcel-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'riderWiseParcelSearch'])->name('rider-wise-parcel-search');
        Route::get('rider-wise-parcel', [App\Http\Controllers\Admin\ParcelReportController::class, 'riderWiseParcel'])->name('rider-wise-parcel');
        //End rider-wise Report


        Route::get('parcel-with-collection-report-searchResult', [App\Http\Controllers\Admin\ParcelWithCollectionRerportController::class, 'searchResult'])->name('parcel-with-collection-report-search-result');
        Route::get('parcel-with-collection-report', [App\Http\Controllers\Admin\ParcelWithCollectionRerportController::class, 'show'])->name('parcel-with-collection-report');

        //Collection Report
        Route::post('collection-summary-print', [App\Http\Controllers\Admin\CollectionReportController::class, 'collectionSummaryPrint'])->name('collection.summary.print');
        Route::get('collection-search', [App\Http\Controllers\Admin\CollectionReportController::class, 'collectionSearch'])->name('collection-search');
        Route::get('collection-report', [App\Http\Controllers\Admin\CollectionReportController::class, 'collectionReport'])->name('collection-report');
        //End Collection Report


        Route::post('merchant-wise-parcel-print', [App\Http\Controllers\Admin\ParcelReportController::class, 'printParcelMerchantWise'])->name('merchant-wise-parcel-print');
        Route::get('merchant-wise-parcel-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'merchantWiseParcelSearch'])->name('merchant-wise-parcel-search');
        Route::get('merchant-wise-parcel', [App\Http\Controllers\Admin\ParcelReportController::class, 'merchantWiseParcel'])->name('merchant-wise-parcel');


        Route::post('print-parcel-area-wise', [App\Http\Controllers\Admin\ParcelReportController::class, 'printParcelAreaWise'])->name('print-parcel-area-wise');
        Route::get('area-wise-parcel-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'areaWiseParcelSearch'])->name('area-wise-parcel-search');
        Route::get('area-wise-parcel', [App\Http\Controllers\Admin\ParcelReportController::class, 'areaWiseParcel'])->name('area-wise-parcel');

        Route::post('print-parcel-date-wise', [App\Http\Controllers\Admin\ParcelReportController::class, 'printParcelDateWise'])->name('print-parcel-date-wise');
        Route::get('date-wise-parcel-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'dateWiseParcelSearch'])->name('date-wise-parcel-search');
        Route::get('date-wise-parcel', [App\Http\Controllers\Admin\ParcelReportController::class, 'dateWiseParcel'])->name('date-wise-parcel');


        Route::post('print-total-parcel-rider-wise', [App\Http\Controllers\Admin\ParcelReportController::class, 'riderWiseParcelTotalParcelPdf'])->name('print-total-parcel-rider-wise');
        Route::get('total-parcel-rider-wise-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'riderWiseParcelCountSearch'])->name('rider-wise-parcel-count-search');
        Route::get('total-parcel-rider-wise', [App\Http\Controllers\Admin\ParcelReportController::class, 'riderWiseParcelCount'])->name('rider-wise-parcel-count');

        Route::post('parcel-summary-print', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummaryPrint'])->name('parcel.summary.print');
        Route::get('parcel-summary-details/{status}/{start_date}/{end_date?}', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummaryDetails'])->name('parcel.summary.details');
        Route::get('parcel-summary-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummarySearch'])->name('parcel.summary.search');
        Route::get('parcel-summary', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummary'])->name('parcel.summary');
        //Office Report
        Route::get('parcel-summary-in-progress', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummaryInProgress'])->name('parcel.summary.in.progress');
        Route::get('parcel-summary-in-progress-details/{status}/{delivery_status?}/{cancle_partial_invoice?}', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummaryInProgressDetails'])->name('parcel.summary.progress.details');
        Route::get('parcel-summary-in-office-pdf', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummaryInOfficePdf'])->name('parcel.summary.in.office.pdf');
        Route::get('parcel-summary-in-rider-pdf', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummaryInRiderPdf'])->name('parcel.summary.in.rider.pdf');
        //merchant-wise Report
        Route::post('merchant-parcel-summary-print', [App\Http\Controllers\Admin\ParcelReportController::class, 'merchantParcelSummaryPrint'])->name('merchant.parcel.summary.print');
        Route::get('merchant-parcel-summary-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'merchantParcelSummarySearch'])->name('merchant.parcel.summary.search');
        Route::get('merchant-parcel-summary', [App\Http\Controllers\Admin\ParcelReportController::class, 'merchantParcelSummary'])->name('merchant.parcel.summary');

        Route::get('parcel-summary-in-merchant-wise-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummaryInMerchantWiseSearch'])->name('parcel-summary-in-merchant-wise-search');
        Route::get('parcel-summary-in-merchant-wise', [App\Http\Controllers\Admin\ParcelReportController::class, 'ParcelSummaryInMerchantWise'])->name('parcel-summary-in-merchant-wise');

        Route::get('parcel-summary-in-rider-wise-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummaryInRiderWiseSearch'])->name('parcel-summary-in-rider-wise-search');
        Route::get('parcel-summary-in-rider-wise', [App\Http\Controllers\Admin\ParcelReportController::class, 'ParcelSummaryInRiderWise'])->name('parcel-summary-in-rider-wise');

        Route::get('parcel-summary-before-date-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummeryBeforeDateSearch'])->name('parcel-summary-before-date-search');
        Route::get('parcel-summary-before-date', [App\Http\Controllers\Admin\ParcelReportController::class, 'parcelSummeryBeforeDate'])->name('parcel-summary-before-date');

        Route::get('area-wise-parcel-summery-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'areaWiseParcelSummarySearch'])->name('area-wise-parcel-summery-search');
        Route::get('get-sub-area-data-by-area-id', [App\Http\Controllers\Admin\ParcelReportController::class, 'getSubAreaDataByAreaId'])->name('get-sub-area-data-by-area-id');
        Route::get('area-wise-parcel-summary', [App\Http\Controllers\Admin\ParcelReportController::class, 'areaWiseParcelSummery'])->name('area-wise-parcel-summary');

        Route::get('area-wise-parcel-summery-search', [App\Http\Controllers\Admin\ParcelReportController::class, 'areaWiseParcelSummarySearch'])->name('area-wise-parcel-summery-search');

        Route::get('merchant-wise-due/accountant/show/{accountant_id}/{merchant_id}/{date_range?}', [\App\Http\Controllers\Admin\DueReportController::class, 'merchantWiseDueDetailsByAccountant'])->name('merchant-wise-due.account.show');
        Route::get('merchant-wise-due/incharge/show/{admin_id}/{merchant_id}/{date_range?}', [\App\Http\Controllers\Admin\DueReportController::class, 'merchantWiseDueDetailsByAdmin'])->name('merchant-wise-due.admin.show');
        Route::get('merchant-wise-due/rider/show/{rider_id}/{merchant_id}/{date_range?}', [\App\Http\Controllers\Admin\DueReportController::class, 'merchantWiseDueDetailsByRider'])->name('merchant-wise-due.rider.show');
        Route::get('merchant-wise-due/status/show/{status}/{merchant_id}/{date_range?}', [\App\Http\Controllers\Admin\DueReportController::class, 'merchantWiseDueDetailsByStatus'])->name('merchant-wise-due.status.show');
        Route::get('merchant-wise-due-search', [App\Http\Controllers\Admin\DueReportController::class, 'merchantWiseDueSearch'])->name('merchant-wise-due-search');
        Route::get('merchant-wise-due', [App\Http\Controllers\Admin\DueReportController::class, 'merchantWiseDue'])->name('merchant-wise-due');

        Route::post('merchant-wise-delivery-charge-pdf', [App\Http\Controllers\Admin\DeliveryChargeReportController::class, 'merchantWiseDeliveryChargePdf'])->name('merchant-wise-delivery-charge-pdf');
        Route::get('merchant-wise-delivery-charge-search', [App\Http\Controllers\Admin\DeliveryChargeReportController::class, 'merchantWiseDeliveryChargeSearch'])->name('merchant-wise-delivery-charge-search');
        Route::get('merchant-wise-delivery-charge', [App\Http\Controllers\Admin\DeliveryChargeReportController::class, 'merchantWiseDeliveryCharge'])->name('merchant-wise-delivery-charge');

        Route::post('/monthly-rider-monthly-rider-delivery-report/pdf', [\App\Http\Controllers\Admin\DeliveryReportController::class, 'pdf'])->name('monthly-rider-delivery-report.pdf');
        Route::get('/monthly-rider-monthly-rider-delivery-report/search-result', [\App\Http\Controllers\Admin\DeliveryReportController::class, 'searchResult'])->name('monthly-rider-delivery-report.search-result');
        Route::get('/monthly-rider-monthly-rider-delivery-report', [\App\Http\Controllers\Admin\DeliveryReportController::class, 'show'])->name('monthly-rider-delivery-report');

        Route::post('/cancle-collection-report/pdf', [\App\Http\Controllers\Admin\CancleCollectionReportController::class, 'pdf'])->name('cancle-collection-report.pdf');
        Route::get('/cancle-collection-report/search-result', [\App\Http\Controllers\Admin\CancleCollectionReportController::class, 'searchResult'])->name('cancle-collection-report.search-result');
        Route::get('/cancle-collection-report', [\App\Http\Controllers\Admin\CancleCollectionReportController::class, 'show'])->name('cancle-collection-report');

        Route::get('/area-report/print', [\App\Http\Controllers\Admin\AreaReportController::class, 'print'])->name('area-report.print');
        Route::get('/area-report', [\App\Http\Controllers\Admin\AreaReportController::class, 'index'])->name('area-report');

        //End merchant-wise Report
        Route::get('cash-summary-search-result', [App\Http\Controllers\Admin\AccountsReportController::class, 'searchResult'])->name('cash.summary.search');
        Route::get('cash-summary', [App\Http\Controllers\Admin\AccountsReportController::class, 'cashSummary'])->name('cash.summary');
        Route::get('cash-summary-print', [App\Http\Controllers\Admin\AccountsReportController::class, 'cashSummaryPrint'])->name('cash.summary.print');

        Route::get('balance-sheet', [App\Http\Controllers\Admin\AccountsReportController::class, 'balanceSheet'])->name('balance.sheet');

        Route::post('expense-report/print', [\App\Http\Controllers\ExpenseReportController::class, 'print'])->name('expense-report-print');
        Route::get('expense-report/search', [\App\Http\Controllers\ExpenseReportController::class, 'search'])->name('expense-report-search');
        Route::get('expense-report', [\App\Http\Controllers\ExpenseReportController::class, 'view'])->name('expense-report');

        Route::post('monthly-expense-report/print', [\App\Http\Controllers\ExpenseReportController::class, 'printMonthly'])->name('monthly-expense-report-print');
        Route::get('monthly-expense-report/search', [\App\Http\Controllers\ExpenseReportController::class, 'searchMonthly'])->name('monthly-expense-report-search');
        Route::get('monthly-expense-report', [\App\Http\Controllers\ExpenseReportController::class, 'viewMonthly'])->name('monthly-expense-report');

        Route::post('advance-report/print', [\App\Http\Controllers\AdvanceReportController::class, 'print'])->name('advance-report-print');
        Route::get('advance-report/search', [\App\Http\Controllers\AdvanceReportController::class, 'search'])->name('advance-report-search');
        Route::get('advance-report', [\App\Http\Controllers\AdvanceReportController::class, 'view'])->name('advance-report');

        Route::get('monthly-collection-report-search-result', [\App\Http\Controllers\Admin\MonthlyCollectionReportController::class, 'searchResult'])->name('monthly-collection-report-search-result');
        Route::get('monthly-collection-report', [\App\Http\Controllers\Admin\MonthlyCollectionReportController::class, 'show'])->name('monthly-collection-report');
    });

    Route::resource('env-dynamic', EnvDynamicController::class);
    Route::resource('reason', ReasonController::class);
    Route::resource('complaints', ComplaintController::class);
});
Route::group(['middleware' => 'auth:merchant', 'prefix' => 'merchant', 'as' => 'merchant.'], function () {
    Route::get('batch/upload', [MerchantExcelController::class, 'parcelImport'])->name('batchUpload');
    Route::post('import', [MerchantExcelController::class, 'importFormData'])->name('import');
    Route::post('import/merchant/store', [MerchantExcelController::class, 'parcelExcelStore'])->name('parcel.merchantExcelStore');
    //    Route::get('/pickup/index', [MerchantPickupRequestController::class, 'index'])->name('pickup');
    Route::resource('pickup-request', MerchantPickupRequestController::class);
    Route::resource('payment-request', PaymentRequestController::class);

    Route::put('cancel-parcel-accept/accept', [\App\Http\Controllers\Merchant\ParcelController::class, 'cancelParcelAccept'])->name('accept-cancel-parcel.cancel');
    Route::get('cancel-parcel-accept', [\App\Http\Controllers\Merchant\ParcelController::class, 'cancelParcelShow'])->name('accept-cancel-parcel');
    Route::get('cancel-parcel-accept', [\App\Http\Controllers\Merchant\ParcelController::class, 'cancelParcelShow'])->name('accept-cancel-parcel');
    Route::put('parcel/accept/{parcelId}', [\App\Http\Controllers\Merchant\ParcelController::class, 'acceptCancelParcel'])->name('parcel.accept');
    Route::resource('parcel', MerchantParcelController::class);

    Route::get('parcel-request', [\App\Http\Controllers\Merchant\ParcelRequestController::class, 'index'])->name('parcel.request.index');
    Route::get('parcel-request/edit/{parcel_id}', [\App\Http\Controllers\Merchant\ParcelRequestController::class, 'edit'])->name('parcel.request.edit');
    Route::get('parcel-request/delete/{parcel_id}', [\App\Http\Controllers\Merchant\ParcelRequestController::class, 'delete'])->name('parcel.request.delete');
    Route::put('parcel-request/update/{parcel_id}', [\App\Http\Controllers\Merchant\ParcelRequestController::class, 'update'])->name('parcel.request.update');

    Route::get('delivery-charge', [MerchantDeliveryChargeController::class, 'index'])->name('delivery-charge.index');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');

    Route::get('parcel-report-search', [\App\Http\Controllers\Merchant\ParcelReportController::class, 'dateWiseParcelSearch'])->name('date-wise-parcel-search');
    Route::get('parcel-report', [\App\Http\Controllers\Merchant\ParcelReportController::class, 'dateWiseParcel'])->name('parcel.report');

    Route::resource('status-meanings', \App\Http\Controllers\Merchant\StatusMeaningController::class);

    Route::group(['as' => 'settings.'], function () {
        Route::put('settings/personal/', [SettingsController::class, 'personal'])->name('personal');
        Route::put('settings/password-reset/', [SettingsController::class, 'passwordReset'])->name('password.reset');
        Route::put('settings/company/', [SettingsController::class, 'company'])->name('company');
        Route::post('settings/pickup-method/', [SettingsController::class, 'pickupMethod'])->name('pickup.method');
        //Route::get('settings/mobile-banking/', [SettingsController::class, 'mobileBanking'])->name('mobile.banking');
        Route::put('settings/payment-method/', [SettingsController::class, 'paymentMethod'])->name('payment.method');
        Route::put('settings/bank-account/', [SettingsController::class, 'bankAccount'])->name('bank.account');

        Route::resource('bank-info', \App\Http\Controllers\Merchant\BankAccountController::class);
        Route::resource('mobile-banking', \App\Http\Controllers\Merchant\MobileBankingController::class);
    });

    Route::put('invoices/accept/{invoiceId}', [\App\Http\Controllers\Merchant\InvoiceController::class, 'accept'])->name('invoice.accept');
    Route::get('invoices/details/{invoiceId}', [\App\Http\Controllers\Merchant\InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('invoices', [\App\Http\Controllers\Merchant\InvoiceController::class, 'invoiceList'])->name('invoice');
    Route::get('collection', [\App\Http\Controllers\Merchant\CollectionController::class, 'index'])->name('collection.index');
    Route::get('coverage/area', [\App\Http\Controllers\Merchant\CollectionController::class, 'coverageArea'])->name('coverage.area');
});

Route::group(['middleware' => 'auth:rider', 'prefix' => 'rider', 'as' => 'rider.'], function () {
    Route::put('/pickup-request/pickup/{id}', [RiderPickupRequestController::class, 'pickup'])->name('pickup-request.pickup');
    Route::put('/pickup-request/accept/{id}', [RiderPickupRequestController::class, 'accept'])->name('pickup-request.accept');
    Route::resource('pickup-request', RiderPickupRequestController::class);

    Route::post('/processRequest', [\App\Http\Controllers\Rider\ParcelTransferController::class, 'processRequest'])->name('parcel.transfer.request.process');
    Route::get('/fetchSubArea', [\App\Http\Controllers\Rider\ParcelTransferController::class, 'fetchSubArea'])->name('parcel.transfer.sub.area.search');
    Route::get('/parcel/transfer/{id}', [\App\Http\Controllers\Rider\ParcelTransferController::class, 'request'])->name('parcel.transfer.request');
    Route::put('/parcel/{id}/undo', [RiderParcelController::class, 'parcelUndo'])->name('parcel.undo');
    Route::post('/parcel/cancel/{id}', [RiderParcelController::class, 'cancel'])->name('parcel.cancel');
    Route::post('/parcel/hold/{id}', [RiderParcelController::class, 'hold'])->name('parcel.hold');
    Route::put('/parcel/delivered/{id}', [RiderParcelController::class, 'delivered'])->name('parcel.deliver');
    Route::put('/parcel/status-change/store/{id}', [RiderParcelController::class, 'storeStatusChange'])->name('parcel.status.change.store');
    Route::get('/parcel/status-change/{id}', [RiderParcelController::class, 'statusChange'])->name('parcel.status.change');
    Route::put('/parcel/accept/{id}', [RiderParcelController::class, 'acceptParcel'])->name('parcel.accept');
    Route::resource('parcel', RiderParcelController::class);
    Route::put('password-reset', [RiderSettingsController::class, 'passwordReset'])->name('settings.password.reset');
    Route::get('settings', [RiderSettingsController::class, 'index'])->name('settings.index');
    Route::put('collection/send', [\App\Http\Controllers\Rider\CollectionController::class, 'riderCollectionSendIncharge'])->name('collection.send.incharge');
    Route::get('collection', [\App\Http\Controllers\Rider\CollectionController::class, 'index'])->name('collection.index');

    Route::resource('invoices', \App\Http\Controllers\Rider\InvoiceController::class);

    Route::get('monthly-rider-delivery-report/search-result', [\App\Http\Controllers\Rider\DeliveryReportController::class, 'searchResult'])->name('delivery.report.search');
    Route::get('monthly-rider-delivery-report', [\App\Http\Controllers\Rider\DeliveryReportController::class, 'show'])->name('delivery.report');
});

Route::get('getAjaxUpazilla', [ApiController::class, 'getAjaxUpazillaData'])->name('getAjaxUpazillaData');
Route::get('fetch-area-by-city-type-id/{id}', [App\Http\Controllers\ApiController::class, 'fetch_area']);
Route::get('fetch-sub-area-by-area-id/{id}', [App\Http\Controllers\ApiController::class, 'fetch_sub_area']);
Route::get('fetch-rider-by-sub-area-id/{id}', [App\Http\Controllers\ApiController::class, 'fetch_rider']);
Route::get('fetch-delivery-cod-charge/{city_id}/{weight_id}/{merchant_id}', [App\Http\Controllers\ApiController::class, 'fetch_delivery_cod_charge']);
Route::get('fetch-merchant-wise-parcel/{merchant_id}', [App\Http\Controllers\ApiController::class, 'fetchMerchantWiseParcel']);
Route::get('fetch-merchant-date-wise-parcel/{merchant_id}/{added_date?}', [App\Http\Controllers\ApiController::class, 'fetchMerchantDateWiseParcel']);
Route::get('fetch-rider-wise-parcel/{rider_id}/{status?}', [App\Http\Controllers\ApiController::class, 'fetchRiderWiseParcel']);
Route::get('check-otp/{parcel_id}/{otp}', [App\Http\Controllers\ApiController::class, 'checkOtp']);
Route::get('fetch-parcel-des', [App\Http\Controllers\ApiController::class, 'fetchParcel']);
Route::get('search-parcel', [App\Http\Controllers\Admin\ParcelController::class, 'searchParcel'])->name('search-parcel');
Route::post('search-parcel-print', [App\Http\Controllers\Admin\ParcelController::class, 'searchParcelPrint'])->name('search-parcel-print');
Route::get('fetch-merchant-info/{id}', [App\Http\Controllers\ApiController::class, 'fetchMerchant'])->name('fetch-merchant-info');
//cancle invoice
Route::get('fetch-merchant-info-by-cancle/{merchant_id}/{added_date?}', [App\Http\Controllers\ApiController::class, 'fetchMerchantInfoForCancleInvoice']);
Route::get('fetch-parcel-by-parcel-id/{parcel_id}', [App\Http\Controllers\ApiController::class, 'fetchParcelInfo']);
//parcel Search
Route::get('fetch-rider-parcel-by-rider/{rider_id}', [App\Http\Controllers\ApiController::class, 'fetchRiderParcelForSearchParcel']);
Route::get('fetch-rider-status-parcel-by-rider/{rider_id}/{status?}', [App\Http\Controllers\ApiController::class, 'fetchRiderStatusParcelForSearchParcel']);
Route::get('fetch-rider-parcel-by-parcel-id/{parcel_id}', [App\Http\Controllers\ApiController::class, 'fetchRiderParcelInfo']);
Route::get('send-sms/{id}', [\App\Http\Controllers\SmsSettingController::class, 'testSms'])->name('send.sms');
