<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Rider;
use App\Models\Collection;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Repository\Interfaces\AreaInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\RiderInterface;
use App\Repository\Interfaces\SubAreaInterface;
use App\services\ParcelReportService;
use App\services\ParcelService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ParcelReportController extends Controller
{
    protected $merchantRepo;
    protected $parcelRepo;
    protected $areaRepo;
    protected $riderRepo;
    protected $subArea;

    public function __construct(MerchantInterface $merchant, ParcelInterface $parcel, AreaInterface $area, RiderInterface $rider, SubAreaInterface $subArea)
    {
        $this->merchantRepo = $merchant;
        $this->parcelRepo = $parcel;
        $this->areaRepo = $area;
        $this->riderRepo = $rider;
        $this->subArea = $subArea;
    }

    public function merchantWiseParcel()
    {
        $data = [
            'areas' => $this->areaRepo->allAreaList(),
            'riders' => $this->riderRepo->allRiderList(),
            'merchants' => $this->merchantRepo->allMerchantList(),
        ];
        return view('admin.report.merchant-wise.show', $data);
    }

    public function merchantWiseParcelSearch(Request $request)
    {
        if ($request->ajax()) {
            $dateRange = explode('-', $request->daterange);
            $startDate = \date('Y-m-d', strtotime($dateRange[0]));
            $endDate = \date('Y-m-d', strtotime($dateRange[1]));
            // if (isset($request->status)) {
            //     $parcels = $this->parcelRepo->getAllParcelListWithSpecificDateRange(['status' => $request->status, 'merchant_id' => $request->merchant_id], $startDate, $endDate);
            // } else {
            //     $parcels = $this->parcelRepo->getAllParcelListWithSpecificDateRange(['merchant_id' => $request->merchant_id], $startDate, $endDate);
            // }
            $parcelQuery = Parcel::with(['collection'])->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
                ->when($request->status === '0' && $request->payment_status === '0', function ($query) {
                    return $query->where(['merchant_id' => request()->merchant_id]);
                })
                ->when($request->status === '0' && $request->payment_status != '0', function ($query) {
                    return $query->whereHas('collection', function ($q) {
                        $q->where(['merchant_paid' => request()->payment_status]);
                    })->where(['merchant_id' => request()->merchant_id]);
                })
                ->when($request->status != '0' && $request->payment_status === '0', function ($query) {
                    return $query->where(['status' => request()->status, 'merchant_id' => request()->merchant_id]);
                })
                ->when($request->status != '0' && $request->payment_status != '0', function ($query) {
                    return $query->whereHas('collection', function ($q) {
                        $q->where(['merchant_paid' => request()->payment_status]);
                    })->where(['status' => request()->status, 'merchant_id' => request()->merchant_id]);
                });

            $data = [
                'parcels' => $parcelQuery->latest()->get(),
                'merchantInfo' => $this->merchantRepo->getAnInstance($request->merchant_id),
            ];
            return response()->view('admin.report.merchant-wise.search-result', $data);
        }
    }

    public function printParcelMerchantWise(Request $request, ParcelReportService $reportService)
    {
        $data = [
            'parcels' => $this->parcelRepo->getMultipleInstanceById($request->parcelIds),
            'merchant' => $this->merchantRepo->getAnInstance($request->merchant_id),
        ];
        $reportService->reportPdf('admin.report.merchant-wise.pdf', $data);
    }

    public function dateWiseParcel()
    {
        $data['areas'] = $this->areaRepo->allAreaList();
        return view('admin.report.date-wise.show', $data);
    }

    public function areaWiseParcel()
    {
        $data['areas'] = $this->areaRepo->allAreaList();
        return view('admin.report.area-wise.show', $data);
    }

    public function dateWiseParcelSearch(Request $request)
    {
        if ($request->ajax()) {
            $dateRange = explode('-', $request->date_range);
            $startDate = \date('Y-m-d', strtotime($dateRange[0]));
            $endDate = \date('Y-m-d', strtotime($dateRange[1]));
            if ($request->status === 'all') {
                $parcels = $this->parcelRepo->getAllParcelListWithSpecificDateRange([], $startDate, $endDate);
            } else {
                $parcels = $this->parcelRepo->getAllParcelListWithSpecificDateRange(['status' => $request->status], $startDate, $endDate);
            }

            $data = [
                'parcels' => $parcels,
            ];
            return response()->view('admin.report.date-wise.search-result', $data);
        }
    }

    public function areaWiseParcelSearch(Request $request)
    {
        if ($request->ajax()) {
            $dateRange = explode('-', $request->date_range);
            $startDate = \date('Y-m-d', strtotime($dateRange[0]));
            $endDate = \date('Y-m-d', strtotime($dateRange[1]));
            if (isset($request->status)) {
                $parcels = $this->parcelRepo->getAllParcelListWithSpecificDateRange(['status' => $request->status, 'area_id' => $request->area_id], $startDate, $endDate);
            } else {
                $parcels = $this->parcelRepo->getAllParcelListWithSpecificDateRange(['area_id' => $request->area_id], $startDate, $endDate);
            }

            $data = [
                'parcels' => $parcels,
                'areaInfo' => $this->areaRepo->getAnInstance($request->area_id),
            ];
            return response()->view('admin.report.area-wise.search-result', $data);
        }
    }

    public function printParcelDateWise(Request $request, ParcelReportService $reportService)
    {

        $data = [
            'parcels' => $this->parcelRepo->getMultipleInstanceById($request->parcelIds),
        ];
        $reportService->reportPdf('admin.report.date-wise.pdf', $data);
    }

    public function printParcelAreaWise(Request $request, ParcelReportService $reportService)
    {

        $data = [
            'parcels' => $this->parcelRepo->getMultipleInstanceById($request->parcelIds),
            'area' => $this->areaRepo->getAnInstance($request->area_id),
        ];
        $reportService->reportPdf('admin.report.area-wise.pdf', $data);
    }

    public function riderAssignParcel()
    {
        $data['riders'] = $this->riderRepo->allRiderList();
        return view('admin.rider-assign-parcel.show', $data);
    }
    public function riderAssignParcelSearch(Request $request)
    {
        if ($request->ajax()) {

            $parcels = $this->parcelRepo->riderWiseParcelReport(['assigning_by' => $request->rider_id, 'status' => $request->status]);

            $data = [
                'parcels' => $parcels,
                'riderInfo' => $this->riderRepo->getAnInstance($request->rider_id),
            ];


            return response()->view('admin.rider-assign-parcel.search-result', $data);
        }
    }
    public function assignParcelRiderWise(Request $request)
    {
        foreach ($request->parcelIds as $parcel_id) {
            $parcel = Parcel::find($parcel_id);
            $parcel->status = $request->to_status;
            $parcel->update();
        }
        return response()->successRedirect('Assign Successfully Done!.', '');
    }
    public function riderWiseParcel()
    {
        $data['riders'] = $this->riderRepo->allRiderList();
        return view('admin.report.rider-wise.show', $data);
    }

    public function riderWiseParcelSearch(Request $request)
    {
        if ($request->ajax()) {
            if (is_null($request->daterange) && $request->status === 'all') {

                $parcels = $this->parcelRepo->riderWiseParcelReport(['assigning_by' => $request->rider_id]);
            } elseif ($request->status !== 'all' && $request->daterange === null) {
                $parcels = $this->parcelRepo->riderWiseParcelReport(['assigning_by' => $request->rider_id, 'status' => $request->status]);
            } elseif ($request->status === 'all' && $request->daterange != null) {
                $dateRange = explode('to', request()->daterange);
                $startDate = $dateRange[0];
                $endDate = $dateRange[1];
                $parcels = $this->parcelRepo->riderWiseParcelReport(['assigning_by' => $request->rider_id], $startDate, $endDate);
            }
            //            $parcels = $this->parcelRepo->riderWiseParcelReport(['status' => $request->status, 'assigning_by' => $request->rider_id])
            //            $parcels=  Parcel::with(['cityType', 'rider', 'area', 'merchant', 'weightRange', 'parcelType'])
            //                ->when($request->has('dateRange') && $request->status === 'all', function ($query){
            //                    $dateRange = explode('to', \request()->daterange);
            //                    $startDate =$dateRange[0];
            //                    $endDate = $dateRange[1];
            //                   $query->where(['assigning_by' => \request()->rider_id])->whereBetween('created_at', [$startDate." 00:00:00", $endDate ." 23:59:59"]);
            //                })
            //                ->when($request->has('dateRange') && $request->status !== 'all', function ($query){
            //                    $dateRange = explode('to', request()->daterange);
            //                    $startDate =$dateRange[0];
            //                    $endDate = $dateRange[1];
            //                   $query->where(['assigning_by' => \request()->rider_id, 'status'=>\request()->status])->whereBetween('created_at', [$startDate." 00:00:00", $endDate ." 23:59:59"]);
            //                })
            //                ->when(is_null($request->dateRange) && $request->status !== 'all', function ($query){
            //                   $query->where(['assigning_by' => \request()->rider_id, 'status'=>\request()->status]);
            //                })->get();

            //where($condition)->whereBetween('created_at', [$startDate." 00:00:00", $endDate ." 23:59:59"])->get()


            //            if (isset($request->status)) {
            //                $parcels = $this->parcelRepo->getAllParcelListWithSpecificDateRange(['status' => $request->status, 'assigning_by' => $request->rider_id], $startDate, $endDate);
            //            } else {
            //                $parcels = $this->parcelRepo->getAllParcelListWithSpecificDateRange(['assigning_by' => $request->rider_id], $startDate, $endDate);
            //            }
            $data = [
                'parcels' => $parcels,
                'riderInfo' => $this->riderRepo->getAnInstance($request->rider_id),
            ];


            return response()->view('admin.report.rider-wise.search-result', $data);
        }
    }

    public function printParcelRiderWise(Request $request, ParcelReportService $reportService)
    {
        $data = [
            'parcels' => $this->parcelRepo->getMultipleInstanceById($request->parcelIds),
            'riderInfo' => $this->riderRepo->getAnInstance($request->rider_id),
        ];
        $reportService->reportPdf('admin.report.rider-wise.pdf', $data);
    }

    public function merchantParcelSummary()
    {
        $data['merchants'] = Merchant::select(['id', 'name', 'mobile'])->where(['status' => 'active', 'isActive' => 1])->get();
        return view('admin.report.merchant-parcel-summary.show', $data);
    }

    public function merchantParcelSummarySearch(Request $request)
    {
        if ($request->ajax()) {
            $dateRange = explode('-', $request->date_range);
            $startDate = \date('Y-m-d', strtotime($dateRange[0]));
            $endDate = date('Y-m-d', strtotime($dateRange[1]));
            if (isset($request->merchant_id)) {
                $data['merchants'] = Merchant::select(['id', 'name', 'mobile'])->where(['status' => 'active', 'isActive' => 1])->where('id', $request->merchant_id)->get();
            } else {
                $data['merchants'] = Merchant::select(['id', 'name', 'mobile'])->where(['status' => 'active', 'isActive' => 1])->get();
            }


            $data['start_date'] = $startDate . " 00:00:00";
            $data['end_date'] = $endDate . " 23:59:59";
            return view('admin.report.merchant-parcel-summary.search-result', $data);
        }
    }

    public function merchantParcelSummaryPrint(Request $request, ParcelReportService $reportService)
    {
        $data['merchants'] = Merchant::select(['id', 'name', 'mobile'])->where(['status' => 'active', 'isActive' => 1])->get();
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $reportService->reportPdf('admin.report.merchant-parcel-summary.pdf', $data);
    }

    public function parcelSummaryInOfficePdf(ParcelReportService $reportService)
    {
        $data = [
            'receivedInOffice' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'received_at_office'])->count(),
            'holdInOffice' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'hold_accept_by_incharge'])->count(),
            'partialInOffice' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'partial', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'partial_accept_by_incharge'])->count(),
            'exchangeInOffice' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'exchange', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'exchange_accept_by_incharge'])->count(),
            'cancelInOffice' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'cancelled', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'cancel_accept_by_incharge'])->count(),
        ];
        $reportService->reportPdf('admin.report.parcel-summary-in-progress.pdf', $data);
    }
    public function parcelSummaryInRiderPdf(ParcelReportService $reportService)
    {
        $data = [
            'pendingInRider' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'pending'])->count(),
            'transitInRider' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'transit'])->count(),
            'transferInRider' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'transfer'])->count(),
            'partialInRider' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'partial', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'partial'])->count(),
            'holdInRider' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'hold'])->count(),
            'cancelledInRider' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'cancelled', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'cancelled'])->count(),
            'exchangeInRider' => Parcel::select(['id', 'added_date', 'status'])->with('rider', 'merchant')->where(['status' => 'exchange', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'exchange'])->count(),
        ];
        $reportService->reportPdf('admin.report.parcel-summary-in-progress.pdf_rider', $data);
    }
    public function parcelSummaryInProgressDetails($status, $delivery_status = '', $cancle_partial_invoice = NULL)
    {

        $data = [
            'parcels' => Parcel::where(['status' => $status, 'delivery_status' => $delivery_status, 'cancle_partial_invoice' => $cancle_partial_invoice])->get()
        ];
        // dd($parcels);
        // $reportService->reportPdf('admin.report.parcel-summary-in-progress.details', $data);
        $pdf = PDF::loadView(
            'admin.report.parcel-summary-in-progress.details',
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'L',
            ]
        );
        $name = 'Parcel List-' . date("Y-m-d");
        return $pdf->stream($name . '.pdf');
    }
    public function parcelSummaryInProgress()
    {

        $data = [
            'receivedInOffice' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'received_at_office'])->count(),
            'holdInOffice' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'hold_accept_by_incharge'])->count(),
            'partialInOffice' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'partial', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'partial_accept_by_incharge'])->count(),
            'exchangeInOffice' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'exchange', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'exchange_accept_by_incharge'])->count(),
            'cancelInOffice' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'cancelled', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'cancel_accept_by_incharge'])->count(),

            'pendingInRider' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'pending', 'delivery_status' => 'processing', 'cancle_partial_invoice' => NULL])->count(),
            'transitInRider' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'transit', 'delivery_status' => 'processing', 'cancle_partial_invoice' => NULL])->count(),
            'transferInRider' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'transfer', 'delivery_status' => 'processing', 'cancle_partial_invoice' => NULL])->count(),
            'partialInRider' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'partial', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'partial'])->count(),
            'holdInRider' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'hold', 'delivery_status' => 'hold', 'cancle_partial_invoice' => NULL])->count(),
            'cancelledInRider' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'cancelled', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'cancelled'])->count(),
            'exchangeInRider' => Parcel::select(['id', 'added_date', 'status'])->where(['status' => 'exchange', 'cancle_partial_invoice' => 'no', 'delivery_status' => 'exchange'])->count(),

        ];
        return view('admin.report.parcel-summary-in-progress.show', $data);
    }
    public function parcelSummary()
    {
        return view('admin.report.parcel-summary.show');
    }

    public function parcelSummarySearch(Request $request, ParcelReportService $service)
    {
        if ($request->ajax()) {
            $dateRange = explode('to', \request()->dateRange);
            $startDate = "$dateRange[0] 00:00:00";
            $endDate = "$dateRange[1] 23:59:59";

            $data = [
                'oldestAll' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->count(),
                'oldestWaitForPickup' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'wait_for_pickup'])->count(),
                'oldestPending' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'pending'])->count(),
                'oldestTransit' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'transit'])->count(),
                'oldestTransfer' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'transfer'])->count(),
                'oldestPartial' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'partial'])->count(),
                'oldestDelivered' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'delivered'])->count(),
                'oldestHoldInRider' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'hold'])->count(),
                'oldestHoldInOffice' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'hold_accept_by_incharge'])->count(),
                'oldestCancelledInRider' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'cancelled'])->count(),
                'oldestCancelledInIncharge' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'cancel_accept_by_incharge'])->count(),
                'oldestCancelledInMerchant' => Parcel::select(['id', 'added_date', 'status'])->whereDate('added_date', '<', $startDate)->where(['status' => 'cancel_accept_by_merchant'])->count(),

                'all' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->count(),
                'waitForPickup' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'wait_for_pickup'])->count(),
                'pending' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'pending'])->count(),
                'transit' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'transit'])->count(),
                'transfer' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'transfer'])->count(),
                'partial' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'partial'])->count(),
                'delivered' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'delivered'])->count(),
                'holdInRider' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'hold'])->count(),
                'holdInOffice' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'hold_accept_by_incharge'])->count(),
                'cancelInRider' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'cancelled'])->count(),
                'cancelInOffice' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'cancel_accept_by_incharge'])->count(),
                'cancelInMerchant' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'cancel_accept_by_merchant'])->count(),
                'startDate' => $startDate,
                'endDate' => $endDate
            ];

            return response()->view('admin.report.parcel-summary.search-result', $data);
        }
    }

    public function parcelSummaryDetails(Request $request, ParcelService $service)
    {
        $data['startDate'] = $request->start_date;
        $data['endDate'] = $request->end_date;
        $data['status'] = $request->status;

        if (\request()->ajax()) {
            $parcels = Parcel::with(['cityType', 'rider', 'area', 'sub_area', 'merchant', 'weightRange', 'parcelType', 'parcel_transfers', 'notes', 'notes.admin', 'notes.merchant', 'notes.rider'])
                ->when(isset($request->end_date), function ($q) use ($request) {
                    return $q->whereBetween('added_date', [$request->start_date, $request->end_date])->whereIn('status', json_decode($request->status))->latest();
                }, function ($q) use ($request) {
                    return $q->whereDate('added_date', '<', $request->start_date)->whereIn('status', json_decode($request->status))->latest();
                });
            return DataTables::of($parcels)
                ->addIndexColumn()
                ->addColumn('tracking_id', function ($parcel) use ($service) {
                    return '<a target="_blank" href="' . route('admin.parcel.index') . '">' . $parcel->tracking_id . '</a>';
                })
                ->addColumn('customer_details', function ($parcel) use ($service) {
                    return $service->dataTableCustomerDetails($parcel);
                })
                ->addColumn('merchant_details', function ($parcel) use ($service) {
                    return $service->dataTableMerchantDetails($parcel);
                })
                ->addColumn('date_time', function ($parcel) use ($service) {
                    return $service->dataTableDateAndTime($parcel);
                })
                ->addColumn('payment_details', function ($parcel) use ($service) {
                    return $service->dataTablePaymentDetails($parcel);
                })
                ->addColumn('status', function ($parcel) use ($service) {
                    return $service->parcelShowStatus($parcel->status);
                })
                ->rawColumns(['tracking_id', 'merchant_details', 'customer_details', 'date_time', 'status', 'admin_assign', 'payment_details', 'action'])
                ->tojson();
        }
        return view('admin.report.parcel-summary.details', $data);
    }

    public function parcelSummaryPrint(Request $request, ParcelReportService $reportService)
    {
        $data = $reportService->countParcel($request->start_date, $request->end_date);
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $reportService->reportPdf('admin.report.parcel-summary.pdf', $data);
    }

    //Rider wise parcel
    public function riderWiseParcelCount()
    {
        $data['riders'] = $this->riderRepo->allRiderList();
        return view('admin.report.rider-wise-count.show', $data);
    }

    public function riderWiseParcelCountSearch(Request $request)
    {
        if ($request->ajax()) {
            $data['riders'] = Rider::when(
                $request->rider_id === 'all',
                function ($query) use ($request) {
                    $query->select('id', 'name', 'mobile');
                },
                function ($query) use ($request) {
                    $query->where(['id' => $request->rider_id]);
                }
            )->get();

            //$data['riders'] = Rider::all();
            $data['dateRange'] = $request->date_range;
            return response()->view('admin.report.rider-wise-count.search-result', $data);
        }
    }

    public function riderWiseParcelTotalParcelPdf(Request $request, ParcelReportService $reportService)
    {
        $data['riders'] = Rider::select(['id', 'name', 'mobile'])->whereIn('id', $request->rider_id)->get();
        $reportService->reportPdf('admin.report.rider-wise-count.pdf', $data);
    }

    public function ParcelSummaryInMerchantWise()
    {
        $data['merchants'] = Merchant::select(['id', 'name', 'mobile'])->where(['status' => 'active', 'isActive' => 1])->get();
        return view('admin.report.parcel-report-in-merchant-wise.show', $data);
    }

    public function parcelSummaryInMerchantWiseSearch(Request $request, ParcelReportService $service)
    {
        if ($request->ajax()) {
            $parcel = Parcel::with(['cityType', 'rider', 'area', 'sub_area', 'merchant', 'weightRange', 'parcelType', 'parcel_transfers'])
                ->when(is_null($request->dateRange) && $request->status === 'all', function ($query) use ($request) {
                    return $query->where(['merchant_id' => $request->merchant_id])->latest();
                })
                ->when(is_null($request->dateRange) && $request->status !== 'all', function ($query) use ($request) {
                    return $query->where(['merchant_id' => $request->merchant_id, 'status' => $request->status])->latest();
                })
                ->when($request->dateRange !== null && $request->status === 'all', function ($query) use ($request) {
                    $dateRange = explode('to', \request()->dateRange);
                    $startDate = "$dateRange[0] 00:00:00";
                    $endDate = "$dateRange[1] 23:59:59";
                    return $query->where(['merchant_id' => $request->merchant_id])->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->when($request->dateRange !== null && $request->status !== 'all', function ($query) use ($request) {
                    $dateRange = explode('to', \request()->dateRange);
                    $startDate = "$dateRange[0] 00:00:00";
                    $endDate = "$dateRange[1] 23:59:59";
                    return $query->where(['merchant_id' => $request->merchant_id, 'status' => $request->status])->whereBetween('created_at', [$startDate, $endDate]);
                });


            if ($request->status === 'all') {
                $data = $service->countAllStatusParcelInMerchantWise($request->status, $parcel, $request);
                return response()->view('admin.report.parcel-report-in-merchant-wise.search-result', $data);
            } else {
                $data = $service->countSpecificParcelInMerchantBasis($request->status, $parcel, $request);
                return response()->view('admin.report.parcel-report-in-merchant-wise.search-result', $data);
            }

            //            if($request->status === 'pending'){
            //                $data = $service->countSpecificParcelInMerchantBasis($request->status, $parcel, $request);
            ////                $data = [
            ////                    'parcels'=>$parcel->get(),
            ////                    'total' => $parcel->count(),
            ////                    'pending' => $this->parcelRepo->countParcel(['merchant_id'=>$request->merchant_id, 'status'=>'pending'], $request->dateRange),
            ////                ];
            //                return response()->view('admin.report.parcel-report-in-merchant-wise.search-result', $data);
            //            }
            //            if($request->status === 'transit'){
            //                $data = [
            //                    'parcels'=>$parcel->get(),
            //                    'total' => $parcel->count(),
            //                    'transit' => $this->parcelRepo->countParcel(['merchant_id'=>$request->merchant_id, 'status'=>'transit'], $request->dateRange),
            //                ];
            //                return response()->view('admin.report.parcel-report-in-merchant-wise.search-result', $data);
            //            }
            //            if($request->status === 'delivered'){
            //                $data = [
            //                    'parcels'=>$parcel->get(),
            //                    'total' => $parcel->count(),
            //                    'delivered' => $this->parcelRepo->countParcel(['merchant_id'=>$request->merchant_id, 'status'=>'delivered'], $request->dateRange),
            //                ];
            //                return response()->view('admin.report.parcel-report-in-merchant-wise.search-result', $data);
            //            }
            //            if($request->status === 'hold'){
            //                $data = [
            //                    'parcels'=>$parcel->get(),
            //                    'total' => $parcel->count(),
            //                    'hold' => $this->parcelRepo->countParcel(['merchant_id'=>$request->merchant_id, 'status'=>'hold'], $request->dateRange),
            //                ];
            //                return response()->view('admin.report.parcel-report-in-merchant-wise.search-result', $data);
            //            }
            //            if($request->status === 'partial'){
            //                $data = [
            //                    'parcels'=>$parcel->get(),
            //                    'total' => $parcel->count(),
            //                    'partial' => $this->parcelRepo->countParcel(['merchant_id'=>$request->merchant_id, 'status'=>'partial'], $request->dateRange),
            //                ];
            //                return response()->view('admin.report.parcel-report-in-merchant-wise.search-result', $data);
            //            }
            //            if($request->status === 'cancelled'){
            //                $data = [
            //                    'parcels'=>$parcel->get(),
            //                    'total' => $parcel->count(),
            //                    'cancel' => $this->parcelRepo->countParcel(['merchant_id'=>$request->merchant_id, 'status'=>'cancelled'], $request->dateRange),
            //                ];
            //                return response()->view('admin.report.parcel-report-in-merchant-wise.search-result', $data);
            //            }
        }
    }


    public function ParcelSummaryInRiderWise()
    {
        $data['riders'] = Rider::select(['id', 'name', 'mobile'])->where(['status' => 'active'])->get();
        return view('admin.report.parcel-report-in-rider-wise.show', $data);
    }

    public function parcelSummaryInRiderWiseSearch(Request $request, ParcelReportService $service)
    {
        if ($request->ajax()) {
            $parcel = Parcel::with(['cityType', 'rider', 'area', 'sub_area', 'merchant', 'weightRange', 'parcelType', 'parcel_transfers'])
                ->when(is_null($request->dateRange) && $request->status === 'all', function ($query) use ($request) {
                    return $query->where(['assigning_by' => $request->rider_id])->latest();
                })
                ->when(is_null($request->dateRange) && $request->status !== 'all', function ($query) use ($request) {
                    return $query->where(['assigning_by' => $request->rider_id, 'status' => $request->status])->latest();
                })
                ->when($request->dateRange !== null && $request->status === 'all', function ($query) use ($request) {
                    $dateRange = explode('to', \request()->dateRange);
                    $startDate = "$dateRange[0] 00:00:00";
                    $endDate = "$dateRange[1] 23:59:59";
                    return $query->where(['assigning_by' => $request->rider_id])->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->when($request->dateRange !== null && $request->status !== 'all', function ($query) use ($request) {
                    $dateRange = explode('to', \request()->dateRange);
                    $startDate = "$dateRange[0] 00:00:00";
                    $endDate = "$dateRange[1] 23:59:59";
                    return $query->where(['assigning_by' => $request->rider_id, 'status' => $request->status])->whereBetween('created_at', [$startDate, $endDate]);
                });


            if ($request->status === 'all') {
                $data = $service->countAllStatusParcelInRiderWise($request->status, $parcel, $request);
                return response()->view('admin.report.parcel-report-in-rider-wise.search-result', $data);
            } else {
                $data = $service->countSpecificParcelInRiderBasis($request->status, $parcel, $request);
                return response()->view('admin.report.parcel-report-in-rider-wise.search-result', $data);
            }
        }
    }

    public function parcelSummeryBeforeDate()
    {
        return view('admin.report.parcel-report-before-date.show');
    }

    public function parcelSummeryBeforeDateSearch(Request $request)
    {
        if ($request->ajax()) {
            $dateRange = explode('to', \request()->dateRange);
            $startDate = "$dateRange[0] 00:00:00";
            $endDate = "$dateRange[1] 23:59:59";
            $parcel = Parcel::select(['id', 'created_at'])->oldest()->first();
            $oldestDate = Carbon::parse($parcel->created_at)->format('Y-m-d H:i:s');

            $data = [
                'oldestAll' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->count(),
                'oldestWaitForPickup' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'wait_for_pickup'])->count(),
                'oldestPending' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'pending'])->count(),
                'oldestTransit' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'transit'])->count(),
                'oldestTransfer' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'transfer'])->count(),
                'oldestPartial' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'partial'])->count(),
                'oldestDelivered' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'delivered'])->count(),
                'oldestHoldInRider' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'hold'])->count(),
                'oldestHoldInOffice' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'hold_accept_by_incharge'])->count(),
                'oldestCancelledInRider' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'cancelled'])->count(),
                'oldestCancelledInIncharge' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'cancel_accept_by_incharge'])->count(),
                'oldestCancelledInMerchant' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$oldestDate, $startDate])->where(['status' => 'cancel_accept_by_merchant'])->count(),

                'all' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->count(),
                'waitForPickup' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'wait_for_pickup'])->count(),
                'pending' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'pending'])->count(),
                'transit' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'transit'])->count(),
                'transfer' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'transfer'])->count(),
                'partial' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'partial'])->count(),
                'delivered' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'delivered'])->count(),
                'holdInRider' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'hold'])->count(),
                'holdInOffice' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'hold_accept_by_incharge'])->count(),
                'cancelInRider' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'cancelled'])->count(),
                'cancelInOffice' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'cancel_accept_by_incharge'])->count(),
                'cancelInMerchant' => Parcel::select(['id', 'added_date', 'status'])->whereBetween('added_date', [$startDate, $endDate])->where(['status' => 'cancel_accept_by_merchant'])->count(),

            ];

            return response()->view('admin.report.parcel-report-before-date.search-result', $data);
        }
    }


    public function areaWiseParcelSummery()
    {
        $data['areas'] = $this->areaRepo->allAreaList();
        return view('admin.report.area-wise-summery.show', $data);
    }

    public function getSubAreaDataByAreaId(Request $request)
    {
        if ($request->ajax()) {
            $html = '<option value="all" selected>All</option>';
            $subAreas = $this->subArea->getSubAreaWithCondition(['area_id' => $request->area_id]);
            foreach ($subAreas as $subArea) {
                $html .= '<option value="' . $subArea->id . '">' . $subArea->name . '</option>';
            }
            return response()->json(['html' => $html]);
        }
    }

    public function areaWiseParcelSummarySearch(Request $request)
    {
        //return $request->all();
        if ($request->ajax()) {
            $query = Parcel::select(['id', 'area_id', 'sub_area_id', 'status'])
                ->when(!empty($request->input('date_range')) && $request->sub_area_id === 'all', function ($query) use ($request) {
                    $dateRange = explode('to', $request->date_range);
                    $startDate = "$dateRange[0] 00:00:00";
                    $endDate = "$dateRange[1] 23:59:59";
                    return $query->where(['area_id' => $request->area_id])->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->when(!empty($request->input('date_range')) && $request->sub_area_id !== 'all', function ($query) use ($request) {
                    $dateRange = explode('to', $request->date_range);
                    $startDate = "$dateRange[0] 00:00:00";
                    $endDate = "$dateRange[1] 23:59:59";
                    return $query->where(['area_id' => $request->area_id, 'sub_area_id' => $request->sub_area_id])->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->when(empty($request->input('date_range')) && $request->sub_area_id !== 'all', function ($query) use ($request) {
                    return $query->where(['area_id' => $request->area_id, 'sub_area_id' => $request->sub_area_id]);
                })
                ->when(empty($request->input('date_range')) && $request->sub_area_id === 'all', function ($query) use ($request) {
                    return $query->where(['area_id' => $request->area_id]);
                });


            $parcel = $query->get();
            $data = [
                'all' => $parcel->count(),
                'wait_for_pickup' => $parcel->where('status', 'wait_for_pickup')->count(),
                'transit' => $parcel->where('status', 'transit')->count(),
                'delivered' => $parcel->where('status', 'delivered')->count(),
                'partial' => $parcel->where('status', 'partial')->count(),
                'pending' => $parcel->where('status', 'pending')->count(),
                'cancelled' => $parcel->where('status', 'cancelled')->count(),
                'cancel_accept_by_incharge' => $parcel->where('status', 'cancel_accept_by_incharge')->count(),
                'cancel_accept_by_merchant' => $parcel->where('status', 'cancel_accept_by_merchant')->count(),
                'hold' => $parcel->where('status', 'hold')->count(),
                'hold_accept_by_incharge' => $parcel->where('status', 'hold_accept_by_incharge')->count(),
            ];

            return response()->view('admin.report.area-wise-summery.search-result', $data);
        }
    }
}
