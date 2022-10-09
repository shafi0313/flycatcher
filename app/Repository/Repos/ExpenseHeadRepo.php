<?php

namespace App\Repository\Repos;

use App\Models\ExpenseHead;
use App\Repository\Interfaces\ExpenseHeadInterface;

class ExpenseHeadRepo implements ExpenseHeadInterface
{
    public function allLatestExpenseHead(){
        return ExpenseHead::latest();
    }
    public function allExpenseHeadList(){
        return ExpenseHead::where(['status'=>'active'])->orderBy('title', 'asc')->get();
    }
    public function getAnInstance($ExpenseHeadId){
        return ExpenseHead::findOrFail($ExpenseHeadId);
    }
    public function createExpenseHead($data){
        return ExpenseHead::create($data);
    }
    public function updateExpenseHead($data, $ExpenseHeadId){
        $area = $this->getAnInstance($ExpenseHeadId);
        return $area->update($data);
    }
    public function deleteExpenseHead($ExpenseHeadId){
        $area = $this->getAnInstance($ExpenseHeadId);
        return $area->delete();
    }
}
