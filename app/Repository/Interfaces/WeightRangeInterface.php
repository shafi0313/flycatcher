<?php

namespace App\Repository\Interfaces;

interface WeightRangeInterface
{
    public function allLeastestWeight();
    public function allWeightRangeList();
    public function getAnInstance($weightId);
    public function createWeight(array $data);
    public function updateWeight(array $data, $weightId);
    public function deleteWeight($weightId);
}
