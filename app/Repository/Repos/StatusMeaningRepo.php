<?php

namespace App\Repository\Repos;

use App\Models\StatusMeaning;
use App\Repository\Interfaces\StatusMeaningInterface;

class StatusMeaningRepo implements StatusMeaningInterface
{

    public function allStatusMeaning($column)
    {
        return StatusMeaning::select($column)->latest();
    }

    public function getAnInstance($column, $id)
    {
        return StatusMeaning::select($column)->findOrFail($id);
    }

    public function createStatusMeaning(array $data)
    {
        return StatusMeaning::create($data);
    }

    public function updateStatusMeaning(array $data, $statusMeaningData)
    {
        return $statusMeaningData->update($data);
    }

    public function deleteStatusMeaning($statusMeaningData)
    {
        return $statusMeaningData->delete();
    }
}
