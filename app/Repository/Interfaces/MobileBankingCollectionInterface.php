<?php

namespace App\Repository\Interfaces;

interface MobileBankingCollectionInterface
{
    public function createMobileBankingCollection(array $requestData);

    public function deleteMobileBankingCollection($condition);
}
