<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Language;

trait LanguageTrait
{
    public function updateLanguage($key, $en, $vn, $relation)
    {

        $languages = Language::where('key', $key)->first();
        //$this->checkPermission();
        $en = $this->formatRequest($en);
        $vn = $this->formatRequest($vn);;
        if ($languages) {

            if ($en) {

                $jsonString = file_get_contents(base_path('resources/lang/en.json'));
                $data = json_decode($jsonString, true);
                foreach ($data as  $data_key => $element) {
                    $data[$data_key] = $this->format($element);
                }
                $data[$key] = $this->format($en);
                $languages->en = $en;
                // dd($data);
                // Write File
                $languages->save();
                $newJsonString = json_encode($data, JSON_UNESCAPED_UNICODE);
                file_put_contents(base_path('resources/lang/en.json'), stripslashes($newJsonString));
            }
            if ($vn) {

                $jsonString = file_get_contents(base_path('resources/lang/vi.json'));
                $data = json_decode($jsonString, true);
                foreach ($data as  $data_key => $element) {
                    $data[$data_key] = $this->format($element);
                }
                $data[$key] = $this->format($vn);
                $languages->vn = $vn;
                // Update Key

                // dd($data);
                // Write File
                $languages->save();
                $newJsonString = json_encode($data, JSON_UNESCAPED_UNICODE);
                file_put_contents(base_path('resources/lang/vi.json'), stripslashes($newJsonString));
            }
        } else {
            $this->CreateLanguage($key, $en, $vn, $relation);
        }
    }
    public function CreateLanguage($key, $en, $vn, $relation)
    {

        $language = new Language();
        $language->key = $key;
        $en = $this->formatRequest($en);
        $vn = $this->formatRequest($vn);
        //$this->checkPermission();
        if ($en) {
            $destinationpath = base_path('resources/lang/en.json');
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }
            $jsonString = file_get_contents(base_path('resources/lang/en.json'));
            $data = json_decode($jsonString, true);
            // Update Key
            foreach ($data as  $data_key => $element) {
                $data[$data_key] = $this->format($element);
            }
            $data[$key] = $this->format($en);
            // dd($data);
            $language->en = $en;
            // dd($data);
            if ($relation) {
                $relation->languages()->save($language);
            } else {
                $language->save();
            }
            // Write File
            $newJsonString = json_encode($data, JSON_UNESCAPED_UNICODE);
            file_put_contents(base_path('resources/lang/en.json'), stripslashes($newJsonString));
        }

        if ($vn) {
            $jsonString = file_get_contents(base_path('resources/lang/vi.json'));
            $data = json_decode($jsonString, true);
            foreach ($data as  $data_key => $element) {
                $data[$data_key] = $this->format($element);
            }
            $data[$key] = $this->format($vn);
            $language->vn = $vn;
            // dd($data);
            // Write File
            if ($relation) {
                $relation->languages()->save($language);
            } else {
                $language->save();
            }
            $newJsonString = json_encode($data, JSON_UNESCAPED_UNICODE);
            file_put_contents(base_path('resources/lang/vi.json'), stripslashes($newJsonString));
        }
    }





    public function deleteLanguage($key, $file)
    {

        $jsonString = file_get_contents(base_path('resources/lang/' . $file));
        $data = json_decode($jsonString, true);

        foreach ($data as  $data_key => $element) {
            $data[$data_key] = $this->format($element);
        }
        unset($data[$key]);
        $newJsonString = json_encode($data, JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/' . $file), stripslashes($newJsonString));
    }

    public function deleteIfNull($request, $data, $attribute)
    {
        if ($request->$attribute == null) {
            $old_language = Language::where('key',  $data->$attribute)->first();


            if ($old_language !== null) {
                $this->deleteLanguage($old_language->key, 'en.json');
                $this->deleteLanguage($old_language->key, 'vi.json');

                $old_language->delete();
            }
        }
    }

    public function saveLanguage($key, $en, $vn)
    {
        //$this->checkPermission();
        $en = $this->formatRequest($en);
        $vn = $this->formatRequest($vn);
        if ($en) {

            $jsonString = file_get_contents(base_path('resources/lang/en.json'));
            $data = json_decode($jsonString, true);
            foreach ($data as  $data_key => $element) {
                $data[$data_key] = $this->format($element);
            }
            $data[$key] = $this->format($en);
            $newJsonString = json_encode($data, JSON_UNESCAPED_UNICODE);
            file_put_contents(base_path('resources/lang/en.json'), stripslashes($newJsonString));
        }
        if ($vn) {

            $jsonString = file_get_contents(base_path('resources/lang/vi.json'));
            $data = json_decode($jsonString, true);
            foreach ($data as  $data_key => $element) {
                $data[$data_key] = $this->format($element);
            }
            $data[$key] = $this->format($vn);
            $newJsonString = json_encode($data, JSON_UNESCAPED_UNICODE);
            file_put_contents(base_path('resources/lang/vi.json'), stripslashes($newJsonString));
        }
    }
    public function format($string)
    {
        $str = substr(json_encode($string, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), 1);
        $new_str = substr($str, 0, -1);
        return $new_str;
    }

    public function checkPermission()
    {
        $destinationpath_en = base_path('resources/lang/en.json');
        if (!file_exists($destinationpath_en)) {
            mkdir($destinationpath_en, 0777, true);
        } else {
            chmod($destinationpath_en, 0777);
        }
        $destinationpath_vn = base_path('resources/lang/vi.json');
        if (!file_exists($destinationpath_vn)) {
            mkdir($destinationpath_vn, 0777, true);
        } else {
            chmod($destinationpath_vn, 0777);
        }
    }


    public function formatRequest($value)
    {
        return $value == null ? " " : $value;
    }
}
