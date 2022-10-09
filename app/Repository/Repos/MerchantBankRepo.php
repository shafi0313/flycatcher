<?php

namespace App\Repository\Repos;

use App\Models\Bank;
use App\Models\MerchantBankAccount;
use App\Repository\Interfaces\MerchantBankInterface;

class MerchantBankRepo implements MerchantBankInterface
{

    public function allBankList()
    {
        return Bank::all();
    }

    public function merchantBankInfoWithCondition($whereCondition)
    {
        return MerchantBankAccount::with('bank')->where($whereCondition)->get();
    }

    public function getAnInstance($bankId)
    {
        return MerchantBankAccount::findOrFail($bankId);
    }

    public function createBankAccount($requestData)
    {
        return MerchantBankAccount::create($requestData);
    }

    public function updateBankAccount(array $requestData, $bankInfo)
    {
        return $bankInfo->update($requestData);
    }
}
