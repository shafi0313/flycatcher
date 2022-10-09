<?php

namespace App\Repository\Interfaces;

interface MerchantPickupMethodInterface
{
    public function createMerchantPickupMethod(array $requestData);

    public function getAnInstance($pickupId);

    public function getInstanceMerchantBasis($merchantID);

    public function updatePickupMethod($requestData, $pickupData);
}
