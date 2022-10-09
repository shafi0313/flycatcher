<?php

namespace App\Repository\Repos;

use App\Models\DeliveryCharge;
use App\Repository\Interfaces\DeliveryChargeInterface;


class DeliveryChargeRepo implements DeliveryChargeInterface
{
    public function allLatestGlobalDeliveryCharge(){
        return DeliveryCharge::with('cityType', 'weightRange')->where('is_global', 'yes')->latest('id');
    }
    public function allDeliveryChargeList(){
        return DeliveryCharge::with('cityType', 'weightRange')->where(['is_global'=>'yes', 'status'=>'active'])->latest('id')->get();
    }
    public function getAnInstance($deliveryChargeID){
        return DeliveryCharge::findOrFail($deliveryChargeID);
    }
    public function createDeliveryCharge($data){
        return DeliveryCharge::create($data);
    }
    public function updateDeliveryCharge($requestData, $deliveryCharge){
        return $deliveryCharge->update($requestData);
    }
    public function deleteDeliveryCharge($deliveryCharge){
        return $deliveryCharge->delete();
    }
}
