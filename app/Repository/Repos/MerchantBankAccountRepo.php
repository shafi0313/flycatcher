<?php

namespace App\Repository\Repos;

use App\Models\Bank;
use App\Models\MerchantBankAccount;
use App\Models\MerchantPaymentMethod;
use App\Models\MobileBanking;
use App\Repository\Interfaces\MerchantBankAccountInterface;

class MerchantBankAccountRepo implements MerchantBankAccountInterface
{
    public function getBankList(){
        return Bank::orderBy('name', 'asc')->get();
    }

    public function createMerchantBnkAccount($bankAccountData)
    {
        return MerchantBankAccount::create($bankAccountData);
    }

    public function createPaymentMethod($paymentMethodData){
        return MerchantPaymentMethod::create($paymentMethodData);
    }

    public function getBankAccountInstanceMerchantBasis($merchantId){
        return MerchantBankAccount::where('merchant_id', $merchantId)->first();
    }
    public function getPaymentMethodInstanceMerchantBasis($merchantId){
        return MerchantPaymentMethod::where('merchant_id', $merchantId)->first();
    }

    public function updateBankAccountInfo($requestData, $bankAccountInfo){
        return $bankAccountInfo->update($requestData);
    }
    public function updateMerchantPaymentMethod($requestData, $paymentMethodInfo){
        return $paymentMethodInfo->update($requestData);
    }

    public function createMobileBanking($mobileBankingData){
        return MobileBanking::create($mobileBankingData);
    }

    public function getMobileBankMerchantBasis($merchantId){
        return MobileBanking::where('merchant_id', $merchantId)->first();
    }

    public function getMobileBankingInstance($mobileBankId){
        return MobileBanking::findOrFail($mobileBankId);
    }

    public function updateMobileBankingInfo(array $requestData, $mobileBankInfo){
        return $mobileBankInfo->update($requestData);
    }
}
