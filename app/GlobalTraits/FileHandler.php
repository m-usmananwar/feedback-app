<?php

namespace App\GlobalTraits;

use Illuminate\Http\UploadedFile;

trait FileHandler
{
    public function uploadSingleFile(UploadedFile $uploadedFile, $folder, $fileName = null)
    {
        $disk = config('filesystems.default');

        if(is_null($fileName)) {
            $fileName = time() . rand(1111, 9999) . '.' . $uploadedFile->getClientOriginalExtension();
        }

        $filePath = $uploadedFile->storeAs($folder, $fileName, $disk);
        return $filePath;
    }
}
