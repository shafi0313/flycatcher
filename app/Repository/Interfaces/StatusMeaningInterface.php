<?php

namespace App\Repository\Interfaces;

interface StatusMeaningInterface
{
    public function allStatusMeaning($column);
    public function getAnInstance($column, $id);
    public function createStatusMeaning(array $data);
    public function updateStatusMeaning(array $data, $statusMeaningData);
    public function deleteStatusMeaning($statusMeaningData);
}
