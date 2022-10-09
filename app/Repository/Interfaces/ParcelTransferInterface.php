<?php

namespace App\Repository\Interfaces;

interface ParcelTransferInterface
{
    public function allLatestParcelTransfer($relation, $columnName, $condition);
    public function getAnInstance($relation, $column, $parcelId);
    public function createParcelTransfer($requestData);
    public function updateTransferRequest($requestData, $transferData);
}
