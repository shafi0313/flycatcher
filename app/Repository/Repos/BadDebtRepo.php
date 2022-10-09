<?php

namespace App\Repository\Repos;

use App\Models\BadDebt;
use App\Repository\Interfaces\BadDebtInterface;

class BadDebtRepo implements BadDebtInterface
{

    public function allBadDebtList($relation, $column, $condition)
    {
        return BadDebt::with($relation)->select($column)->where($condition)->latest();
    }

    public function findBadDebtDataById($relation, $column, $badDebtId)
    {
        return BadDebt::with($relation)->select($column)->findOrFail($badDebtId);
    }

    public function createBadDebt($requestData)
    {
        return BadDebt::create($requestData);
    }

    public function updateBadDebt(array $requestData, $badDebtData)
    {
        return $badDebtData->update($requestData);
    }

    public function deleteBadDebt($badDebtData)
    {
        return $badDebtData->delete();
    }
}
