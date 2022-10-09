<?php

namespace App\Repository\Interfaces;

interface MerchantInterface
{
    public function allLeastestMerchant($isActive, $status);
    public function allMerchantList();
    public function getAnInstance($merchantId);
    public function merchantDetailsInstance($merchantId);
    public function createMerchant(array $data);
    public function updateMerchant($requestData, $merchantData);
    public function deleteMerchant($merchantId);
    public function statusChange($merchantData, $status, $isActive);
    public function countMerchantWithCondition($condition);
//    public function merchantInactive($merchantData);
}
