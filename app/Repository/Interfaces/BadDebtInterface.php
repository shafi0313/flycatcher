<?php

namespace App\Repository\Interfaces;

interface BadDebtInterface
{
    public function allBadDebtList($relation, $column, $condition);
    public function findBadDebtDataById($relation, $column, $badDebtId);
    public function createBadDebt($requestData);
    public function updateBadDebt(array $requestData, $badDebtData);
    public function deleteBadDebt($badDebtData);
}
