<?php

namespace App\Repository\Repos;

use App\Models\MerchantPickupMethod;
use App\Repository\Interfaces\MerchantPickupMethodInterface;

class MerchantPickupMethodRepo implements MerchantPickupMethodInterface
{
    public function createMerchantPickupMethod($requestData){
        return MerchantPickupMethod::create($requestData);
    }

    public function getInstanceMerchantBasis($merchantID){
        return MerchantPickupMethod::with('merchant')->where('merchant_id', $merchantID)->first();
    }

    public function getAnInstance($pickupId){
        return MerchantPickupMethod::findOrFail($pickupId);
    }

    public function updatePickupMethod($requestData, $pickupData){
        return $pickupData->update($requestData);
    }
}
