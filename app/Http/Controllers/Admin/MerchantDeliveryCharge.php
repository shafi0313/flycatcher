<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryChargeRequest;
use App\Repository\Interfaces\CityTypeInterface;
use App\Repository\Interfaces\DeliveryChargeInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\WeightRangeInterface;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MerchantDeliveryCharge extends Controller
{
    protected $cityTypeRepo;
    protected $merchantRepo;
    protected $weightRangeRepo;
    protected $deliveryChargeRepo;
    public function __construct(CityTypeInterface $cityType, WeightRangeInterface $weightRange, MerchantInterface $merchant, DeliveryChargeInterface $deliveryCharge)
    {
        $this->merchantRepo = $merchant;
        $this->cityTypeRepo = $cityType;
        $this->weightRangeRepo = $weightRange;
        $this->deliveryChargeRepo = $deliveryCharge;
    }

    public function create($id){
        $data = [
            'merchantInfo'=>$this->merchantRepo->getAnInstance($id),
            'weightRanges'=>$this->weightRangeRepo->allWeightRangeList(),
            'cityTypes' =>$this->cityTypeRepo->getAllCityTypes(),
        ];
        return view('admin.merchant.delivery-charge.create', $data);
    }

    public function store(DeliveryChargeRequest $request, $merchantId){
        $data = $request->validated() ;
        $data['merchant_id'] = $merchantId;
        $data['is_global'] = 'no';
        $this->deliveryChargeRepo->createDeliveryCharge($data);
        return response()->successRedirect('Info updated !','admin.merchant.index');
    }

    public function edit($deliveryChargeId){
        $data =[
            'weightRanges' =>$this->weightRangeRepo->allWeightRangeList(),
            'cityTypes'=>$this->cityTypeRepo->getAllCityTypes(),
            'charge'=>$this->deliveryChargeRepo->getAnInstance($deliveryChargeId),
        ];

        return view('admin.merchant.delivery-charge.edit', $data);
    }

    public function update(DeliveryChargeRequest $request, $deliveryChargeId){
        $deliveryCharge = $this->deliveryChargeRepo->getAnInstance($deliveryChargeId);
        $this->deliveryChargeRepo->updateDeliveryCharge($request->validated(), $deliveryCharge);
        return response()->successRedirect('Delivery Charge updated !','admin.merchant.index');
    }

    public function delete($deliveryChargeId){
         $deliveryCharge = $this->deliveryChargeRepo->getAnInstance($deliveryChargeId);
        $this->deliveryChargeRepo->deleteDeliveryCharge($deliveryCharge);
        return response()->successRedirect('Delivery Charge deleted !','');
    }
}
