<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\ParcelTransferInterface;
use App\services\ParcelService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ParcelTransferController extends Controller
{
    protected $parcelTransfer;
    protected $parcelRepo;
    public function __construct(ParcelTransferInterface $parcelTransfer, ParcelInterface $parcel)
    {
        $this->parcelTransfer = $parcelTransfer;
        $this->parcelRepo = $parcel;
    }

    public function index($parcelID){
        $data['parcel'] = $this->parcelRepo->parcelDetails($parcelID, ['parcel_transfers', 'parcel_transfers.rider', 'parcel_transfers.present_rider', 'parcel_transfers.sub_area']);
        return view('admin.parcel-transfer.index', $data);
    }

    public function accept($parcelTransferID, ParcelService $service){
        $transferData = $this->parcelTransfer->getAnInstance([], '*', $parcelTransferID);
        $parcelData = $this->parcelRepo->getParcelDataById($transferData->parcel_id);
        try{
            DB::beginTransaction();
            $transferRequestData = [
                'status'=>'accept',
                'accept_time'=>Carbon::now(),
                'accept_or_reject_by'=>auth('admin')->user()->id,
            ];
            $parcelRequestData = [
                'status'=>'pending',
                'sub_area_id'=>$transferData->transfer_sub_area,
                'assigning_by'=>$transferData->transfer_for,
            ];
            $this->parcelTransfer->updateTransferRequest($transferRequestData, $transferData);
            $this->parcelRepo->updateParcel($parcelRequestData, $parcelData);
            $service->createTime($parcelData->id, 'transfer_accept');
            DB::commit();
            return response()->successRedirect('You transfer successfully', 'admin.parcel.index');
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->errorRedirect($exception->getMessage(), 'rider.parcel.index');
        }
    }

    public function reject($parcelTransferID, ParcelService $service){
        $transferData = $this->parcelTransfer->getAnInstance([], '*', $parcelTransferID);
        $parcelData = $this->parcelRepo->getParcelDataById($transferData->parcel_id);
        try{
            DB::beginTransaction();
            $transferRequestData = [
                'status'=>'reject',
                'reject_time'=>Carbon::now(),
                'accept_or_reject_by'=>auth('admin')->user()->id,
            ];
            $this->parcelTransfer->updateTransferRequest($transferRequestData, $transferData);
            $this->parcelRepo->updateParcel(['status'=>'transit'], $parcelData);
            $service->createTime($parcelData->id, 'transfer_decline');
            DB::commit();
            return response()->successRedirect('You reject this transfer request', 'admin.parcel.index');
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->errorRedirect($exception->getMessage(), 'rider.parcel.index');
        }
    }
}
