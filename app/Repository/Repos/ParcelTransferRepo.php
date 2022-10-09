<?php

namespace App\Repository\Repos;


use App\Models\ParcelTransfer;
use App\Repository\Interfaces\ParcelTransferInterface;

class ParcelTransferRepo implements ParcelTransferInterface
{

    public function allLatestParcelTransfer($relation, $columnName, $condition){
        return ParcelTransfer::with($relation)->select($columnName)->where($condition)->latest('id')->get();
    }

    public function createParcelTransfer($requestData)
    {
        return ParcelTransfer::create($requestData);
    }

    public function getAnInstance($relation, $column, $parcelId)
    {
        return ParcelTransfer::with($relation)->select($column)->findOrFail($parcelId);
    }

    public function updateTransferRequest($requestData, $transferData)
    {
        return $transferData->update($requestData);
    }
}
