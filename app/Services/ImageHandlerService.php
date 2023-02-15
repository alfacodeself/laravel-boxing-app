<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageHandlerService
{
    public static function fileStoreHandler($file, $path = 'public/img', $name = 'img-')
    {
        $ext = $file->extension();
        $fileName = $name . time() . '.' . $ext;
        $store = $file->storeAs($path, $fileName);
        $path = Storage::url($store);
        return $path;
    }
    public static function fileDeleteHandler($file)
    {
        @unlink(public_path($file));
    }
    public static function fileShowHandler($file)
    {
        return url($file);
    }
}
