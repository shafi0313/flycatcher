<?php

namespace App\Repository\Repos;

use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use App\Repository\Interfaces\LocationInterface;

class LocationRepo implements LocationInterface
{
    public function getDivisions(){
        return Division::orderBy('name', 'asc')->get();
    }
    public function getDistricts(){
        return District::orderBy('name', 'asc')->get();
    }
    public function getupazillas(){
        return Upazila::orderBy('name', 'asc')->get();
    }

    public function ajaxUpazilaList($id){
        return Upazila::where('district_id',$id)->get();
    }
}
