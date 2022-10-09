<?php

namespace App\Repository\Repos;

use App\Models\CityType;
use App\Repository\Interfaces\CityTypeInterface;

class CityTypeRepo implements CityTypeInterface
{
    public function getAllCityTypes(){
        return CityType::where('status', 'active')->get();
    }
}
