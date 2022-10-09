<?php

namespace App\services;

use App\Models\SubArea;

class RiderService
{
    public function getNonAssignSubAreaList($allSubArea, $allAssignArea){
        $subArea=[];
        foreach ($allSubArea as $row){
            array_push($subArea,$row->id);
        }

        $assignArea=[];
        foreach ($allAssignArea as $row){
            array_push($assignArea,$row->sub_area_id);
        }
        $collection = collect($subArea);
        $differences = $collection->diff($assignArea);

        $restArea = [];

        foreach ($differences as $difference){
            array_push($restArea, $difference);
        }
        return $restArea;
        //$data['finalAreas'] = SubArea::whereIn('id', $restArea)->get();
    }
}
