<?php
namespace App\Helpers;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageHelper{

   public static function uploadAndOptimizeImage($request,$title,$fieldName,$storagePath,$deletingImage = null)
    {

        if($request->hasFile($fieldName)){

            if(file_exists(public_path($storagePath . '/' . $deletingImage))){
                @unlink(public_path($storagePath . '/' . $deletingImage));
            }elseif (file_exists(public_path($deletingImage))) {
                @unlink(public_path($deletingImage));
            };

            $file = $request->file($fieldName);
            $filename = strtolower(str_replace([' ','.','_'],'-',$title)) . '-' . now()->format('his') . '.' . $file->extension();
            $file->move(public_path($storagePath), $filename);
            $fullImagePath = "{$storagePath}/{$filename}";

    }else {

        $filename = $deletingImage;
        $fullImagePath = "upload/no_image.jpg";
    }

    return [
        'path' => $fullImagePath,
        'image' => $filename,
    ];

}

    public static function DeleteImage($storagePath = null,$filename = null)
    {
        if(file_exists(public_path("$storagePath/$filename"))){
            unlink(public_path("$storagePath/$filename"));
        }elseif (file_exists(public_path($filename))) {
            unlink(public_path($filename));
        }
    }

}

