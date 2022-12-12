<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use ZipArchive;
use Illuminate\Support\Facades\File;
use RarArchiver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use DirectoryIterator;
use Illuminate\Support\Str;
use App\Models\Ground;
use App\Models\Project\text_pano;
use Illuminate\Support\Collection;
use Closure;
use App\Jobs\deleteBeforeUpdate;
use App\Jobs\copyFileQueue;

trait FileUploadTrait
{


    /**
     * File upload trait used in controllers to upload files
     */
    public function saveFiles(Request $request)
    {
        if (!file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'), 0777);
            mkdir(public_path('uploads/thumb'), 0777);
        }

        $finalRequest = $request;

        foreach ($request->all() as $key => $value) {
            if ($request->hasFile($key)) {
                if ($request->has($key . '_max_width') && $request->has($key . '_max_height')) {
                    // Check file width
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $file     = $request->file($key);
                    $image    = Image::make($file);
                    if (!file_exists(public_path('uploads/thumb'))) {
                        mkdir(public_path('uploads/thumb'), 0777, true);
                    }
                    Image::make($file)->resize(50, 50)->save(public_path('uploads/thumb') . '/' . $filename);
                    $width  = $image->width();
                    $height = $image->height();
                    if ($width > $request->{$key . '_max_width'} && $height > $request->{$key . '_max_height'}) {
                        $image->resize($request->{$key . '_max_width'}, $request->{$key . '_max_height'});
                    } elseif ($width > $request->{$key . '_max_width'}) {
                        $image->resize($request->{$key . '_max_width'}, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } elseif ($height > $request->{$key . '_max_width'}) {
                        $image->resize(null, $request->{$key . '_max_height'}, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    $image->save(public_path('uploads') . '/' . $filename);
                    $finalRequest = new Request(array_merge($finalRequest->all(), [$key => $filename]));
                } else {
                    $filename = time() . '-' . $request->file($key)->getClientOriginalName();
                    $request->file($key)->move(public_path('uploads'), $filename);
                    $finalRequest = new Request(array_merge($finalRequest->all(), [$key => $filename]));
                }
            }
        }

        return $finalRequest;
    }
    public function uploadFile($name, $image, $url_folder)
    {
        $current = Carbon::now()->format('YmdHs');
        $folder = $url_folder;
        $destinationpath = public_path($folder);

        $name = Str::slug($name) . '_' . time();
        $namefile =   $name . '.' . $image->getClientOriginalExtension();
        $image->move($destinationpath, $namefile);
        $image_url =  $folder . $namefile;
        return $image_url;
    }


    //Upload and Update fileZIp
    public function UploadZipFile($file, $extracto)
    {

        $zip = new ZipArchive;
        $user_id = Auth::user()->id;
        if ($file->getClientOriginalExtension() == "zip") {
            $zip->open($file->getRealPath());
            $zip->extractTo($extracto);
            $string = explode(".zip", $file->getClientOriginalName())[0] . "-" . time() . $user_id;
            dispatch(new copyFileQueue($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string));
            dispatch(new deleteBeforeUpdate($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]));
            // File::copyDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string);

            // File::deleteDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]);
            $path =  $extracto . '/' . $string . '/index.html';
            return $path;
        } else {
            $path = "";
            return $path;
        }
    }

    public function UpdateFile($file, $extracto, $attribute)
    {

        $zip = new ZipArchive;
        $user_id = Auth::user()->id;
        if ($file->getClientOriginalExtension() == "zip") {
            $oldzip = explode("/index.html", $attribute)[0];
            // File::deleteDirectory($oldzip);
            dispatch(new deleteBeforeUpdate($oldzip));
            $zip->open($file->getRealPath());
            $zip->extractTo($extracto);
            $string = explode(".zip", $file->getClientOriginalName())[0] . "-" . time() . $user_id;
            dispatch(new copyFileQueue($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string));
            dispatch(new deleteBeforeUpdate($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]));
            // File::copyDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string);
            // File::deleteDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]);
            $path =  $extracto . '/' . $string . '/index.html';
            return $path;
        } else {
            $path = "";
            return $path;
        }
    }


    public function UploadFilePresent($file, $extracto)
    {

        $zip = new ZipArchive;
        $user_id = Auth::user()->id;
        if ($file->getClientOriginalExtension() == "zip") {
            $zip->open($file->getRealPath());
            $zip->extractTo($extracto);
            $string = explode(".zip", $file->getClientOriginalName())[0] . "-" . time() . $user_id;
            dispatch(new copyFileQueue($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string));
            dispatch(new deleteBeforeUpdate($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]));
            // File::copyDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string);
            // File::deleteDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]);
            $path =  $extracto . '/' . $string;
            return $path;
        } else {
            $path = "";
            return $path;
        }
    }


    public function UpdateFilePresent($file, $extracto, $attribute)
    {

        $zip = new ZipArchive;
        $user_id = Auth::user()->id;
        if ($file->getClientOriginalExtension() == "zip") {

            $oldzip = $attribute;
            //xoa dc file nay
            dispatch(new deleteBeforeUpdate($oldzip));
            // File::deleteDirectory($oldzip);
            $zip->open($file->getRealPath());
            $zip->extractTo($extracto);
            $string = explode(".zip", $file->getClientOriginalName())[0] . "-" . time() . $user_id;
            // dd($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]);
            dispatch(new copyFileQueue($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string));
            dispatch(new deleteBeforeUpdate($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]));
            // File::copyDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string);
            // File::deleteDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]);

            $path =  $extracto . '/' . $string;
        }
        return $path;
    }



    //upload and update model_AR
    public function UploadFileGLB_Usdz($file, $destinationpath)
    {
        $user_id = Auth::user()->id;
        if ($file->getClientOriginalExtension() == "glb" || $file->getClientOriginalExtension() == "usdz") {
            $file->move($destinationpath, time() . $user_id . "-" . $file->getClientOriginalName());
            $path = $destinationpath . '/' . time() . $user_id . "-" . $file->getClientOriginalName();
            return $path;
        } else {
            $path = "";
            return $path;
        }
    }


    public function UpdateFileGlb_Usdz($file, $destinationpath, $attribute)
    {
        $user_id = Auth::user()->id;
        if ($file->getClientOriginalExtension() == "glb" || $file->getClientOriginalExtension() == "usdz") {

            if ($attribute == '') {
                $file->move($destinationpath, time() . $user_id . "-" . $file->getClientOriginalName());
                $path = $destinationpath . '/' . time() . $user_id . "-" . $file->getClientOriginalName();
                return $path;
            } else {
                unlink($attribute);
                $file->move($destinationpath, time() . $user_id . "-" . $file->getClientOriginalName());
                $path = $destinationpath . '/' . time() . $user_id . "-" . $file->getClientOriginalName();
                return $path;
            }
        } else {
            $path = "";
            return $path;
        }
    }

    public function UploadAudio360($file, $destinationpath)
    {

        $destinationpath_full = public_path() . "/" . $destinationpath;
        $user_id = Auth::user()->id;
        $file->move($destinationpath_full, time() . $user_id . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension());
        $path = $destinationpath . '/' . time() . $user_id . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        return $path;
    }

    //update image ground
    public function image($file, $destinationpath)
    {
        $user_id = Auth::user()->id;
        $name = time() . $user_id . "_" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        $file->move($destinationpath, $name);
        $path = $destinationpath . $name;
        return $path;
    }
    public function UpdateAudio360($file, $destinationpath, $attribute)
    {
        $destinationpath_full = public_path() . "/" . $destinationpath;
        $user_id = Auth::user()->id;
        if ($attribute == null || file_exists($attribute) == false) {
            $file->move($destinationpath_full, time() . $user_id . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension());
            $path = $destinationpath . '/' . time() . $user_id . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            return $path;
        } else {
            unlink($attribute);
            $file->move($destinationpath_full, time() . $user_id . "-" .  Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension());
            $path = $destinationpath . '/' . time() . $user_id . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            return $path;
        }
    }

    public function UploadModel3D($file, $destinationpath)
    {
        $destinationpath_full = public_path() . "/" . $destinationpath;
        $user_id = Auth::user()->id;
        // if ($file->getClientOriginalExtension() == "obj" || $file->getClientOriginalExtension() == "mtl" || $file->getClientOriginalExtension() == "fbx") {
        $file->move($destinationpath_full, time() . $user_id . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension());
        $path = $destinationpath . '/' . time() . $user_id . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        return $path;
        // } else {
        //     $path = "";
        //     return $path;
        // }
    }
    public function UpdateModel3D($file, $name, $destinationpath, $attribute)
    {
        $destinationpath_full = public_path() . "/" . $destinationpath;
        $user_id = Auth::user()->id;
        // if ($file->getClientOriginalExtension() == "obj" || $file->getClientOriginalExtension() == "mtl" || $file->getClientOriginalExtension() == "fbx") {

        if ($attribute == null || file_exists($attribute) == false) {
            $file->move($destinationpath_full, $name . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension());
            $path = $destinationpath . '/' . $name . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            return $path;
        } else {
            unlink($attribute);
            $file->move($destinationpath_full, $name . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension());
            $path = $destinationpath . '/' . $name . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            return $path;
        }
        // } else {
        //     $path = "";
        //     return $path;
        // }
    }

    public function update_image($file, $name, $middlepath, $attribute)
    {

        $destinationpath = public_path() . "/" . $middlepath;

        $user_id = Auth::user()->id;
        $name = $name . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

        if ($attribute == null || file_exists($attribute) == false) {
            $file->move($destinationpath, $name);
            $path = $middlepath . $name;
        } else {
            if (Str::contains($attribute, 'default')) {

                $file->move($destinationpath, $name);
                $path = $middlepath . $name;
            } else {
                unlink($attribute);
                $file->move($destinationpath, $name);
                $path = $middlepath . $name;
            }
        }

        return $path;
    }

    public function update_icon_tour($file, $name, $middlepath, $attribute){
        $destinationpath = public_path() . "/" . $middlepath;

        $user_id = Auth::user()->id;
        $name = $name . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

        if ($attribute == null || file_exists($attribute) == false) {
            $file->move($destinationpath, $name);
            $path = $middlepath . $name;
        } else {
            if (Str::contains($attribute, 'default')) {

                $file->move($destinationpath, $name);
                $path = $middlepath . $name;
            } else {
            
                $file->move($destinationpath, $name);
                $path = $middlepath . $name;
            }
        }

        return $path;
    }


    public function update_thumb64($file, $name, $middlepath, $attribute)
    {
        $thumbPath = public_path() . "/" . $middlepath;
        $name = $name . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        $thumb = Image::make($file->getRealPath())->resize(64, 64);
        if ($attribute == null || file_exists($attribute) == false) {
            $thumb->save($thumbPath . $name);
            // $file->move($thumbPath, $name);
            $path = $middlepath . $name;
        } else {
            unlink($attribute);
            $thumb->save($thumbPath . $name);
            // $file->move($thumbPath, $name);
            $path = $middlepath . $name;
        }

        return $path;
    }
    public function update_thumb($file, $name, $middlepath, $attribute)
    {
        $thumbPath = public_path() . "/" . $middlepath;
        $name = $name . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();;
        $thumb = Image::make($file->getRealPath())->resize(160, 120);
        if ($attribute == null || file_exists($attribute) == false) {
            $thumb->save($thumbPath . $name);
            // $file->move($thumbPath, $name);
            $path = $middlepath . $name;
        } else {
            unlink($attribute);
            $thumb->save($thumbPath . $name);
            // $file->move($thumbPath, $name);
            $path = $middlepath . $name;
        }

        return $path;
    }

    public function create_thumb($file, $name, $middlepath)
    {
        $thumbPath = public_path() . "/" . $middlepath;
        $name = $name . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();;
        $thumb = Image::make($file->getRealPath())->resize(160, 120);
        $thumb->save($thumbPath . $name);
        $path = $middlepath . $name;

        return $path;
    }

    public function create_thumb64($file, $name, $middlepath)
    {
        $thumbPath = public_path() . "/" . $middlepath;
        $name = $name . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();;
        $thumb = Image::make($file->getRealPath())->resize(64, 64);
        $thumb->save($thumbPath . $name);
        $path = $middlepath . $name;

        return $path;
    }

    public function create_thumbSize($file, $name, $middlepath)
    {
        $thumbPath = public_path() . "/" . $middlepath;
        $name = $name . "-" . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();;
        $thumb = Image::make($file->getRealPath())->resize(120, 80);
        $thumb->save($thumbPath . $name);
        $path = $middlepath . $name;

        return $path;
    }



    public function update_image_360($file, $destinationpath, $attribute)
    {

        $user_id = Auth::user()->id;
        $name = time() . $user_id . "." . $file->getClientOriginalName();

        if ($attribute == null || file_exists($attribute) == false) {
            $file->move($destinationpath, $name);
            $path = $destinationpath . "/" . $name;
        } else {
            unlink($attribute);
            $file->move($destinationpath, $name);
            $path = $destinationpath . "/" . $name;
        }

        return $path;
    }


    //upload folder image Map
    public function uploadfloder_image($file, $extracto)
    {
        $zip = new ZipArchive;
        $user_id = Auth::user()->id;
        if ($file->getClientOriginalExtension() == "zip") {
            $zip->open($file->getRealPath());
            $zip->extractTo($extracto);
            $string = explode(".zip", $file->getClientOriginalName())[0] . "-" . time() . $user_id;
            File::copyDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string);
            File::deleteDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]);
            $path =  $extracto . '/' . $string . '/';
        }
        return $path;
    }

    public function updatefloder_image($file, $extracto, $attribute)
    {

        $zip = new ZipArchive;
        $user_id = Auth::user()->id;
        if ($file->getClientOriginalExtension() == "zip") {
            File::deleteDirectory($attribute); //xoa dc file nay
            $zip->open($file->getRealPath());
            $zip->extractTo($extracto);
            $string = explode(".zip", $file->getClientOriginalName())[0] . "-" . time() . $user_id;
            File::copyDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0], $extracto . '/' . $string);
            File::deleteDirectory($extracto . '/' . explode(".zip", $file->getClientOriginalName())[0]);
            $path =  $extracto . '/' . $string . '/';
        }
        return $path;
    }
    public function DeleteFolder($attribute, $extension)
    {

        if (file_exists($attribute)) {

            $oldzip = explode($extension, $attribute)[0];
            if (!Str::contains($attribute, 'default')) {
                if (is_dir($oldzip)) {
                    File::deleteDirectory($oldzip); //xoa dc file nay
                } else {
                    unlink($attribute);
                }
            }
        }
    }
    public function createFolder($public, $name)
    {

        $path = $public . $name;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }
    public function createFolderChild($public, $nameParent, $name)
    {
        $path = $public . $nameParent . '/' . $name;
        if (!file_exists($path)) {
            mkdir($path, 0777);
        }

        return $path;
    }

    public function getAllFolder($public, $name)
    {

        $dir = new DirectoryIterator($public . $name);


        $array =  [];
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $array[] = $fileinfo->getFilename();
            }
        }
        return $array;
    }

    public function getAllFolderPano($public, $name)
    {

        $dir = new DirectoryIterator($public . $name);

        $array =  [];

        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $array[] = $fileinfo->getFilename();
            }
        }
        return $array;
    }
    public function getAllFolderPath($path)
    {
        $dir = new DirectoryIterator($path);
        return $dir;
        $array =  [];
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $array[] = $fileinfo->getFilename();
            }
        }
        return $array;
    }
    public function uploadMultiple($path, $files)
    {
        foreach ($files as $file) {
            $name = time() . '-' . $file->getClientOriginalName();
            $file->move($path, $name);
            $data[] = $name;
        }
    }
    public function uploadMultipleWithText($path, $files, $amentities_id)
    {
        $i = 0;
        foreach ($files as $file) {
            $name = time() . '-' . $files[$i]->getClientOriginalName();
            $file->move($path, $name);
            $data[] = $name;

            // add text\

            $new_text_pano = new text_pano;
            $new_text_pano->title = $name;
            $new_text_pano->amentities2ds_id = $amentities_id;
            $new_text_pano->pano_id = $i;
            $new_text_pano->name = $name;
            $new_text_pano->save();

            $i++;
        }
    }

    public function getAllImage($public, $name)
    {
        $dir = new DirectoryIterator($public . $name);

        $array =  [];
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDir()) {
                $array[] = $fileinfo->getFilename();
            }
        }
        return $array;
    }
    public function getAllImagePath($path)
    {
        $dir = new DirectoryIterator($path);

        $array =  [];
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDir()) {
                $array[] = $fileinfo->getFilename();
            }
        }
        return $array;
    }
    public function update_image2D($file, $destinationpath, $attribute)
    {

        $user_id = Auth::user()->id;
        $name = time() . $user_id . "." . $file->getClientOriginalName();

        if ($attribute == null || file_exists($attribute) == false) {
            $file->move($destinationpath, $name);
            $path = $name;
        } else {
            unlink($attribute);
            $file->move($destinationpath, $name);
            $path = $name;
        }

        return $path;
    }

    public function resize_image($file, $thumbPath, $thumbName)
    {
        $thumb = Image::make($file->getRealPath());
        $thumb->resize(160, 120);
        $thumbName = time() . "." . $file->getClientOriginalExtension();
        $thumb->save($thumbPath . $thumbName);
        return $thumbPath . $thumbName;
    }

    public function outImgToXYZ($i, $j, $faceIdx, $faceSize)
    {
        $a = 2.0 * (float) $i / $faceSize;
        $b = 2.0 * (float) $j / $faceSize;

        switch ($faceIdx) {
            case 0:
                return [-1.0, 1.0 - $a, 3.0 - $b];
                break; # back
            case 1:
                return [$a - 3.0, -1.0, 3.0 - $b];
                break; # left
            case 2:
                return [1.0, $a - 5.0, 3.0 - $b];
                break; # front
            case 3:
                return [7.0 - $a, 1.0, 3.0 - $b];
                break; # right
            case 4:
                return [$b - 1.0, $a - 5.0, 1.0];
                break; # top
            case 5:
                return [5.0 - $b, $a - 5.0, -1.0];
                break; # bottom
        }

        return [0, 0, 0];
    }
    public function clip($x, $min, $max)
    {
        if ($x > $max) return $max;
        if ($x < $min) return $min;
        return $x;
    }
    public function convertFace($imgIn, $imgInWidth, $imgInHeight, $imgOut, $imgOutWidth, $imgOutHeight)
    {
        $pi = pi();
        $edge = $imgInWidth / 4;
        $face = 0;
        $face2 = 0;
        $rng = null;

        for ($xOut = 0; $xOut <= $imgOutWidth; $xOut++) {
            $face = floor($xOut / $edge); // 0 - back, 1 - left 2 - front, 3 - right
            if ($face === 2) $rng = range(0, $edge * 3, 1);
            else $rng = range($edge, $edge * 2, 1);

            for ($yOut = 0; $yOut <= $imgOutHeight; $yOut++) {
                if ($yOut < $edge) $face2 = 4; // top
                else if ($yOut >= 2 * $edge) $face2 = 5; // bottom
                else $face2 = $face;

                list($x, $y, $z) = $this->outImgToXYZ($xOut, $yOut, $face2, $edge);
                $theta = atan2($y, $x);
                $r = hypot($x, $y);
                $phi = atan2($z, $r);

                # source img coords
                $uf = 2.0 * $edge * ($theta + $pi) / $pi;
                $vf = 2.0 * $edge * ($pi / 2 - $phi) / $pi;

                # Use bilinear interpolation between the four surrounding pixels
                $ui = floor($uf); # coord of pixel to bottom left
                $vi = floor($vf);
                $u2 = $ui + 1; # coords of pixel to top right
                $v2 = $vi + 1;
                $mu = $uf - $ui; # fraction of way across pixel
                $nu = $vf - $vi;

                # Pixel values of four corners
                $a = imagecolorsforindex($imgIn, imagecolorat($imgIn, $ui % $imgInWidth, $this->clip($vi, 0, $imgInHeight - 1)));
                $b = imagecolorsforindex($imgIn, imagecolorat($imgIn, $u2 % $imgInWidth, $this->clip($vi, 0, $imgInHeight - 1)));
                $c = imagecolorsforindex($imgIn, imagecolorat($imgIn, $ui % $imgInWidth, $this->clip($v2, 0, $imgInHeight - 1)));
                $d = imagecolorsforindex($imgIn, imagecolorat($imgIn, $u2 % $imgInWidth, $this->clip($v2, 0, $imgInHeight - 1)));

                # interpolate
                list($r, $g, $b) =
                    [
                        $a["red"] * (1 - $mu) * (1 - $nu) + $b["red"] * ($mu) * (1 - $nu) + $c["red"] * (1 - $mu) * $nu + $d["red"] * $mu * $nu,
                        $a["green"] * (1 - $mu) * (1 - $nu) + $b["green"] * ($mu) * (1 - $nu) + $c["green"] * (1 - $mu) * $nu + $d["green"] * $mu * $nu,
                        $a["blue"] * (1 - $mu) * (1 - $nu) + $b["blue"] * ($mu) * (1 - $nu) + $c["blue"] * (1 - $mu) * $nu + $d["blue"] * $mu * $nu
                    ];
                imagesetpixel($imgOut, $xOut, $yOut, imagecolorallocate($imgOut, (int) round($r), (int) round($g), (int) round($b)));
            }
        }

        return $imgOut;
    }

    public function convert($image)
    {
        $imgInPath =  $image;
        $imgIn = imagecreatefromjpeg($imgInPath);
        $imgInSize = getimagesize($imgInPath);

        $imgInWidth = $imgInSize[0];
        $imgInHeight = $imgInSize[1];
        $imgOutWidthHeight = $imgInWidth / 4;
        $imgOutFullWidth = $imgInWidth;
        $imgOutFullHeight = $imgInWidth * 3 / 4;
        $imgFormat = "jpg";

        $imgOut = imagecreate($imgOutFullWidth, $imgOutFullHeight);
        imagefill($imgOut, 0, 0, imagecolorallocate($imgOut, 0, 0, 0));
        imagejpeg($imgOut, "./temp.jpg", 100);
        $imgOut = imagecreatefromjpeg("./temp.jpg");
        imagefill($imgOut, 0, 0, imagecolorallocate($imgOut, 0, 0, 0));
        $imgOut = $this->convertFace($imgIn, $imgInWidth, $imgInHeight, $imgOut, $imgOutFullWidth, $imgOutFullHeight);

        imagejpeg($imgOut, "./temp.jpg", 100);
        imagedestroy($imgOut);

        $faceNames = [['', '', 'top', ''], ['left', 'front', 'right', 'back'], ['', '', 'bottom', '']];
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $faceName = $faceNames[$i][$j];
                if ($faceName != "") {
                    $im = imagecreatefromjpeg("temp.jpg");
                    $im2 = imagecrop($im, ["x" => ($j * $imgOutWidthHeight), "y" => ($i * $imgOutWidthHeight), "width" => $imgOutWidthHeight, "height" => $imgOutWidthHeight]);
                    if ($im2 !== FALSE) {
                        imagejpeg($im2, "pano_$faceName.jpg", 0);
                        imagedestroy($im2);
                    }
                    imagedestroy($im);
                }
            }
        }

        unlink("./temp.jpg");
    }
    public function createPath($booth)
    {
        $public  =  'VirtualExpo/booths/';
        if (!is_dir($public)) {
            mkdir($public, 0777, true);
        }

        $booth_path_id = $public . $booth->id . '/';
        if (!is_dir($booth_path_id)) {
            mkdir($booth_path_id, 0777, true);
        }
        $logo_path = $booth_path_id . 'images/';
        if (!is_dir($logo_path)) {
            mkdir($logo_path, 0777, true);
        }
        return $logo_path;
    }
    public function createPathLow($booth)
    {
        $public  =  'VirtualExpo/booths/';
        if (!is_dir($public)) {
            mkdir($public, 0777, true);
        }

        $booth_path_id = $public . $booth->id . '/';
        if (!is_dir($booth_path_id)) {
            mkdir($booth_path_id, 0777, true);
        }
        $logo_path = $booth_path_id . 'image_low/';
        if (!is_dir($logo_path)) {
            mkdir($logo_path, 0777, true);
        }
        return $logo_path;
    }


    public function getSize($path)
    {
        if (($path !== null)  && file_exists($path)) {
            return File::size($path);
        } else {
            return 0;
        }
    }

    public function resizeImage($file, $path_low)
    {

        $name = time() . '-' . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();;
        $img = Image::make($file->getRealPath());
        if ($file->getMimeType() == 'image/png') {
            $src = imagecreatefrompng($file->getRealPath());
            $src = imagecreatefrompng($file->getRealPath());
            imagejpeg($src, $path_low . $name, 60);
        } else {
            $img->save($path_low . $name, 60);
        }

        return $path_low . $name;
    }
    public function updateResize($file, $path_low, $attribute)
    {

        $thumbPath = public_path() . "/" . $path_low;
        $name = time() . '-' . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();;
        $img = Image::make($file->getRealPath());
        if ($attribute == null || file_exists($attribute) == false) {
            if ($file->getMimeType() == 'image/png') {
                $src = imagecreatefrompng($file->getRealPath());
                // imagepng($src, $path_low . $name, 9, PNG_FILTER_UP);
                imagejpeg($src, $path_low . $name, 60);
            } else {
                $img->save($thumbPath . $name, 60);
            }

            // $file->move($thumbPath, $name);
            $path = $path_low . $name;
        } else {
            unlink($attribute);
            if ($file->getMimeType() == 'image/png') {
                $src = imagecreatefrompng($file->getRealPath());
                // imagepng($src, $path_low . $name, 9, PNG_FILTER_UP);
                imagejpeg($src, $path_low . $name, 60);
            } else {
                $img->save($thumbPath . $name, 60);
            }
            // $file->move($thumbPath, $name);
            $path = $path_low . $name;
        }
        return $path;
    }

    public function checkState($virtual, $request)
    {

        $user = Auth::user();
        if ($user->hasRole('manager_event')) {
            if ($virtual->state == 'start') {
                echo "";
            } elseif ($virtual->state == 'run') {
                return back()->with('warning', 'Account has Expires');
            } elseif ($virtual->state == 'done') {
                return back()->with('warning', 'Account has Expires');
            }
        }
    }
    public function createDirectory($tour, $hotspot)
    {
        $tour_path = 'Tour/' . $tour->id;
        if (!file_exists($tour_path)) {
            mkdir($tour_path, 0777, true);
        }
        $hotspot_path = $tour_path . '/hotspot/' . $hotspot->id;
        if (!file_exists($hotspot_path)) {
            mkdir($hotspot_path, 0777, true);
        }
        return $hotspot_path;
    }

    public function createDirectoryTour($tour, $name)
    {
        $tour_path = 'Tour/' . $tour->id;
        if (!file_exists(public_path().'/'.$tour_path)) {

            File::makeDirectory(public_path().'/'.$tour_path, $mode = 0777, true, true);
        }
        $name_path = $tour_path . '/' . $name . '/';
        if (!file_exists(public_path().'/'.$name_path)) {
            File::makeDirectory(public_path().'/'.$name_path, $mode = 0777, true, true);
        }
        return $name_path;
    }

    public function copy($file,$path){
        $EXTENSION= pathinfo(public_path($file), PATHINFO_EXTENSION);
        $name = pathinfo(public_path($file), PATHINFO_FILENAME);
        $string = $name.'data_copy'.'.'.$EXTENSION;
        if (file_exists(public_path() .'/'.$file)) {
            File::copy(public_path() .'/'.$file, public_path() .'/'.$path.$string);
            return $path . '/' . $string;
        }
        else{
            return null;
        }


    }
}
