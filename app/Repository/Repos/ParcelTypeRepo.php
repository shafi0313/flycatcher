<?php

namespace App\Repository\Repos;

use App\Models\ParcelType;
use App\Repository\Interfaces\ParcelTypeInterface;

class ParcelTypeRepo implements ParcelTypeInterface
{
    public function allLatestParcelType(){
        return ParcelType::latest();
    }
    public function allParcelTypeList(){
        return ParcelType::where(['status'=>'active'])->orderBy('name', 'asc')->get();
    }
    public function getAnInstance($parcelTypeId){
        return ParcelType::findOrFail($parcelTypeId);
    }
    public function createParcelType($data){
        return ParcelType::create($data);
    }
    public function updateParcelType($data, $parcelTypeId){
        $area = $this->getAnInstance($parcelTypeId);
        return $area->update($data);
    }
    public function deleteParcelType($parcelTypeId){
        $area = $this->getAnInstance($parcelTypeId);
        return $area->delete();
    }
}
