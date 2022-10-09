<?php

namespace App\Repository\Interfaces;

interface RiderCollectionInterface
{
    public function allLatestCollection();
    public function createCollection(array $requestData);
}
