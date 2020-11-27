<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

if (!function_exists('encodeHash')) {
    /**
     * Return encoded Hash
     *
     * @param  String  string
     * @return  String
     */
    function encodeHash($string)
    {
        return urlencode(base64_encode($string));
    }
}

if (!function_exists('decodeHash')) {
    /**
     * Return Hash decoded
     *
     * @param  String  string
     * @return  String
     */
    function decodeHash($string)
    {
        return explode(';', base64_decode(urldecode($string)));
    }
}

if (!function_exists('saveImageResized')) {
    /**
     * Store a newly created resource in storage.
     *
     * @param  Object  $imageFile
     * @param  String  $savePath
     * @param  Integer  $width
     * @param  Boolean  $needSignature
     * @param  String  $fileNameOrig
     * @return  Array
     */
    function saveImageResized($imageFile, $savePath, $width, $needSignature = true, $fileNameOrig = '')
    {
        $extension = $imageFile->getClientOriginalExtension();
        $tmpFileName = Str::slug(($fileNameOrig === '') ? str_replace(".$extension", '', $imageFile->getClientOriginalName()) : $fileNameOrig);

        if ($needSignature) {
            $signature = time();
            $tmpFileName = "{$tmpFileName}_{$signature}";
        }

        $fileName = strtolower("{$tmpFileName}.{$extension}");
        $filePath = "{$savePath}/{$fileName}";
        $img = Image::make($imageFile)
            ->widen($width)
            ->save(storage_path("app/public/{$filePath}"));

        return [
            'fileName' => $fileName,
            'filePath' => $filePath,
        ];
    }
}

if (!function_exists('delFile')) {
    /**
     * Get the image with slug format
     *
     * @param  String  $path
     * @return void
     */
    function delFile($path)
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}

if (!function_exists('startWith')) {
    /**
     * Return boolean if the string begins with
     *
     * @param  String  $path
     * @return void
     */
    function startWith($string, $compare)
    {
        return (strpos($string, $compare) === 0);
    }
}

if (!function_exists('addHashTag')) {
    /**
     * Return string with hashtag symbol
     *
     * @param  String  $path
     * @return void
     */
    function addHashTag(string $string)
    {
        return Str::start($string, '#');
    }
}
