<?php

namespace App\services;

use App\Repository\Interfaces\FileInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UploadFileService
{
    protected $fileRepo;
    public function __construct(FileInterface $file)
    {
        $this->fileRepo = $file;
    }
    public function addFile($storageFolder, $fileID, $fileModel){
        try {
            $fileName = time() . Str::random(8) . '.' . request()->file->extension();
            request()->file->move(storage_path('app/public/' . $storageFolder), $fileName);

            return $this->fileRepo->createFile([
                'file_name' => $fileName,
                'fileable_id' => $fileID,
                'fileable_type' => $fileModel,
            ]);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function updateFile($fileData, $storageFolder)
    {
        $filePath = storage_path('app/public/' . $storageFolder . '/' . $fileData->file_name);
        if (file_exists($filePath)) {
            unlink($filePath);
            try {
                $fileName = time() . Str::random(8) . '.' . request()->file->extension();
                request()->file->move(storage_path('app/public/' . $storageFolder), $fileName);

                $data['file_name'] = $fileName;
                $this->fileRepo->updateFile($data, $fileData);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
            }
        }
    }
}
