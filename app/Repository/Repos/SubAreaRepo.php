<?php

namespace App\Repository\Repos;

use App\Models\SubArea;
use App\Repository\Interfaces\SubAreaInterface;

class SubAreaRepo implements SubAreaInterface
{

    public function allLatestSubArea()
    {
        return SubArea::with('area', 'assign_sub_area', 'assign_sub_area.assignable')->latest()->get();
    }

    public function getAllSubArea()
    {
        return SubArea::with('area')->where(['status'=>'active'])->latest()->get();
    }

    public function getSubAreaWithCondition($condition)
    {
        return SubArea::with('area', 'assign_sub_area', 'assign_sub_area.assignable')->where($condition)->get();
    }

    public function getAnInstance($areaId)
    {
        return SubArea::with('area', 'assign_sub_area', 'assign_sub_area.assignable')->findOrFail($areaId);
    }

    public function createSubArea(array $requestData)
    {
       return SubArea::create($requestData);
    }

    public function updateSubArea(array $requestData, $subAreaInfo)
    {
        return $subAreaInfo->update($requestData);
    }

    public function deleteSubArea($subArea)
    {
        return $subArea->delete();
    }

    public function getInstancesByWhereIn($columnName, $requestData){
        return SubArea::whereIn($columnName, $requestData)->get();
    }

}
