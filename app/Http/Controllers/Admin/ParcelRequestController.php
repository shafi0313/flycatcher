<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Rider;
use App\Models\Parcel;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\SubAreaInterface;
use App\services\ParcelService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ParcelRequestController extends Controller
{
    protected $parcelService;
    protected $subAreaRepo;

    public function __construct(ParcelService $service, SubAreaInterface $subArea)
    {
        $this->parcelService = $service;
        $this->subAreaRepo = $subArea;
    }

    public function index(){
        //$data['parcels'] = $this->parcelService->parcelRepo->getAllParcelListWithCondition(['status'=>'wait_for_pickup']);
        $data['merchants'] =$this->parcelService->merchantRepo->allMerchantList();
        $data['totalCollectedAmount'] = Parcel::select(['id', 'collection_amount'])->where(['status'=>'wait_for_pickup'])->sum('collection_amount');
        if (\request()->ajax()) {
            $parcels = $this->parcelService->parcelRepo->allLatestParcel('wait_for_pickup');
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
                ->addColumn('action', function ($parcel) {
                    return view('admin.parcel-request.action-button', compact('parcel'));
                })
                ->addColumn('status', function ($parcel) {
                    return $this->parcelService->parcelShowStatus($parcel->status);
                })
                ->rawColumns(['merchant_details', 'customer_details', 'date_time', 'payment_details','action','status'])
                ->tojson();
        }
        return view('admin.parcel-request.index', $data);
    }
    public function parcelRequestMerchantBasis(Request $request){
        if ($request->ajax()) {
            $dateRange = explode('-', $request->daterange);
            $startDate = \date('Y-m-d', strtotime($dateRange[0]));
            $endDate = \date('Y-m-d', strtotime($dateRange[1]));

         $parcels = $this->parcelService->parcelRepo->getAllParcelListWithSpecificDateRange(['merchant_id' => $request->merchant_id, 'status' => 'wait_for_pickup'], $startDate, $endDate);
         $totalParcelPrice = Parcel::select(['id', 'collection_amount'])->where(['merchant_id' => $request->merchant_id, 'status' => 'wait_for_pickup'])->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->sum('collection_amount');
           $data = [
                'parcels' => $parcels,
                'totalParcelPrice'=>$totalParcelPrice,
                //'riderInfo' => $this->riderRepo->getAnInstance($request->rider_id),
            ];
            return response()->view('admin.parcel-request.search-result', $data);
        }
    }
    public function accept(Request $request){
        foreach ($request->parcelIds as $id){
            $parcel = $this->parcelService->parcelRepo->getParcelDataById($id);

            $assigningBy = $this->subAreaRepo->getAnInstance($parcel->sub_area_id);

            if(isset($assigningBy->assign_sub_area)){
                $riderAssign = $assigningBy->assign_sub_area->assignable->id;
            }else{
                $riderAssign = 16;
            }
            $data = [
                'status'=>'received_at_office',
                'assigning_by'=>$riderAssign,
            ];
            $this->parcelService->parcelRepo->updateParcel($data, $parcel);
        }
        return response()->successRedirect('You accept parcel request successfully!.', 'admin.parcel.request');
    }
}
