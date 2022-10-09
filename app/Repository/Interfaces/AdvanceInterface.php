<?php

namespace App\Repository\Interfaces;

interface AdvanceInterface
{
    public function allAdvanceList();
    public function getAnInstance($advanceId);
    public function createAdvance(array $data);
    public function updateAdvance(array $requestData, $advanceData);
    public function deleteAdvance($advanceId);
}
