<?php

namespace App\Repository\Interfaces;

interface LoanInterface
{
    public function allLoanList($relation, $column, $condition);
    public function findLoanDataById($relation, $column, $loanId);
    public function createLoan($requestData);
    public function updateLoan(array $requestData, $loanData);
    public function deleteLoan($loanData);
}
