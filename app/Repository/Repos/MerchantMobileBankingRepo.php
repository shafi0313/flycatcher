<?php

namespace App\Repository\Repos;

use App\Models\MerchantMobileBanking;
use App\Models\MobileBanking;
use App\Repository\Interfaces\MerchantMobileBankingInterface;

class MerchantMobileBankingRepo implements MerchantMobileBankingInterface
{

    public function allMobileBanking(){
        return MobileBanking::all();
    }

    public function allMerchantMobileBankingWithCondition($whereCondition)
    {
        return MerchantMobileBanking::with('mobile_banking')->where($whereCondition)->latest()->get();
    }

    public function getAnInstance($mobileBankingId){
        return MerchantMobileBanking::findOrFail($mobileBankingId);
    }

    public function MerchantMobileBankingCreate($requestData)
    {
        return MerchantMobileBanking::create($requestData);
    }

    public function updateMerchantMobileBanking($requestData, $mobileBankingData)
    {
       return $mobileBankingData->update($requestData);
    }

    public function deleteMerchantMobileBanking($mobileBankingData)
    {
        // TODO: Implement deleteMerchantMobileBanking() method.
    }
}
