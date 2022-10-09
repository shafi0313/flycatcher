<?php

namespace App\Repository\Interfaces;

interface ExpenseHeadInterface
{
    public function allLatestExpenseHead();
    public function allExpenseHeadList();
    public function getAnInstance($ExpenseHeadId);
    public function createExpenseHead(array $data);
    public function updateExpenseHead(array $data, $ExpenseHeadId);
    public function deleteExpenseHead($ExpenseHeadId);
}
