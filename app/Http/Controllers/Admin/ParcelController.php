<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParcelRequest;
use App\Http\Requests\RiderAssignRequest;
use App\Models\Admin\Rider;
use App\Models\Merchant;
use App\Models\Parcel;
use App\Repository\Interfaces\CollectionInterface;
use App\Repository\Interfaces\MobileBankingCollectionInterface;
use App\Repository\Interfaces\ParcelNoteInterface;
use App\services\ParcelService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ParcelController extends Controller
{
    protected $parcelService;
    protected $collectionRepo;
    protected $mobileBankingCollection;
    protected $parcelNoteRepo;

    public function __construct(ParcelService $parcel, CollectionInterface $collection, MobileBankingCollectionInterface $mobileBankingCollection, ParcelNoteInterface $parcelNote)
    {
        $this->parcelService = $parcel;
        $this->collectionRepo = $collection;
        $this->mobileBankingCollection = $mobileBankingCollection;
        $this->parcelNoteRepo = $parcelNote;
    }

    public function index(Request $request)
    {
        if (\request()->ajax()) {
            $parcels = $this->parcelService->parcelRepo->allLatestParcel(\request()->status);
            return DataTables::of($parcels)
                ->addIndexColumn()
                ->addColumn('customer_details', function ($parcel) {
                    return $this->parcelService->dataTableCustomerDetails($parcel);
                })
                ->addColumn('merchant_details', function ($parcel) {
                    return $this->parcelService->dataTableMerchantDetails($parcel);
                })
                ->addColumn('date_time', function ($parcel) {
                    return $this->parcelService->dataTableDateAndTime($parcel);
                })
                ->addColumn('payment_details', function ($parcel) {
                    return $this->parcelService->dataTablePaymentDetails($parcel);
                })
                ->addColumn('admin_assign', function ($parcel) {
                    $riders = $this->parcelService->riderRepo->allRiderList();
                    if ($parcel->status === 'pending') {
                        return view('admin.parcel.re-assign', compact('parcel', 'riders'));
                    } else {
                        return '<div class="badge badge-primary">' . $parcel->rider->name . '</div>';
                    }
                })

                ->addColumn('additional_note', function ($parcel) {
                    return $parcel->note;
                })

                ->addColumn('action', function ($parcel) {
                    $collection = $this->collectionRepo->getACollectionInConditionBasis(['parcel_id' => $parcel->id]);
                    return view('admin.parcel.action-button', compact('parcel', 'collection'));
                })
                ->addColumn('status', function ($parcel) {
                    return $this->parcelService->parcelShowStatus($parcel->status);
                })
                ->rawColumns(['merchant_details', 'customer_details', 'date_time', 'status', 'admin_assign', 'payment_details', 'action'])
                ->tojson();
        }
        $data = [
            'status' => \request()->status,
            'totalParcel' => Parcel::select(['id', 'status'])->whereNotIn('status', ['wait_for_pickup'])->count(),
            'totalPendingParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'pending']),
            'totalTransitParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'transit']),
            'totalDeliveredParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'delivered']),
            'totalExchangeParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'exchange']),
            'totalHoldParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'hold']),
            'holdParcelAcceptByIncharge' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'hold_accept_by_incharge']),
            'totalPartialParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'partial']),
            'totalCancelParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'cancelled']),
            'totalTransferParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'transfer']),
            'cancelAcceptByIncharge' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'cancel_accept_by_incharge']),
            'cancelAcceptByMerchant' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'cancel_accept_by_merchant']),
            'parcelReceivedAtOffice' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'received_at_office']),
        ];
        return view('admin.parcel.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $data = $this->parcelService->createNewParcel();
        return view('admin.parcel.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ParcelRequest $request
     * @return Response
     */
    public function store(ParcelRequest $request)
    {
        $data = $request->validated();
        $data['added_by_admin'] = auth('admin')->user()->id;
        $data['status'] = 'wait_for_pickup';
        try {
            DB::beginTransaction();
            $parcel = $this->parcelService->storeParcel($data);

            if (!empty($request->note)) {
                $this->parcelService->createParcelNote($parcel->id, 'admin', $request->note);
            }
            DB::commit();
            return response()->successRedirect('New Parcel Added !', '');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->errorRedirect($e->getMessage(), '');
        }

        // return response()->successRedirect('New Parcel Added !', '');
    }


    /**
     * Display the specified resource.
     *
     * @param Parcel $parcel
     * @return View
     */
    public function show(Parcel $parcel)
    {
        $data['parcel'] = $this->parcelService->parcelRepo->parcelDetails($parcel->id, ['cityType', 'rider', 'area', 'merchant', 'collection', 'merchant.merchant_active_mobile_bankings', 'parcelType', 'merchant.area', 'reason.reason_type', 'created_by_admin', 'created_by_merchant', 'times', 'mobile_banking_collection', 'mobile_banking_collection.mobile_banking', 'mobile_banking_collection.merchant_mobile_banking', 'parcel_transfers', 'parcel_transfers.rider', 'parcel_transfers.present_rider', 'parcel_transfers.sub_area', 'parcel_transfers.accept_reject']);
        return view('admin.parcel.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parcel  $parcel
     * @return Response
     */
    public function edit(Parcel $parcel)
    {

        $data = $this->parcelService->createNewParcel();
        $data['parcel'] = $parcel;

        return view('admin.parcel.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Parcel  $parcel
     * @return Response
     */
    public function update(ParcelRequest $request, Parcel $parcel)
    {
        $data = $request->validated();
        $data['payable'] = $request->collection_amount - ($request->collection_amount * $request->cod / 100) - $request->delivery_charge;
        $this->parcelService->parcelRepo->updateParcel($data, $parcel);
        return response()->successRedirect('Update successfully', 'admin.parcel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parcel  $parcel
     * @return Response
     */
    public function destroy(Parcel $parcel)
    {
        if ($parcel->status === 'received_at_office' || $parcel->status === 'wait_for_pickup' && ($parcel->added_by_admin === auth('admin')->user()->id) || auth('admin')->user()->hasRole('Developer')) {
            $this->parcelService->parcelRepo->deleteParcel($parcel);
            return response()->successRedirect('Parcel Information deleted Successfully!.', '');
        } else {
            return response()->errorRedirect('Sorry you may try to delete an unauthorized  parcel!.', '');
        }
    }

    public function assignRider(RiderAssignRequest $request, $id)
    {
        $data = [
            'assigned_by' => auth('admin')->user()->id,
            'assigning_by' => $request->rider_id,
            'status' => 'transit'
        ];
        try {
            DB::beginTransaction();
            $parcel = $this->parcelService->parcelRepo->getAnInstance($id);
            $this->parcelService->parcelRepo->updateParcel($data, $parcel);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect('Opps! something wrong', 'rider.parcel.index');
        }
        return \response()->successRedirect('Rider Reassign successfully', 'admin.parcel.index', ['status' => 'pending']);
    }

    public function SingleParcelAccept($parcelId)
    {
        $parcel = $this->parcelService->parcelRepo->getAnInstance($parcelId);
        $parcel->status = 'received_at_office';
        $parcel->save();
        return \response()->successRedirect('You accept parcel successfully', '');
    }
    public function parcelAccept($parcelId)
    {
        $parcel = $this->parcelService->parcelRepo->getAnInstance($parcelId);
        switch ($parcel->delivery_status) {
            case 'hold':
                try {
                    DB::beginTransaction();
                    $this->parcelService->parcelRepo->updateParcel(['status' => 'hold_accept_by_incharge', 'delivery_status' => 'hold_accept_by_incharge'], $parcel);
                    $this->parcelService->createTime($parcelId, 'hold_accept_by_incharge');
                    DB::commit();
                    return \response()->successRedirect('You accept parcel successfully', 'admin.parcel.index', ['status' => 'hold']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->errorRedirect($e->getMessage(), 'rider.parcel.index');
                }
                break;
            case 'partial':
                try {
                    DB::beginTransaction();
                    $this->parcelService->parcelRepo->updateParcel(['delivery_status' => 'partial_accept_by_incharge'], $parcel);
                    $this->parcelService->createTime($parcelId, 'partial_accept_by_incharge');
                    DB::commit();
                    return \response()->successRedirect('You accept parcel successfully', 'admin.parcel.index', ['status' => 'partial']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->errorRedirect($e->getMessage(), 'admin.parcel.index');
                }
                break;
            case 'exchange':
                try {
                    DB::beginTransaction();
                    $this->parcelService->parcelRepo->updateParcel(['delivery_status' => 'exchange_accept_by_incharge'], $parcel);
                    $this->parcelService->createTime($parcelId, 'exchange_accept_by_incharge');
                    DB::commit();
                    return \response()->successRedirect('You accept parcel successfully', 'admin.parcel.index', ['status' => 'exchange']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->errorRedirect($e->getMessage(), 'admin.parcel.index');
                }
                break;
            case 'cancelled':
                try {
                    DB::beginTransaction();
                    $this->parcelService->parcelRepo->updateParcel(['delivery_status' => 'cancel_accept_by_incharge'], $parcel);
                    $this->parcelService->createTime($parcelId, 'cancel_accept_by_incharge');
                    DB::commit();
                    return \response()->successRedirect('You accept parcel successfully', 'admin.parcel.index', ['status' => 'cancelled']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->errorRedirect($e->getMessage(), 'admin.parcel.index');
                }

                break;
        }
    }

    public function holdParcelReassign($parcelId)
    {
        $parcel = $this->parcelService->parcelRepo->getAnInstance($parcelId);
        try {
            DB::beginTransaction();
            $this->parcelService->parcelRepo->updateParcel(['status' => 'pending'], $parcel);
            $this->parcelService->createTime($parcelId, 'hold_parcel_transfer_to_rider');
            DB::commit();
            return \response()->successRedirect('You Transfer this Parcel Successfully', 'admin.parcel.index', ['status' => 'hold_accept_by_incharge']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect($e->getMessage(), 'rider.parcel.index');
        }
    }

    public function parcelUndo($parcelId)
    {
        $parcel = $this->parcelService->parcelRepo->getAnInstance($parcelId);
        $collection = $this->collectionRepo->getACollectionInConditionBasis(['parcel_id' => $parcelId]);

        if ($collection->rider_collected_status === 'collected' || $collection->rider_collected_status === 'transfer_request') {
            try {
                DB::beginTransaction();
                $this->parcelService->parcelRepo->updateParcel(['status' => 'transit', 'delivery_status' => 'processing', 'payment_status' => 'unpaid', 'payment_type' => 'not_payment_yet', 'cancle_partial_invoice' => null], $parcel);
                $this->collectionRepo->deleteCollection($collection);
                $this->mobileBankingCollection->deleteMobileBankingCollection(['parcel_id' => $parcelId]);
                $this->parcelService->createTime($parcelId, 'undo');
                DB::commit();
                return \response()->successRedirect('Parcel undo successfully', 'admin.parcel.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                return response()->errorRedirect('Opps! something wrong', 'admin.parcel.index');
            }
        } else {
            DB::rollBack();
            return response()->errorRedirect('Status Change is not possible', 'admin.parcel.index');
        }
    }

    public function reassignRider(RiderAssignRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $parcel = $this->parcelService->parcelRepo->getAnInstance($id);
            $this->parcelService->parcelRepo->updateParcel([
                'assigned_by' => auth('admin')->user()->id,
                'assigning_by' => $request->rider_id,
            ], $parcel);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect('Opps! something wrong', 'rider.parcel.index');
        }

        return \response()->successRedirect('Rider Reassign successfully', 'admin.parcel.index');
    }


    public function multipleCreate()
    {
        $data = $this->parcelService->createNewParcel();
        return \view('admin.multi-parcel.create', $data);
    }
    public function multipleStore(Request $request)
    {
        dd($request->all());
    }
    public function parcelDateAdjust()
    {

        return view('admin.dateAdjust.index');
    }
    public function parcelDateAdjustApply()
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime("-1 days"));
        DB::select(DB::raw("UPDATE parcels SET added_date=' $yesterday' WHERE (added_date = '$today' AND status <> 'wait_for_pickup')"));
        return \response()->successRedirect('Date Adjust Successfully Done!', 'admin.dashboard');
    }
}
