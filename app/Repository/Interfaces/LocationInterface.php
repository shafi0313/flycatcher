<?php

namespace App\Repository\Interfaces;

interface LocationInterface
{
    public function getDivisions();
    public function getDistricts();
    public function getupazillas();
    public function ajaxUpazilaList($id);
}
