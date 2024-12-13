<?php

namespace App\traits;

use Illuminate\Support\Facades\Storage;

trait UploadFiles
{
    public function uploadFiles($request, $inputName = 'photos', $name = ''): array
    {
        $filesPath = [];
        if ($request->hasFile($inputName)) {
            $files = $request->file($inputName);
            if (is_array($files)) {
                foreach ($files as $file) {
                    if ($file->isValid()) {
                        $fileName = $file->getClientOriginalName();
                        $filePath = $file->storeAs('uploads/'.str_replace(' ', '_', $name), $fileName, 'public');
                        $filesPath[] = $filePath;
                    }
                }
            } else {
                $fileName = $files->getClientOriginalName();

                $filePath = $files->storeAs('uploads/'.str_replace(' ', '_', $name), $fileName, 'public');
                $filesPath[] = $filePath;
            }
        }

        return $filesPath;
    }


    public function uploadAndResizeImage($file, $path, $width = 800, $height = 800)
    {
        $imageName = uniqid().'.'.$file->getClientOriginalExtension();
        $fullPath = public_path("uploads/$path/$imageName");

        // Изменяем размер изображения и сохраняем его
        Image::make($file)
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save($fullPath);

        return "uploads/$path/$imageName";
    }

    public function deleteFiles($filePath): void
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $directoryPath = dirname($filePath);
        if (Storage::disk('public')->files($directoryPath) === []) {
            Storage::disk('public')->deleteDirectory($directoryPath);
        }
    }
}


