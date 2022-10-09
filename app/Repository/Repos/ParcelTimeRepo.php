<?php

namespace App\Repository\Repos;

use App\Models\ParcelTime;
use App\Repository\Interfaces\ParcelTimeInterface;

class ParcelTimeRepo implements ParcelTimeInterface
{

    public function createParcelTime($requestData)
    {
        return ParcelTime::create($requestData);
    }
}
