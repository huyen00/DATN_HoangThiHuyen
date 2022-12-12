<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Psy\Readline\Hoa\Console;
use DOMDocument;
trait xmlTrait
{


    /**
     * File upload trait used in controllers to upload files
     */
    public function readFileXMlKrpano($file,$data){
        $xmlDataString = file_get_contents(public_path($file));
        $xmlObject = simplexml_load_string($xmlDataString);

        $json = json_encode($xmlObject);
        $phpDataArray = json_decode($json, true);

        // return $phpDataArray;
        if(count($phpDataArray['scene']) > 0){
            $dataArray = array();
            foreach($phpDataArray['scene'] as $index => $datascene){
                $data_hotspot = $phpDataArray['scene'][$index]['hotspot'];
                foreach($data_hotspot as $index_h => $hotspot){
                    if($hotspot['@attributes']['style'] != "show_hide_polygo"){
                        //  return  $hotspot;
                        $hotspot['@attributes']['ath'] = $data[0]['hotspot'][$index_h]['ath'];
                        $hotspot['@attributes']['atv'] = $data[0]['hotspot'][$index_h]['atv'];
                    }
                }
                return $phpDataArray;
            }
        }

    }
    public function readDataFileXml($file,$type){
        if (file_exists(public_path($file))) {
            $xmlDataString = file_get_contents(public_path($file));
            $xmlObject = simplexml_load_string($xmlDataString);

            $json = json_encode($xmlObject);
            $phpDataArray = json_decode($json, true);

            if(count($phpDataArray[$type]) > 0){
                return $phpDataArray[$type];
            }
        }
    }
    // public function readStyleHotSpotFileXml($file){
    //     $xmlDataString = file_get_contents(public_path($file));
    //     $xmlObject = simplexml_load_string($xmlDataString);

    //     $json = json_encode($xmlObject);
    //     $phpDataArray = json_decode($json, true);
    //     if(count($phpDataArray['style']) > 0){
    //         return $phpDataArray['style'];
    //     }
    // }
    public function readHotSpot($pano,$phpDataArray){
        if(count($phpDataArray['scene']) > 0){
            $dataArray = array();
            foreach($phpDataArray['scene'] as $index => $datascene){
                $data_hotspot = $phpDataArray['scene'][$index]['hotspot'];
                foreach($data_hotspot as $index_h => $hotspot){
                    return $hotspot;
                }
            }
        }
    }
    public function saveXML($file){

        $xmlDataString = file_get_contents(public_path($file));
        $xmlObject = simplexml_load_string($xmlDataString);
        $dom_thing = dom_import_simplexml($xmlObject);

        $dom_new   = $dom_thing->appendChild($dom_thing->cloneNode(true));

        $new_node  = simplexml_import_dom($dom_new);
        // $new_node['scene'][0]['hotspot'][4]['@attributes'] = $data[0]['hotspot'][4];
        $json = json_encode($new_node);
        $phpDataArray = json_decode($json, true);
        return $phpDataArray;
        // $new_node->asXML();
        return $new_node;
    }
    public function saveXMLReadFile($file){
        // load the document
        // the root node is <info/> so we load it into $info
        $xmlDataString = file_get_contents(public_path($file));
        $scene = simplexml_load_file($xmlDataString);

        return $scene;
        // return $fileresponseXML;
        // update
        // $info->user->name->nameCoordinate->xName = $xPostName;
        // $info->user->name->nameCoordinate->yName = $yPostName;

        // // save the updated document
        // $info->asXML('test.xml');
    }

}
