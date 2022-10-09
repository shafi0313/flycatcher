<?php

namespace App\Repository\Repos;

use App\Models\Area;
use App\Repository\Interfaces\AreaInterface;

class AreaRepo implements AreaInterface
{
    public function allLeastestArea(){
        return Area::with('district','upazila', 'city', 'rider')->latest('id');
    }
    public function allAreaList(){
        return Area::where('status', 'active')->get();
    }

    public function getAnInstance($areaId){
        return Area::findOrFail($areaId);
    }
    public function createArea($data){
        return Area::create($data);
    }
    public function updateArea($areaData, $areaId){
        $area = $this->getAnInstance($areaId);
        return $area->update($areaData);
    }
    public function deleteArea($areaId){
        $area = $this->getAnInstance($areaId);
        return $area->delete();
    }
}
