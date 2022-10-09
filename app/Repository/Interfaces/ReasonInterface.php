<?php

namespace App\Repository\Interfaces;

interface ReasonInterface
{
    public function getAllReasonType();

    public function getAllHoldReasonType();

    public function getAllCancelReasonType();

    public function getAnReasonTypeInstance($reasonTypeId);

    public function createReasonType(array $requestData);

    public function createReason(array $data);

    public function deleteReasonType($reasonTypeData);
}
