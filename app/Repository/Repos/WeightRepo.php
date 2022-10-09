<?php

namespace App\Repository\Repos;

use App\Models\WeightRange;
use App\Repository\Interfaces\WeightRangeInterface;

class WeightRepo implements WeightRangeInterface
{
    public function allLeastestWeight(){
        return WeightRange::latest('id');
    }
    public function allWeightRangeList(){
        return WeightRange::where('status', 'active')->get();
    }
    public function getAnInstance($weightId){
        return WeightRange::findOrFail($weightId);
    }
    public function createWeight($data){
        return WeightRange::create($data);
    }
    public function updateWeight($data, $weightId){
        $weight = $this->getAnInstance($weightId);
        return $weight->update($data);
    }
    public function deleteWeight($weightId){
        $area = $this->getAnInstance($weightId);
        return $area->delete();
    }
}
