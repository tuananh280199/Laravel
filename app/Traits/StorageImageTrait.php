<?php

namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait StorageImageTrait {
    public function storageTraitUploadFile($request, $fieldName, $folderName) {
        if($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash);
            $data = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $data; 
        }
        return null;
    }

    public function storageTraitUploadFileMultiple($file, $folderName) {
        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash);
        $data = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        return $data; 
    }
}