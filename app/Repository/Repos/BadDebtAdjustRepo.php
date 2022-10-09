<?php

namespace App\Repository\Repos;

use App\Models\BadDebtAdjust;
use App\Repository\Interfaces\BadDebtAdjustInterface;

class BadDebtAdjustRepo implements BadDebtAdjustInterface
{

    public function createBadDebtAdjust(array $requestData)
    {
        return BadDebtAdjust::create($requestData);
    }

    public function updateBadDebtAdjust(array $requestData, $badDebtAdjustData)
    {
        return $badDebtAdjustData->update($requestData);
    }
}
