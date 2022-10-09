<?php

namespace App\Repository\Interfaces;

interface AreaInterface
{
    public function allLeastestArea();
    public function allAreaList();
    public function getAnInstance($areaId);
    public function createArea(array $data);
    public function updateArea(array $data, $areaId);
    public function deleteArea($areaId);
}
