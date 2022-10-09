<?php

namespace App\Repository\Repos;

use App\Models\AssignArea;
use App\Repository\Interfaces\AssignAreaInterface;

class AssignAreaRepo implements AssignAreaInterface
{
    public function createAssignArea($areaData)
    {
        return AssignArea::create($areaData);
    }
    public function getMultipleInstance($condition){
       return AssignArea::where($condition)->get();
    }
    public function getAssignArea($condition){
       return AssignArea::with('assignable')->where($condition)->get();
    }
    public function updateAssignArea($condition, $requestData)
    {
       return AssignArea::where($condition)->update($requestData);
    }

    public function deleteAssignArea($condition){
        return AssignArea::where($condition)->delete();
    }
}
