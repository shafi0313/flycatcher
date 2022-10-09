<?php

namespace App\Repository\Repos;

use App\Models\Reason;
use App\Models\ReasonType;
use App\Repository\Interfaces\ReasonInterface;

class ReasonRepo implements ReasonInterface
{
    public function getAllReasonType(){
        return ReasonType::latest('id');
    }
    public function getAllHoldReasonType(){
        return ReasonType::where('status', 'active')->where(function($query) {
            return $query->where('reason_type', 'hold')->orWhere('reason_type','both');
        })->get();
    }
    public function getAllCancelReasonType(){
        return ReasonType::where('status', 'active')->where(function($query) {
            return $query->where('reason_type', 'cancel')->orWhere('reason_type','both');
        })->get();
    }

    public function createReasonType($requestData){
        return ReasonType::create($requestData);
    }

    public function createReason(array $data){
        return Reason::create($data);
    }

    public function deleteReasonType($reasonTypeData){
        return $reasonTypeData->delete();
    }

    public function getAnReasonTypeInstance($reasonTypeId)
    {
        return ReasonType::findOrFail($reasonTypeId);
    }
}
