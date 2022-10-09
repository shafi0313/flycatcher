<?php

namespace App\Repository\Repos;

use App\Models\Expense;
use App\Repository\Interfaces\ExpenseInterface;

class ExpenseRepository implements ExpenseInterface
{
    public function getAllLatestExpense()
    {
        return Expense::with('hub','created_admin', 'updated_admin', 'expense_head')->latest();
    }
    public function genAnInstance($expenseID)
    {
        return Expense::findOrFail($expenseID);
    }

    public function expenseDetailById($expenseID){
        return  Expense::with('hub','created_admin', 'updated_admin')->findOrFail($expenseID);
    }

    public function storeExpense($requestData)
    {
        return Expense::create($requestData);
    }

    public function edit($expense)
    {
        return $expense;
    }

    public function updateExpense(array $requestData, $expenseData)
    {
        return $expenseData->update($requestData);
    }

    public function deleteExpense($expenseData)
    {
        return $expenseData->delete();
    }
}
