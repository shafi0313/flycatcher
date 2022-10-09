<?php

namespace App\Repository\Repos;

use App\Models\ParcelNote;
use App\Repository\Interfaces\ParcelNoteInterface;

class ParcelNoteRepo implements ParcelNoteInterface
{

    public function createNote($requestData)
    {
        return ParcelNote::create($requestData);
    }
}
