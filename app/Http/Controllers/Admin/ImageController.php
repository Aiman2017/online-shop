<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\traits\UploadFiles;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ZipArchive;

class ImageController extends Controller
{
    use UploadFiles;

    public function destroy(int $id): RedirectResponse
    {
        $photo = Photo::query()->findOrFail($id);

        $this->deleteFiles($photo->path);

        $photo->delete();

        return redirect()->back()->with('success', "Successfully deleted image");
    }

    public function destroyAll($modelType, int $ids): RedirectResponse
    {
        $modelClass = "App\Models\\".ucfirst($modelType);

        if (!class_exists($modelClass)) {
            throw new Exception("$modelClass does not exist");
        }

        $photos = $modelClass::query()->with('photos')->findOrFail($ids);

        foreach ($photos->photos as $photo) {
            $this->deleteFiles($photo->path);
            $photo->delete();
        }

        return redirect()->back()->with("success", "Successfully deleted {$modelType}");
    }

    public function downloadAll($modelType, int $ids)
    {
        $modelClass = "App\Models\\".ucfirst($modelType);

        if (!class_exists($modelClass)) {
            throw new Exception("$modelClass does not exist");
        }
        $getModelID = $modelClass::query()->with('photos')->findOrFail($ids);
        $photos = $getModelID->photos;

        $zip = new ZipArchive;
        $zipFileName = $modelType.'images_'.Str::random(2).'.zip';
        $zipPath = storage_path('app/public/'.$zipFileName);


        if ($zip->open($zipPath, ZipArchive::CREATE) === true) {
            foreach ($photos as $photo) {
                $filePath = storage_path('app/public/'.$photo->path);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($filePath));
                }
            }
        }

        $zip->close();

        // Отправка архива на скачивание
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }


    public function imageSortable(Request $request): JsonResponse
    {
        $sortableImages = $request->photo_ids;
        if ($sortableImages != null) {
            DB::beginTransaction();
            try {
                foreach ($sortableImages as $position => $sortableImage) {
                    $photo = Photo::query()->where('id', $sortableImage);
                    $photo->update(['position' => $position + 1]);
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }
        return response()->json('success', 202);
    }
}
