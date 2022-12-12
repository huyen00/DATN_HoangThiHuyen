<?php

namespace App\Traits;

use App\Jobs\copyFileQueue;
use App\Jobs\deleteBeforeUpdate;
use Illuminate\Support\Arr;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait FileTrait
{
    public function unzip($file, $extracto)
    {
        $zip = new ZipArchive;
        $zip->open($file->getRealPath());
        $zip->extractTo($extracto);
        $zip->close();
        $string =  explode(".zip", $file->getClientOriginalName())[0] . '-' . time();
        dispatch(new copyFileQueue($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string));
        dispatch(new deleteBeforeUpdate($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]));
        $path =  $extracto . '/' . $string;
        return $path;
    }

    public function update_zip($file, $extracto, $attribute)
    {
        $zip = new ZipArchive;
        $zip->open($file->getRealPath());
        if (file_exists($attribute)) {
            File::deleteDirectory($attribute);
        }
        $zip->extractTo($extracto);
        $string = explode(".zip", $file->getClientOriginalName())[0] . '-' . time();
        dispatch(new copyFileQueue($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string));
        dispatch(new deleteBeforeUpdate($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]));
        $path =  $extracto . '/' . $string;
        return $path;
    }
     public function update_zip_old($file, $extracto, $attribute){
        $zip = new ZipArchive;
        $zip->open($file->getRealPath());
        if (file_exists($attribute)) {
            File::deleteDirectory($attribute);
        }
        $zip->extractTo($extracto);
        // $string = explode(".zip", $file->getClientOriginalName())[0] . '-' . time();
        $string = $attribute;
        dispatch(new copyFileQueue($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $string));
        dispatch(new deleteBeforeUpdate($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]));
        $path =   $string;
        return $path;
     }

    public function getContent($disk, $path = null)
    {
        $content = Storage::disk($disk)->listContents($path);

        // get a list of directories
        $directories = $this->filterDir($disk, $content);

        // get a list of files
        $files = $this->filterFile($disk, $content);

        return compact('directories', 'files');
    }

    public function updateThumb($file, $attribute)
    {
        $content = file_get_contents($file);
        file_put_contents($attribute, $content);
    }

    public function saveImage($file, $dedestinationpaths)
    {
        $file->store($dedestinationpaths);

        // ensure every image has a different name
        $file_name = $file->hashName();
        return $file_name;
    }
}
