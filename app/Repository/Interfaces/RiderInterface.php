<?php

namespace App\Repository\Interfaces;

interface RiderInterface
{
    public function getLatestRider();
    public function allRiderList();
    public function riderList($relationModel, $columnName, $condition);
    public function getAnInstance($riderId);
    public function riderDetailsById($relationModel, $riderId);
    public function createRider(array $data);
    public function updateRider(array $requestData, $riderData);
    public function deleteRider($riderId);
}
