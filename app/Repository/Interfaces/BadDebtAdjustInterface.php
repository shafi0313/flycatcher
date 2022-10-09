<?php

namespace App\Repository\Interfaces;

interface BadDebtAdjustInterface
{
    public function createBadDebtAdjust(array $requestData);

    public function updateBadDebtAdjust(array $requestData, $badDebtAdjustData);
}
