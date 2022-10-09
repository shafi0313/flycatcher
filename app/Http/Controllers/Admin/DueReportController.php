<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Rider;
use App\Models\Collection;
use App\Models\Parcel;
use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\services\DueReportService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use function GuzzleHttp\Promise\all;

class DueReportController extends Controller
{
    protected $merchant;
    protected $admin;

    public function __construct(MerchantInterface $merchant, AdminInterface $admin)
    {
        $this->merchant = $merchant;
        $this->admin = $admin;
    }

    public function merchantWiseDue()
    {
        $data['merchants'] = $this->merchant->allMerchantList();
        return view('admin.report.due-report-merchant-wise.show', $data);
    }

    public function merchantWiseDueSearch(Request $request, DueReportService $service)
    {
        if ($request->ajax()) {
//            $query = Parcel::with('collection')
//                ->when(! empty($request->date_range) , function ($query) use ($request) {
//                    $dateRange = explode('to', \request()->date_range);
//                    $startDate = "$dateRange[0] 00:00:00";
//                    $endDate = "$dateRange[1] 23:59:59";
//                    return $query->where(['merchant_id' => $request->merchant_id])->whereBetween('created_at', [$startDate, $endDate]);
//                }, function ($query) use ($request){
//                    return $query->where(['merchant_id' => $request->merchant_id]);
//
//                });
            $query = $service->getDueQueryInMerchantWise($request);
            $parcels = $query->latest()->get();
            $data['parcels'] = $parcels;

            $data['totalPendingAmount'] = $parcels->where('status', 'pending')->sum('collection_amount');
            $data['totalPendingDeliveryCharge'] = $parcels->where('status', 'pending')->sum('delivery_charge');
            $data['totalPendingCodCharge'] = $parcels->where('status', 'pending')->sum('cod');
            $data['countPendingParcel'] = $parcels->where('status', 'pending')->count();

            $data['totalTransitAmount'] = $parcels->where('status', 'transit')->sum('collection_amount');
            $data['totalTransitDeliveryCharge'] = $parcels->where('status', 'transit')->sum('delivery_charge');
            $data['totalTransitCodCharge'] = $parcels->where('status', 'transit')->sum('cod');
            $data['countTransitParcel'] = $parcels->where('status', 'transit')->count();

            $data['totalHoldInRiderAmount'] = $parcels->where('status', 'hold')->sum('collection_amount');
            $data['totalHoldInRiderDeliveryCharge'] = $parcels->where('status', 'hold')->sum('delivery_charge');
            $data['totalHoldInRiderCodCharge'] = $parcels->where('status', 'hold')->sum('cod');
            $data['countHoldInRiderParcel'] = $parcels->where('status', 'hold')->count();

            $data['totalHoldInOfficeAmount'] = $parcels->where('status', 'hold_accept_by_incharge')->sum('collection_amount');
            $data['totalHoldInOfficeDeliveryCharge'] = $parcels->where('status', 'hold_accept_by_incharge')->sum('delivery_charge');
            $data['totalHoldInOfficeCodCharge'] = $parcels->where('status', 'hold_accept_by_incharge')->sum('cod');
            $data['countHoldInOfficeParcel'] = $parcels->where('status', 'hold_accept_by_incharge')->count();

            $data['totalTransferAmount'] = $parcels->where('status', 'transfer')->sum('collection_amount');
            $data['totalTransferDeliveryCharge'] = $parcels->where('status', 'transfer')->sum('delivery_charge');
            $data['totalTransferCodCharge'] = $parcels->where('status', 'transfer')->sum('cod');
            $data['countTransferParcel'] = $parcels->where('status', 'transfer')->count();

            $data['totalNotCollectedAmount'] = $service->getTotalNotCollectedAmount($request);
            $data['totalNotCollectedDeliveryCharge'] = $service->getTotalNotCollectedDeliveryCharge($request);
            $data['totalNotCollectedCod'] = $service->getTotalNotCollectedCODCharge($request);

            $data['totalParcelPrice'] = $query->sum('collection_amount');
            $data['totalDeliveryCharge'] = $query->sum('delivery_charge');
            $data['totalCodCharge'] = $query->sum('cod');

            $data['totalCollectedAmount'] = $service->getTotalCollectedAmountInMerchantWise($request);
            $data['totalCollectedDeliveryCharge'] = $service->getTotalDeliverChargeInMerchantWise($request);
            $data['totalCollectedCODCharge'] = $service->getTotalCODChargeInMerchantWise($request);
            $data['totalNetPayable'] = $service->getTotalNetPayableInMerchantWise($request);


            $data['totalPaidForMerchant'] = $service->getTotalPaidForMerchant($request);

            $data['riders'] = Rider::where(['status' => 'active'])->get();
            $data['incharges'] = $this->admin->getAdminWithSpecificRole(['name' => 'Incharge', 'guard_name' => 'admin'], ['isActive' => 1]);;
            $data['accountants'] = $this->admin->getAdminWithSpecificRole(['name' => 'Accountant', 'guard_name' => 'admin'], ['isActive' => 1]);

            $data['merchant_id'] = $request->merchant_id;
            $data['date_range'] = $request->date_range;
            return response()->view('admin.report.due-report-merchant-wise.search-result', $data);
        }
    }

    public function merchantWiseDueDetailsByStatus()
    {
        $parcels = Parcel::select(['id', 'invoice_id', 'tracking_id', 'collection_amount', 'delivery_charge', 'cod'])
            ->when(!empty(\request()->date_range), function ($query) {
                $dateRange = explode('to', \request()->date_range);
                $startDate = "$dateRange[0] 00:00:00";
                $endDate = "$dateRange[1] 23:59:59";
                return $query->where(['merchant_id' => \request()->merchant_id, 'status' => \request()->status])->whereBetween('created_at', [$startDate, $endDate])->latest();
            }, function ($query) {
                return $query->where(['merchant_id' => \request()->merchant_id, 'status' => \request()->status])->latest();
            });
        if (\request()->ajax()) {
            return DataTables::of($parcels)
                ->addIndexColumn()
                ->addColumn('tracking_id', function ($parcel) {
                    return '<a href="' . route('admin.parcel.show', $parcel->id) . '">' . $parcel->tracking_id . '</a>';
                })
                ->rawColumns(['tracking_id'])
                ->tojson();
        }
        $data = [
            'status' => \request()->status,
            'merchant_id' => \request()->merchant_id,
            'date_range' => \request()->date_range,
        ];
        return view('admin.report.due-report-merchant-wise.status-wise-show', $data);
    }

    public function merchantWiseDueDetailsByRider()
    {
         $collections = Collection::with('parcel')
            ->whereHas('parcel', function ($query) {
                $query->where(['merchant_id' => \request()->merchant_id,]);
            })
            ->when(!empty(\request()->date_range), function ($query) {
                $dateRange = explode('to', \request()->date_range);
                $startDate = "$dateRange[0] 00:00:00";
                $endDate = "$dateRange[1] 23:59:59";
                return $query->where(['rider_collected_by' => \request()->rider_id])->whereBetween('created_at', [$startDate, $endDate])->latest();
            }, function ($query) {
                return $query->where(['rider_collected_by' => \request()->rider_id])->latest();
            });

        if (\request()->ajax()) {
            return DataTables::of($collections)
                ->addIndexColumn()
                ->addColumn('tracking_id', function ($collection) {
                    return '<a href="' . route('admin.parcel.show', $collection->parcel->id) . '">' . $collection->parcel->tracking_id . '</a>';
                })
                ->addColumn('parcel_status', function ($collection) {
                    return str_replace('_', ' ', ucfirst($collection->parcel->status));
                })
                ->addColumn('is_paid', function ($collection) {
                    if($collection->rider_collected_status === 'collected' || $collection->rider_collected_status === 'transfer_request'){
                        return '<p class="text-danger"><i class="fas fa-times"></i></i></p>';
                    }
                    elseif($collection->rider_collected_status === 'transferred'){
                        return '<p class="text-success"><i class="fas fa-check"></i></p>';
                    }
                   // return '<a href="' . route('admin.parcel.show', $collection->parcel->id) . '">' . $collection->parcel->tracking_id . '</a>';
                })
                ->rawColumns(['tracking_id', 'is_paid', 'parcel_status'])
                ->tojson();
        }
        $data = [
            'rider' =>  Rider::findOrFail(\request()->rider_id),
            'merchant_id' => \request()->merchant_id,
            'date_range' => \request()->date_range,
        ];
        return view('admin.report.due-report-merchant-wise.rider-wise-show', $data);
    }

    public function merchantWiseDueDetailsByAdmin(){
        $collections = Collection::with('parcel')
            ->whereHas('parcel', function ($query) {
                $query->where(['merchant_id' => \request()->merchant_id,]);
            })
            ->when(!empty(\request()->date_range), function ($query) {
                $dateRange = explode('to', \request()->date_range);
                $startDate = "$dateRange[0] 00:00:00";
                $endDate = "$dateRange[1] 23:59:59";
                return $query->where(['incharge_collected_by' => \request()->admin_id])->whereBetween('created_at', [$startDate, $endDate])->latest();
            }, function ($query) {
                return $query->where(['incharge_collected_by' => \request()->admin_id])->latest();
            });

        if (\request()->ajax()) {
            return DataTables::of($collections)
                ->addIndexColumn()
                ->addColumn('tracking_id', function ($collection) {
                    return '<a href="' . route('admin.parcel.show', $collection->parcel->id) . '">' . $collection->parcel->tracking_id . '</a>';
                })
                ->addColumn('parcel_status', function ($collection) {
                    return str_replace('_', ' ', ucfirst($collection->parcel->status));
                })
                ->addColumn('is_paid', function ($collection) {
                    if($collection->incharge_collected_status === 'collected' || $collection->incharge_collected_status === 'transfer_request'){
                        return '<p class="text-danger"><i class="fas fa-times"></i></i></p>';
                    }
                    elseif($collection->incharge_collected_status === 'transferred'){
                        return '<p class="text-success"><i class="fas fa-check"></i></p>';
                    }
                })
                ->rawColumns(['tracking_id', 'is_paid', 'parcel_status'])
                ->tojson();
        }
        $data = [
            'admin' =>  Admin::findOrFail(\request()->admin_id),
            'merchant_id' => \request()->merchant_id,
            'date_range' => \request()->date_range,
        ];
        return view('admin.report.due-report-merchant-wise.admin-wise-show', $data);
    }

    public function merchantWiseDueDetailsByAccountant(){
        $collections = Collection::with('parcel')
            ->whereHas('parcel', function ($query) {
                $query->where(['merchant_id' => \request()->merchant_id,]);
            })
            ->when(!empty(\request()->date_range), function ($query) {
                $dateRange = explode('to', \request()->date_range);
                $startDate = "$dateRange[0] 00:00:00";
                $endDate = "$dateRange[1] 23:59:59";
                return $query->where(['accounts_collected_by' => \request()->accountant_id])->whereBetween('created_at', [$startDate, $endDate])->latest();
            }, function ($query) {
                return $query->where(['accounts_collected_by' => \request()->accountant_id])->latest();
            })->get();

        if (\request()->ajax()) {
            return DataTables::of($collections)
                ->addIndexColumn()
                ->addColumn('tracking_id', function ($collection) {
                    return '<a href="' . route('admin.parcel.show', $collection->parcel->id) . '">' . $collection->parcel->tracking_id . '</a>';
                })
                ->addColumn('parcel_status', function ($collection) {
                    return str_replace('_', ' ', ucfirst($collection->parcel->status));
                })
                ->addColumn('is_paid', function ($collection) {
                    if($collection->merchant_paid === 'unpaid'){
                        return '<p class="text-danger"><i class="fas fa-times"></i></i></p>';
                    }
                    elseif($collection->merchant_paid === 'paid' || $collection->merchant_paid === 'received'){
                        return '<p class="text-success"><i class="fas fa-check"></i></p>';
                    }
                })
                ->rawColumns(['tracking_id', 'is_paid', 'parcel_status'])
                ->tojson();
        }
        $data = [
            'admin' =>  Admin::findOrFail(\request()->accountant_id),
            'merchant_id' => \request()->merchant_id,
            'date_range' => \request()->date_range,
        ];
        return view('admin.report.due-report-merchant-wise.accountant-wise-show', $data);
    }
}
