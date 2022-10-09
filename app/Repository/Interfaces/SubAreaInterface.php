<?php

namespace App\Repository\Interfaces;

interface SubAreaInterface
{
    public function allLatestSubArea();
    public function getAllSubArea();
    public function getSubAreaWithCondition($condition);
    public function getAnInstance($areaId);
    public function createSubArea(array $data);
    public function updateSubArea(array $requestData, $subAreaInfo);
    public function deleteSubArea($subArea);
    public function getInstancesByWhereIn($columnName, $requestData);
}
