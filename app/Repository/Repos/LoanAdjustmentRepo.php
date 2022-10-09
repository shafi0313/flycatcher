<?php

namespace App\Repository\Repos;

use App\Models\LoanAdjustment;
use App\Repository\Interfaces\LoanAdjustmentInterface;

class LoanAdjustmentRepo implements LoanAdjustmentInterface
{

    public function createLoanAdjustment($requestData)
    {
        return LoanAdjustment::create($requestData);
    }

    public function updateLoanAdjustment($requestData, $loanAdjustment)
    {
        return $loanAdjustment->update($requestData);
    }
}
