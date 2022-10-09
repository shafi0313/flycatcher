<?php

namespace App\Repository\Interfaces;

interface PickupRequestInterface
{
    public function latestPickupRequestWithCondition($condition);

    public function getAnInstance($pickupId);

    public function updatePickupRequest(array $requestData, $pickupRequestData);

    public function deletePickupRequest($pickupData);

    public function totalPickupParcel($merchantId);

    public function pickupRequestCountInDifferentStatus($whereCondition);
}
