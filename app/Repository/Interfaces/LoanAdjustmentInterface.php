<?php

namespace App\Repository\Interfaces;

interface LoanAdjustmentInterface
{
    public function createLoanAdjustment(array $requestData);

    public function updateLoanAdjustment(array $requestData, $loanAdjustment);

}
