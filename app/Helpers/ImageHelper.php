<?php
namespace App\Helpers;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageHelper{

   public static function uploadAndOptimizeImage($request = null,$title = null,$fieldName = null,$storagePath,$deletingImage = null)
    {

        if($request->hasFile($fieldName)){

            if(file_exists(public_path($storagePath . '/' . $deletingImage))){
                @unlink(public_path($storagePath . '/' . $deletingImage));
            };

            $file = $request->file($fieldName);
            $filename = strtolower(str_replace([' ','.','_'],'-',$title)) . '-' . now()->format('his') . '.' . $file->extension();
            $file->move(public_path($storagePath), $filename);

    }else {

        $filename = $deletingImage;
    }

    return [
        'path' => "{$storagePath}/{$filename}",
        'image' => $filename,
    ];

}

    public static function DeleteImage($storagePath,$filename)
    {
        if(file_exists(public_path("$storagePath/$filename"))){
            unlink(public_path("$storagePath/$filename"));
        }
    }

}

