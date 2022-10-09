<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Requests\ParcelRequest;
use App\Models\Parcel;
use App\Repository\Interfaces\ParcelInterface;
use App\services\ParcelService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class ParcelController extends Controller
{
    protected $parcelService;

    public function __construct(ParcelService $parcel)
    {
        $this->parcelService = $parcel;
    }

    public function index()
    {
        if (\request()->ajax()) {
            $parcels = $this->parcelService->parcelRepo->allLatestParcelByMerchantBasis(\request()->status);
            return DataTables::of($parcels)
                ->addIndexColumn()
                ->addColumn('customer_details', function ($parcel) {
                    return $this->parcelService->dataTableCustomerDetails($parcel);
                })
                ->addColumn('date_time', function ($parcel) {
                    return $this->parcelService->dataTableDateAndTime($parcel);
                })
                ->addColumn('payment_details', function ($parcel) {
                    return $this->parcelService->dataTablePaymentDetails($parcel);
                })
                ->addColumn('rider_info', function ($parcel) {
                    if (is_null($parcel->assigning_by)) {
                        return '<div class="badge badge-danger">No rider assign yet !</div>';
                    } else {
                        if (isset($parcel->rider)) {
                            return '<div class="badge badge-primary">' . $parcel->rider->name . '</div>';
                        } else {
                            return '<i class="text-danger">No merchant found</i>';
                        }
                    }
                })
                ->addColumn('action', function ($parcel) {
                    return view('merchant.parcel.action-button', compact('parcel'));
                })
                ->addColumn('status', function ($parcel) {
                    return $this->parcelService->parcelShowStatus($parcel->status);
                })
                ->rawColumns(['merchant_details', 'customer_details', 'date_time', 'status', 'rider_info', 'payment_details', 'action'])
                ->tojson();
        }
        $data = [
            'status' => \request()->status,
            'totalParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['merchant_id' => auth('merchant')->user()->id]),
            'pickupRequest' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'wait_for_pickup', 'merchant_id' => auth('merchant')->user()->id]),
            'totalPendingParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'pending', 'merchant_id' => auth('merchant')->user()->id]),
            'totalTransitParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'transit', 'merchant_id' => auth('merchant')->user()->id]),
            'totalDeliveredParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'delivered', 'merchant_id' => auth('merchant')->user()->id]),
            'totalHoldParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'hold', 'merchant_id' => auth('merchant')->user()->id]),
            'totalPartialParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'partial', 'merchant_id' => auth('merchant')->user()->id]),
            'totalCancelParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'cancelled', 'merchant_id' => auth('merchant')->user()->id]),
            'totalCancelAcceptByIncharge' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'cancel_accept_by_incharge', 'merchant_id' => auth('merchant')->user()->id]),
            'totalCancelAcceptByMerchant' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'cancel_accept_by_merchant', 'merchant_id' => auth('merchant')->user()->id]),
            'holdParcelAcceptByIncharge' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'hold_accept_by_incharge', 'merchant_id' => auth('merchant')->user()->id]),
        ];

        return view('merchant.parcel.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->parcelService->createNewParcel();
        return view('merchant.parcel.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParcelRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['status'] = 'wait_for_pickup';
            $data['guard_name'] = 'merchant';
            $data['added_by_merchant'] = auth('merchant')->user()->id;
            $parcel =  $this->parcelService->storeParcel($data);

            if (!empty($request->note)) {
                $this->parcelService->createParcelNote($parcel->id, 'merchant', $request->note);
            }
            DB::commit();
            return response()->successRedirect('New Parcel Added !', 'merchant.parcel.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->errorRedirect($e->getMessage(), '');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function show(Parcel $parcel)
    {
        $data['parcel'] = $this->parcelService->parcelRepo->parcelDetails($parcel->id, ['cityType', 'rider', 'area', 'merchant', 'collection', 'merchant.merchant_active_mobile_bankings', 'parcelType', 'merchant.area', 'reason.reason_type', 'created_by_admin', 'created_by_merchant', 'times', 'mobile_banking_collection', 'mobile_banking_collection.mobile_banking', 'mobile_banking_collection.merchant_mobile_banking']);
        return view('merchant.parcel.show', $data);
    }

    public function acceptCancelParcel($parcelId)
    {
        $parcel = $this->parcelService->parcelRepo->getAnInstance($parcelId);
        if ($parcel->status === 'cancel_accept_by_incharge') {

            try {
                DB::beginTransaction();
                $this->parcelService->parcelRepo->updateParcel(['status' => 'cancel_accept_by_merchant'], $parcel);
                $this->parcelService->createTime($parcelId, 'cancel_accept_by_merchant');
                DB::commit();
                return \response()->successRedirect('You accept your cancel parcel successfully', 'merchant.parcel.index');
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->errorRedirect($e->getMessage(), 'rider.parcel.index');
            }
        }
    }

    public function cancelParcelShow()
    {
        $data['parcels'] = Parcel::with('sub_area', 'notes', 'reason', 'reason.reason_type')->where(['delivery_status' => 'cancel_accept_by_incharge', 'merchant_id' => auth('merchant')->user()->id])->latest()->get();
        $data['number_of_records'] =  count($data['parcels']);
        return view('merchant.parcel.cancel-parcel', $data);
    }

    public function cancelParcelAccept(Request $request)
    {
        Parcel::whereIn('id', $request->parcelIds)->update(['delivery_status' => 'cancel_accept_by_merchant']);
        return \response()->successRedirect('You accept successfully', '');
    }
}
