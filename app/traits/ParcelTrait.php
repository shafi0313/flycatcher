<?php

namespace App\traits;

use App\Models\Parcel;
use App\Repository\Interfaces\CityTypeInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\ParcelTypeInterface;
use App\Repository\Interfaces\ReasonInterface;
use App\Repository\Interfaces\RiderInterface;
use App\Repository\Interfaces\WeightRangeInterface;
use Yajra\DataTables\Facades\DataTables;

trait ParcelTrait
{
    protected $parcelRepo;
    protected $riderRepo;
    protected $weightRangeRepo;
    protected $parcelTypeRepo;
    protected $merchantRepo;
    protected $cityTypeRepo;
    protected $reasonRepo;

    public function __construct(ParcelInterface $parcelInterface, CityTypeInterface $cityTypeInterface, RiderInterface $riderInterface, MerchantInterface $merchantInterface, ParcelTypeInterface $parcelTypeInterface, WeightRangeInterface $weightRangeInterface, ReasonInterface $reasonInterface)
    {
        $this->parcelRepo = $parcelInterface;
        $this->riderRepo = $riderInterface;
        $this->weightRangeRepo = $weightRangeInterface;
        $this->parcelTypeRepo = $parcelTypeInterface;
        $this->merchantRepo = $merchantInterface;
        $this->cityTypeRepo = $cityTypeInterface;
        $this->reasonRepo = $reasonInterface;
    }

    public function parcelListDataTable($type, $view, $data){
        if($type === 'admin'){
            $parcels =  $this->parcelRepo->allLatestParcel(\request()->status);
        }
        if($type === 'merchant'){
            $parcels =  $this->parcelRepo->allLatestParcelByMerchantBasis(\request()->status);
        }
        if($type === 'rider'){
            $parcels =  $this->parcelRepo->allLatestParcelByRiderBasis(\request()->status);
        }
        $data['riders'] = $this->riderRepo->allRiderList();
        $holdReasons =$this->reasonRepo->getAllHoldReasonType();
        $cancelReasons =$this->reasonRepo->getAllCancelReasonType();
        if (\request()->ajax()) {
            return DataTables::of($parcels)
                ->addIndexColumn()
                ->addColumn('customer_details', function ($parcel) {
                    return '<b>Name: </b>' . $parcel->customer_name . '<br><b>Mobile: </b>' . $parcel->customer_mobile . '<br><b>Area:</b>'.$parcel->area->area_name.'('.$parcel->area->area_code.')<br><b>Address: </b>' . $parcel->customer_address;
                })
                ->addColumn('merchant_details', function ($parcel) {
                    return '<b>Name: </b>' . $parcel->merchant->name . '<br><b>Mobile: </b>' . $parcel->merchant->mobile .'<br><b>Area:</b>'.$parcel->merchant->area->area_name.'('.$parcel->merchant->area->area_code.')<br><b>Address: </b>' . $parcel->merchant->address;
                })
                ->addColumn('date_time', function ($parcel) {
                    return date('g A d M y', strtotime($parcel->created_at));
                })
                ->addColumn('payment_details', function ($parcel) {
                    return '<b>Collection Amount: </b>' . $parcel->collection_amount . ' tk <br><b>Delivery Charge: </b>'
                        . $parcel->delivery_charge . ' tk <br><b>COD: </b>' . $parcel->cod . 'tk' . '<br><b>Payable: </b>' . $parcel->payable . ' tk';
                })
                ->addColumn('admin_assign', function ($parcel) use ($data){
                    if(is_null($parcel->assigning_by)){
                        $data['parcelId'] = $parcel->id;
                        return view('admin.parcel.assign-option-button', $data);
                    }else{
                        return '<div class="badge badge-primary">'.$parcel->rider->name.' ('.$parcel->rider->rider_code.')</div>';
                    }
                })
                ->addColumn('merchant_assign', function ($parcel) use ($data){
                    if(is_null($parcel->assigning_by)){
                        return '<div class="badge badge-danger">No rider assign yet !</div>';
                    }else{
                        return '<div class="badge badge-primary">'.$parcel->rider->name.'</div>';
                    }
                })
                ->addColumn('action', function ($parcel) use ($type, $holdReasons, $cancelReasons) {
                    switch ($type){
                        case 'admin':
                            return view('admin.parcel.action-button', compact('parcel', 'holdReasons', 'cancelReasons'));
                        case 'merchant':
                            return view('merchant.parcel.action-button', compact('parcel'));
                        case 'rider':
                            return view('rider.parcel.action-button', compact('parcel', 'holdReasons', 'cancelReasons'));
                    }
                })
                ->addColumn('status', function ($parcel) {
                    return showStatus($parcel->status);
                })
                ->rawColumns(['merchant_details', 'customer_details', 'date_time', 'status','admin_assign', 'merchant_assign', 'payment_details', 'action'])

                ->tojson();
        }
        return view($view, $data);
    }

    public function deliveredParcel($parcelId){
        $parcel = $this->parcelRepo->getAnInstance($parcelId);
        $this->parcelRepo->updateParcel(['status'=>'delivered'], $parcel);
    }

}
