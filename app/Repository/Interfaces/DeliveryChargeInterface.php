<?php

namespace App\Repository\Interfaces;

interface DeliveryChargeInterface
{
    public function allLatestGlobalDeliveryCharge();
    public function allDeliveryChargeList();
    public function getAnInstance($deliveryChargeID);
    public function createDeliveryCharge(array $data);
    public function updateDeliveryCharge(array $requestData, $deliveryCharge);
    public function deleteDeliveryCharge($deliveryCharge);
}
