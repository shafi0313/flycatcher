<?php

namespace App\Repository\Interfaces;

interface AssignAreaInterface
{
    public function createAssignArea(array $areaData);
    public function getMultipleInstance($condition);
    public function getAssignArea($condition);
    public function updateAssignArea($condition, $requestData);
    public function deleteAssignArea($condition);
}
