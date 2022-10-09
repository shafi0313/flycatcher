<?php

namespace App\Repository\Interfaces;

interface ExpenseInterface
{
    /**
     * @return mixed
     */
    public function getAllLatestExpense();
    public function genAnInstance($expenseID);
    public function expenseDetailById($expenseID);
    public function storeExpense(array $requestData);
    public function edit($id);
    public function updateExpense(array $requestData, $expenseData);
    public function deleteExpense($expenseData);
}
