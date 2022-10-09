<?php

namespace App\Repository\Repos;

use App\Models\MobileBankingCollection;
use App\Repository\Interfaces\MobileBankingCollectionInterface;

class MobileBankingCollectionRepo implements MobileBankingCollectionInterface
{

    public function createMobileBankingCollection(array $requestData)
    {
        return MobileBankingCollection::create($requestData);
    }

    public function deleteMobileBankingCollection($condition){
        return MobileBankingCollection::where($condition)->delete();
    }
}
