<?php

namespace App\Repository\Interfaces;

interface FileInterface
{
    public function createFile($requestData);

    public function getSingleFile($condition);

    public function updateFile($requestData, $fileData);
}
