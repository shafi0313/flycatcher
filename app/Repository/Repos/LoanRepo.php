<?php

namespace App\Repository\Repos;

use App\Models\Loan;
use App\Repository\Interfaces\LoanInterface;

class LoanRepo implements LoanInterface
{

    public function allLoanList($relation, $column, $condition = [])
    {
        return Loan::with($relation)->select($column)->where($condition)->latest();
    }
    public function findLoanDataById($relation, $column, $loanId){
        return Loan::with($relation)->select($column)->findOrFail($loanId);
    }
    public function createLoan($requestData)
    {
       return Loan::create($requestData);
    }

    public function updateLoan($requestData, $loanData)
    {
       return $loanData->update($requestData);
    }

    public function deleteLoan($loanData)
    {
        return $loanData->delete();
    }
}
