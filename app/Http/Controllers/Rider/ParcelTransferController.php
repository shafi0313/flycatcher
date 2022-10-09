<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\ParcelTransferInterface;
use App\Repository\Interfaces\RiderInterface;
use App\services\ParcelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParcelTransferController extends Controller
{
    protected  $parcelRepo;
    protected  $riderRepo;
    protected  $parcelTransferRepo;

    public function __construct(ParcelInterface $parcel, RiderInterface $rider, ParcelTransferInterface $parcelTransfer)
    {
        $this->parcelRepo = $parcel;
        $this->riderRepo = $rider;
        $this->parcelTransferRepo = $parcelTransfer;
    }

    public function request($parcelID){
        $data['parcel'] = $this->parcelRepo->parcelDetails($parcelID, ['rider']);
        $data['riders'] = $this->riderRepo->riderList([], ['id', 'name'], ['status'=>'active']);
        return view('rider.parcel-transfer.show', $data);
    }

    public function fetchSubArea(Request $request){
        $data['parcel_id'] = $request->parcel_id;
        $data['rider'] = $this->riderRepo->riderDetailsById(['assign_areas', 'assign_areas.sub_area'], $request->transfer_for);
        return response()->view('rider.parcel-transfer.search-result', $data);
    }

    public function processRequest(Request $request, ParcelService $service){
        $request->validate([
            'parcel_id'=>'required|numeric',
            'transfer_for'=>'required|numeric',
            'transfer_sub_area'=>'required|numeric'
        ]);
        try{
            DB::beginTransaction();
            $data['parcel_id'] = $request->parcel_id;
            $data['transfer_by'] = auth('rider')->user()->id;
            $data['transfer_for'] = $request->transfer_for;
            $data['transfer_sub_area'] = $request->transfer_sub_area;
            $parcelInfo = $this->parcelRepo->getAnInstance($request->parcel_id);
            $this->parcelRepo->updateParcel(['status'=>'transfer', 'is_transfer'=>'yes'], $parcelInfo);
            $this->parcelTransferRepo->createParcelTransfer($data);
            $service->createTime($request->parcel_id, 'transfer_create');
            DB::commit();
            return response()->successRedirect('Your Transfer Request Send Successfully', 'rider.parcel.index', ['status'=>'transit']);
        }catch (\Exception $exception){

        }


    }
}
