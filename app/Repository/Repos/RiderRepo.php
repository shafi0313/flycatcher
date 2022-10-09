<?php

namespace App\Repository\Repos;

use App\Models\Admin\Rider;
use App\Repository\Interfaces\RiderInterface;

class RiderRepo implements RiderInterface
{
    public function getLatestRider(){
        return Rider::with('assign_areas', 'assign_areas.sub_area', 'hub')->latest('id')->get();
    }
    public function allRiderList(){
        return Rider::with('area')->where(['status'=>'active'])->get();
    }
    public function riderList($relationModel, $columnName, $condition){
        return Rider::with($relationModel)->select($columnName)->where($condition)->get();
    }
    public function getAnInstance($riderId){
        return Rider::with('area')->findOrFail($riderId);
    }

    public function riderDetailsById($relationModel, $riderId){
        return Rider::with($relationModel)->findOrFail($riderId);
    }

    public function createRider(array $data){
        return Rider::create($data);
    }
    public function updateRider($requestData, $riderData){
        return $riderData->update($requestData);
    }
    public function deleteRider($riderId){
        $rider = $this->getAnInstance($riderId);
        return $rider->delete();
    }

}
