<?php

namespace App\Repository\Interfaces;

interface ParcelTypeInterface
{
    public function allLatestParcelType();
    public function allParcelTypeList();
    public function getAnInstance($parcelTypeId);
    public function createParcelType(array $data);
    public function updateParcelType(array $data, $parcelTypeId);
    public function deleteParcelType($parcelTypeId);
}
