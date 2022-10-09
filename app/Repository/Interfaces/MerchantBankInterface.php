<?php

namespace App\Repository\Interfaces;

interface MerchantBankInterface
{
    public function allBankList();

    public function merchantBankInfoWithCondition($whereCondition);

    public function getAnInstance($bankId);

    public function createBankAccount(array $requestData);

    public function updateBankAccount(array $requestData, $bankInfo);
}
