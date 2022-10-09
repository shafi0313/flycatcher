<?php

namespace App\Repository\Repos;

use App\Models\Parcel;
use App\Models\PickupRequest;
use App\Repository\Interfaces\PickupRequestInterface;
use Illuminate\Support\Facades\DB;

class PickupRequestRepo implements PickupRequestInterface
{
    public function latestPickupRequestWithCondition($condition = ''){
        if(!empty($condition)){
            return PickupRequest::with(['merchant', 'weight_range', 'parcel_type', 'rider', 'admin'])->where($condition)->latest('id');
        }else{
            return PickupRequest::with(['merchant', 'weight_range', 'parcel_type', 'rider', 'admin'])->latest('id');
        }
    }


      public function getAnInstance($pickupId){
         return PickupRequest::findOrFail($pickupId);
      }

      public function updatePickupRequest($requestData, $pickupRequestData){
         return $pickupRequestData->update($requestData);
      }

    public function deletePickupRequest($pickupData){
         return $pickupData->delete();
    }

    public function totalPickupParcel($merchantId){
         return PickupRequest::where(['merchant_id'=>$merchantId, 'status'=>'wait_for_pickup'])->count();
    }

    public function pickupRequestCountInDifferentStatus($whereCondition= ''){
        if($whereCondition == ''){
            return PickupRequest::count();
        }else{
            return PickupRequest::where($whereCondition)->count();
        }
    }
}
