<?php

namespace App\Repository\Repos;

use App\Models\Merchant;
use App\Repository\Interfaces\MerchantInterface;

class
MerchantRepo implements MerchantInterface
{
    public function allLeastestMerchant($isActive, $status = ''){
        if(empty($status)){
            return Merchant::with('area')->latest();
        }else{
            return Merchant::with('area')->where(['status'=>$status, 'isActive'=>$isActive])->latest();
        }
    }
    public function allMerchantList(){
        return Merchant::with('area')->where(['status'=>'active', 'isActive'=>'1'])->latest('id')->get();
    }
    public function getAnInstance($merchantId){
        return Merchant::with('area')->findOrFail($merchantId);
    }
    public function merchantDetailsInstance($merchantId){
        return Merchant::with(['area', 'delivery_charges', 'delivery_charges.cityType', 'delivery_charges.weightRange', 'payment_method', 'pickup_method', 'bank_account', 'bank_account.bank', 'merchant_active_mobile_bankings','merchant_active_mobile_bankings.mobile_banking','admin'])
            ->findOrFail($merchantId);
    }
    public function createMerchant($data){
        return Merchant::create($data);
    }
    public function updateMerchant($requestData, $merchantData){
        return $merchantData->update($requestData);
    }
    public function deleteMerchant($merchantId){
        $area = $this->getAnInstance($merchantId);
        return $area->delete();
    }

     public function statusChange($merchantData, $status, $isActive){
        return $merchantData->update([
            'status'=>$status,
            'isActive'=>$isActive
         ]);
    }

    public function countMerchantWithCondition($condition = ''){
        if($condition == ''){
            return Merchant::count();
        }else{
            return Merchant::where($condition)->count();
        }
    }
}
