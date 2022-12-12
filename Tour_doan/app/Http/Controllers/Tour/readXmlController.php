<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Http\Controllers\Traits\xmlTrait;
use App\Models\HotsPot;
class readXmlController extends Controller
{
    use xmlTrait;
    public function index(Request $req,$id)
    {
        $tour = Tour::with(['infors','setting_tour','category_panos','panos.category_pano','panos.hotspots.icon'])->findOrFail($id);
        $tour_group = $tour->panos->groupBy('category_pano.name');
        $list_hotspot_first =$tour->panos[0]->hotspots;
        $file = $tour->path . "/tour.xml";
        $datascene = $this->readDataFileXml($file,'scene');
        if($datascene != null){
            $array_sceneName = array_column(array_column($datascene,'@attributes'),'name');
            $layer_data = [];
            foreach($tour->panos as $pano)
            {
            //   $pano->hotspots()->delete();
                if(count($pano->hotspots) < 1){
                    if(array_key_exists('@attributes',$datascene)){
                        // 1 scene
                        foreach($datascene['hotspot'] as $index=>$_hotspot){
                            if(array_key_exists('@attributes',$_hotspot) == true){
                                $hotspot_data = $_hotspot['@attributes'];
                                $layer_data = $datascene['layer'][$index]['@attributes'];
                                $hotspot = $this->createHotSpot($hotspot_data,$pano,$layer_data);
                            }
                        }
                    }else{
                        $index_scene = array_search($pano->id_thumb,$array_sceneName);
                        $index_layer = 0;
                        // dd($datascene);
                        foreach($datascene[$index_scene]['hotspot'] as $index=>$_hotspot){
                            if(array_key_exists('@attributes',$_hotspot) == true){
                                $hotspot_data = $_hotspot['@attributes'];
                                if(array_key_exists('style',$hotspot_data) == true){
                                    if($hotspot_data['style'] == "hs_image_text"  && $datascene[$index_scene]['layer'] != null){
                                        if($index_layer < count($datascene[$index_scene]['layer'])){
                                            $layer_data = $datascene[$index_scene]['layer'][$index_layer]['@attributes'];
                                        }
                                        $index_layer++;
                                }
                                    $hotspot = $this->createHotSpot($hotspot_data,$pano,$layer_data);
                                }
                            }
                        }
                        //
                    }
                }
            }
        }
        $isEditor = true;


        if($tour->template ==null){
            return view('template.template1',compact('isEditor','tour','tour_group','file','list_hotspot_first'));
          }
        else{
            return view('template.'.$tour->template->link_code,compact('isEditor','tour','tour_group','list_hotspot_first','file'));
        }
    }
    public function preview(Request $request,$code){
        $tour = Tour::with(['setting_tour','category_panos','panos.category_pano','panos.hotspots'])->where('code',$code)->first();
        $tour_group = $tour->panos->groupBy('category_pano.name');
        return view('tour360.preview',compact('tour','tour_group'));
    }
    public function map_preview(Request $request,$code)
    {
        $tour = Tour::with('map')->where('code',$code)->first();
        if ($tour->map == null) {
            $link_img = null;
        } else {
            $link_img = $tour->map->image;
        }
        $isEditor = false;
        if ($tour->map) {
            return view('tour360.map', ['map' => $tour->map, 'link_img' => $link_img, 'tour' => $tour,'isEditor'=>$isEditor]);
        } else {
            return view('errors.404')->with('msg', 'notification.something_null');
        }
    }
    public function editTour(Request $request,$tour_code){
        $tour = Tour::where('code',$tour_code)->first();
        $file = $tour->path . "/tour.xml";
        // $data_file = $this->readFileXMlKrpano($file,$request->scene);
       // $file_xml = $this->saveXMLReadFile($file);
       //return $tour->panos[0];
        $pano = $tour->panos->where('id_thumb',$request->scene['scene_name'])->first();
        // return ($pano->hotspots->pluck('name'));
        // for($i= 0; $i < count($request->scene['hotspot']) ; $i++){
        //     $hotspot_name = $request->scene['hotspot'][$i]['name'];
        //     $check_exis_pano = in_array($hotspot_name,$pano->hotspots->pluck('name')->toArray());
        //     if($check_exis_pano){
        //         // update vị tri
        //     }else{
        //         // tao moi hotspot
        //     }
        // }


        // return $request->scene['hotspot'][34]['ath'];
        foreach($pano->hotspots as $index=>$hotspot){
            if($request->scene['hotspot'][$index]['style'] != "show_hide_polygo"){
                $hotspot->ath = $request->scene['hotspot'][$index]['ath'];
                $hotspot->atv = $request->scene['hotspot'][$index]['atv'];
                $hotspot->onhover = array_key_exists('onclick',$request->scene['hotspot'][$index]) ? $request->scene['hotspot'][$index]['onclick']: null;
                // $request->scene['hotspot'][$index]['onhover'];
                $hotspot->save();
            }
            // $this->createHotSpot($request->scene['hotspot'][$index],$pano,null);


        }
        return $pano;
    }

    public function editorTour(Request $req){
        // return $req;
        // if($req->isMethod("POST")){

            $xmlDataString = file_get_contents(public_path('Tour/krpano_TraHoaVang-main-1660794174/tour.xml'));
            $xmlObject = simplexml_load_string($xmlDataString);
            $json = json_encode($xmlObject);
            $phpDataArray = json_decode($json, true);
            return $phpDataArray;
            if(count($phpDataArray['scene']) > 0){
                $dataArray = array();

                foreach($phpDataArray['scene'] as $index => $data){

                    $dataArray[] = [
                        "name" => $data['name'],
                        "category" => $data['category'],
                        "price" => $data['price'],
                        "total_videos" => $data['videos']
                    ];
                }
                XmlData::insert($dataArray);
                return back()->with('success','Data saved successfully!');
            }
        // }
    }
    public function createHotSpot($data,$pano,$layer_data){

        $text_show = null;
        if($layer_data != null){
            if($data['style'] == "hs_image_text"){
                $text_show = $layer_data['html'];
            }else if($data['style'] == "Iconcallout_pano_right" || $data['style'] == "Iconcallout_pano_left"){
                $text_show = array_key_exists('content',$data) ? $data['content'] : null ;
            }else{
                $text_show = null;
            }
        }
        // $icon_spot = $pano->tour->icons->where('name',$data['style'])->first();
        $hotspot = HotsPot::updateOrCreate([
            "name"=>array_key_exists('name',$data) ? $data['name'] : null,
            "html"=>$text_show,

            "ath"=>array_key_exists('ath',$data) ? $data['ath'] : null,
            "atv"=>array_key_exists('atv',$data) ? $data['atv'] : null,
            "style"=> array_key_exists('style',$data) ? $data['style'] : null,
            "distorted"=> array_key_exists('distorted',$data) ? $data['distorted'] : null,
            "zoom"=>array_key_exists('zoom',$data) ? $data['zoom'] : null,
            "url"=>array_key_exists('url',$data) ? $data['url'] : null,

            "x"=>array_key_exists('rx',$data) ? $data['rx'] : null,
            "y"=>array_key_exists('ry',$data) ? $data['ry'] : null,
            "z"=>array_key_exists('rz',$data) ? $data['rz']: null,
            "renderer"=>array_key_exists('renderer',$data) ? $data['renderer']: null,
            "scale"=>array_key_exists('scale',$data) ? $data['scale']: null,
            "alpha"=>array_key_exists('alpha',$data) ? $data['alpha']: null,

            "onload"=>array_key_exists('onload',$data) ? $data['onload'] : null,
            "onloaded"=>array_key_exists('onloaded',$data) ? $data['onloaded'] : null,
            "onhover"=>array_key_exists('onhover',$data) ? $data['onhover'] : null,
            "onclick"=>array_key_exists('onclick',$data) ? $data['onclick']: null,
            "linkedscene"=>array_key_exists('linkedscene',$data) ? $data['linkedscene']: null,

            "pano_id"=> $pano->id,
            // "icon_id"=> $icon_spot->id
        ]);
        return $hotspot;
    }

}
