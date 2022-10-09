<?php

namespace App\Http\Controllers\Rider;

use App\Http\Requests\ParcelStatusRequest;
use App\Models\Parcel;
use App\Repository\Interfaces\CollectionInterface;
use App\Repository\Interfaces\MobileBankingCollectionInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\ParcelTimeInterface;
use App\services\ParcelService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class ParcelController extends Controller
{
    protected $parcelService;
    protected $collectionRepo;
    protected $mobileBankingCollection;

    public function __construct(ParcelService $parcel, CollectionInterface $collection, MobileBankingCollectionInterface $mobileBankingCollection)
    {
        $this->parcelService = $parcel;
        $this->collectionRepo = $collection;
        $this->mobileBankingCollection = $mobileBankingCollection;
    }

    public function index()
    {
        $parcels = $this->parcelService->parcelRepo->allLatestParcelByRiderBasis(\request()->status);
        if (\request()->ajax()) {
            return DataTables::of($parcels)
                ->addIndexColumn()
                ->addColumn('parcel_details', function ($parcel) {
                    $collection = $this->collectionRepo->getACollectionInConditionBasis(['parcel_id' => $parcel->id]);
                    return \view('rider.parcel.details', compact('parcel', 'collection'));
                })
                ->rawColumns(['parcel_details'])
                ->tojson();
        }
        $data = [
            'status' => \request()->status,
            'totalParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['assigning_by' => auth('rider')->user()->id]),
            'totalPendingParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'pending', 'assigning_by' => auth('rider')->user()->id]),
            'totalTransitParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'transit', 'assigning_by' => auth('rider')->user()->id]),
            'totalDeliveredParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'delivered', 'assigning_by' => auth('rider')->user()->id]),
            'totalHoldParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'hold', 'assigning_by' => auth('rider')->user()->id]),
            'holdParcelAcceptByIncharge' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'hold_accept_by_incharge', 'assigning_by' => auth('rider')->user()->id]),
            'totalPartialParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'partial', 'assigning_by' => auth('rider')->user()->id]),
            'totalCancelParcel' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['status' => 'cancelled', 'assigning_by' => auth('rider')->user()->id]),
            'totalCancelAcceptByIncharge' => $this->parcelService->parcelRepo->parcelCountInDifferentStatus(['delivery_status' => 'cancel_accept_by_incharge', 'assigning_by' => auth('rider')->user()->id]),
        ];

        return view('rider.parcel.index', $data);
    }

    public function show(Parcel $parcel)
    {
        $data['parcel'] = $this->parcelService->parcelRepo->parcelDetails($parcel->id, ['cityType', 'rider', 'area', 'merchant', 'collection', 'merchant.merchant_active_mobile_bankings', 'parcelType', 'merchant.area', 'reason.reason_type', 'created_by_admin', 'created_by_merchant', 'times', 'mobile_banking_collection', 'mobile_banking_collection.mobile_banking', 'mobile_banking_collection.merchant_mobile_banking']);
        return view('rider.parcel.show', $data);
    }

    public function acceptParcel($parcelId)
    {
        try {
            $parcel = $this->parcelService->parcelRepo->getAnInstance($parcelId);
            $parcel->increment('transit_count');
            $this->parcelService->parcelRepo->updateParcel(['status' => 'transit'], $parcel);
            $this->parcelService->createTime($parcelId, 'transit');
            return response()->successRedirect('You accepted the parcel successfully', 'rider.parcel.index', ['status' => 'pending']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->errorRedirect('Opps! something wrong', 'rider.parcel.index');
        }
    }

    public function statusChange($parcelId)
    {
        $data['holdReasons'] = $this->parcelService->reasonRepo->getAllHoldReasonType();
        $data['cancelReasons'] = $this->parcelService->reasonRepo->getAllCancelReasonType();
        $data['parcel'] = $this->parcelService->parcelRepo->getAnInstance($parcelId);
        $data['mobileBankings'] = $this->parcelService->mobileBankingRepo->allMobileBanking();
        return view('rider.parcel.status-change', $data);
    }

    public function storeStatusChange(ParcelStatusRequest $request, $parcelId)
    {
        $parcel = $this->parcelService->parcelRepo->getAnInstance($parcelId);
        switch ($request->status) {
            case 'partial':
                if ($request->partial_amount < $parcel->collection_amount) {
                    $this->parcelService->partialDelivery($request->validated(), $parcel);
                    return response()->successRedirect('Parcel Partially Delivered successfully', 'rider.parcel.index', ['status' => 'transit']);
                } else {
                    return response()->errorRedirect('Partial amount must be less than original price', '');
                }
            case 'delivered':
                $this->parcelService->fullDelivery($parcel);
                return response()->successRedirect('Parcel Delivered successfully', 'rider.parcel.index', ['status' => 'transit']);
                break;
            case 'exchange':
                $this->parcelService->exchangeDelivery($parcel);
                return response()->successRedirect('Parcel Exchange successfully', 'rider.parcel.index', ['status' => 'transit']);
                break;
            case 'mobileBanking':
                $totalRequestAmount = $request->mobile_partial_amount + $request->mobile_banking_amount;
                if ($totalRequestAmount <= $parcel->collection_amount) {
                    $this->parcelService->mobileBanking($request->validated(), $parcel);
                    return response()->successRedirect('Parcel Partially Delivered successfully', 'rider.parcel.index', ['status' => 'transit']);
                } else {
                    return response()->errorRedirect('Amount must be less than original price', '');
                }
            case 'hold':
                $this->parcelService->holdParcel($request, $parcel);
                return response()->successRedirect('Parcel Hold successfully', 'rider.parcel.index', ['status' => 'transit']);
            case 'cancelled':
                if ($request->cancel_collection <= $parcel->collection_amount) {
                    $this->parcelService->cancelParcel($request, $parcel);
                    return response()->successRedirect('Parcel Canceled successfully', 'rider.parcel.index', ['status' => 'transit']);
                } else {
                    return response()->errorRedirect('Partial amount must be less than original price', '');
                }
        }
    }

    public function parcelUndo($parcelId)
    {
        $parcel = $this->parcelService->parcelRepo->getAnInstance($parcelId);
        $collection = $this->collectionRepo->getACollectionInConditionBasis(['parcel_id' => $parcelId]);

        if ($collection->rider_collected_status === 'collected' || $collection->rider_collected_status === 'transfer_request') {
            try {
                DB::beginTransaction();
                $this->parcelService->parcelRepo->updateParcel(['status' => 'transit', 'delivery_status' => 'processing','payment_status' => 'unpaid', 'payment_type' => 'not_payment_yet','cancle_partial_invoice'=>null], $parcel);
                $this->collectionRepo->deleteCollection($collection);
                $this->mobileBankingCollection->deleteMobileBankingCollection(['parcel_id' => $parcelId]);
                $this->parcelService->createTime($parcelId, 'undo');
                DB::commit();
                return \response()->successRedirect('Parcel undo successfully', 'rider.parcel.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                return response()->errorRedirect('Opps! something wrong', 'rider.parcel.index');
            }
        } else {
            DB::rollBack();
            return response()->errorRedirect('Status Change is not possible', 'rider.parcel.index');
        }
    }
}
