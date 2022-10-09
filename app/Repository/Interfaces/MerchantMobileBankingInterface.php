<?php

namespace App\Repository\Interfaces;

interface MerchantMobileBankingInterface
{
    public function allMobileBanking();

    public function allMerchantMobileBankingWithCondition($whereCondition);

    public function getAnInstance($mobileBankingId);

    public function MerchantMobileBankingCreate($requestData);

    public function updateMerchantMobileBanking(array $requestData, $mobileBankingData);

    public function deleteMerchantMobileBanking($mobileBankingData);
}
