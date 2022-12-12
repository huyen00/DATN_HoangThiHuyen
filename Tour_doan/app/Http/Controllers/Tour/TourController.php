<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\FileManager;
use App\Http\Requests\Tour\StoreRequest;
use App\Models\Pano;
use App\Models\SettingDisplay;
use App\Models\Tour;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\xmlTrait;
use App\Jobs\ProcessCloneTour;
use App\Models\HotsPot;
use App\Models\IconTour;
use App\Models\Template;
class TourController extends Controller
{

    use FileTrait, FileUploadTrait,xmlTrait;
    public $pathPrefix;
    public $fm;
    public $hotspot_dataTourXML;

    /**
     * FileManagerController constructor.
     *
     * @param FileManager $fm
     */
    function __construct(FileManager $fm)
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['destroy']]);
        $this->pathPrefix = Storage::disk('public')
            ->getDriver()
            ->getAdapter()
            ->getPathPrefix();
        $this->fm = $fm;

    }
    public function index(Request $request)
    {
        $tours = Tour::with('setting_tour',  'panos', 'template')->where(function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->term . '%');
            // $query->orwhere('phone', 'LIKE', '%' . $request->term . '%');
        })->paginate(10)->appends($request->term);
        $templates = Template::get();
        return Inertia::render('Tour/Index', compact('tours','templates'));
    }

    public function store(StoreRequest $request)
    {
        // dd($request);
        $zipPath = 'Tour';

        if (!file_exists($zipPath)) {
            mkdir($zipPath, 0777, true);
        }
        $tour = Tour::create([
            'name' => $request->name,
            'path' => $this->unzip($request->file('path'), $zipPath)
        ]);
        $tour->code = $tour->id . Str::random(15);
        $tour->template_id = 2;
        $tour->save();
        $setting_display = new SettingDisplay();
        $setting_display->tour_id = $tour->id;
        $setting_display->save();

        $file = $tour->path . "/tour.xml";
        $this->dataTourXML = $this->readDataFileXml($file,'scene');
        $this->savePano($tour);
        $this->saveStyleHotSpot($tour);
        return back()->with('success', 'Create successfully');
    }
    public function update(Request $request, $id)
    {
        $tour = Tour::with('panos')->findOrFail($id);
        $this->validate(
            $request,
            [
                'name' => 'required|unique:tours,name,' . $tour->id,
                'path' => 'nullable|mimes:zip',
            ]
        );
        $zipPath = 'Tour';
        if (!file_exists($zipPath)) {
            mkdir($zipPath, 0777, true);
        }
        if($request->checkbox != null && $request->checkbox == true){
            if ($request->hasFile('path')) {
                foreach ($tour->panos as $pano) {
                    $pano->delete();
                }
            }
            $tour->update([
                'name' => $request->name,
                'path' => $request->hasFile('path') ?  $this->update_zip($request->file('path'), $zipPath, $tour->path) :  $tour->path,
            ]);
        }else{
            $tour->update([
                'name' => $request->name,
                'path' => $request->hasFile('path') ?  $this->update_zip_old($request->file('path'), $zipPath, $tour->path) :  $tour->path,
            ]);
        }
        if($request->checkbox != null && $request->checkbox == true){
            if ($request->hasFile('path')) {
                $this->savePano($tour);
                $this->updateStyleHotSpot($tour);
            }
        }
        return back()->with('success', 'Create successfully');
    }
    public function content(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);
    }
    public function savePano($tour)
    {
        $file = $tour->path . "/tour.xml";
        $this->dataTourXML = $this->readDataFileXml($file,'scene');
       
            if(array_key_exists('@attributes',$this->dataTourXML)){
                // 1 scene
                $name = $this->dataTourXML['@attributes']['title'];
                $path_onstart  = $this->dataTourXML['@attributes']['onstart'];
            }else{
                // nhieu scene
                // dd($this->dataTourXML);
                $array_sceneName = array_column($this->dataTourXML,'@attributes');
                foreach($array_sceneName as $scene){
                    $list_text = explode(",",($scene['onstart']));
         
                    if(count($list_text) > 1){
                        $link_audio = str_replace(' ','',$list_text[1]);
                    }else{
                        $link_audio = null;
                    }
                    $pano = Pano::where('tour_id', $tour->id)->where('id_thumb', $scene['title'])->first();
                    if($pano){
                      
                        $pano->update([
                            'name' => $scene['title'],
                            'thumb_img' =>  $tour->path . "/". $scene['thumburl'],
                            'id_thumb' => $scene['name'],
                            'path_onstart' => $tour->path.'/'.$link_audio,
                            'tour_id' => $tour->id
                        ]);

                    }else{
                        Pano::create([
                            'name' => $scene['title'],
                            'thumb_img' =>  $tour->path . "/". $scene['thumburl'],
                            'id_thumb' => $scene['name'],
                            'path_onstart' => $tour->path.'/'.$link_audio,
                            'tour_id' => $tour->id
                        ]);
                    }
                }
            }
    }
    public function saveStyleHotSpot($tour){
        $file_hotspot = $tour->path . "/update.xml";
        $list_style_hotspot = $this->readDataFileXml($file_hotspot,'style');
        $array_sceneName = array_column($list_style_hotspot,'@attributes');
        for($i=0; $i < count($array_sceneName); $i++ ){

                $tour->icons()->create([
                    'name'=> $array_sceneName[$i]['name'],
                    'icon' => array_key_exists('url',$array_sceneName[$i]) ?  $tour->path . "/" . $array_sceneName[$i]['url'] : null,
                ]);

        }
    }

    public function updateStyleHotSpot($tour){
        $file_hotspot = $tour->path . "/update.xml";
        $list_style_hotspot = $this->readDataFileXml($file_hotspot,'style');
        $array_sceneName = array_column($list_style_hotspot,'@attributes');

        for($i=0; $i < count($array_sceneName); $i++ ){
            $icon = IconTour::where('tour_id', $tour->id)->where('name',  $array_sceneName[$i]['name'])->first();

            if($icon){
                $icon->update([
                    'name'=> $array_sceneName[$i]['name'],
                    'icon' => array_key_exists('url',$array_sceneName[$i]) ?  $tour->path . "/" . $array_sceneName[$i]['url'] : null,
                ]);
            }
            else{
                $tour->icons()->create([
                    'name'=> $array_sceneName[$i]['name'],
                    'icon' => array_key_exists('url',$array_sceneName[$i]) ?  $tour->path . "/" . $array_sceneName[$i]['url'] : null,
                ]);
            }
        }
    }
    public function createHotSpot($data,$pano){
        $hotspot = HotsPot::updateOrCreate([
            "name"=>array_key_exists('name',$data) ? $data['name'] : null,
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
            "onhover"=>array_key_exists('onhover',$data) ? $data['onhover']: null,
            "onclick"=>array_key_exists('onclick',$data) ? $data['onclick']: null,
            "linkedscene"=>array_key_exists('linkedscene',$data) ? $data['linkedscene']: null,

            "pano_id"=> $pano->id,
            "icon_id" => $pano->id,
        ]);
        return $hotspot;
    }

    public function delete($id)
    {
        $tour = Tour::with('infors.images')->findOrFail($id);
        foreach($tour->infors as $infor){
            foreach($infor->images as $image){
                    $image->delete();
            }
        }
        File::deleteDirectory($tour->path);
        $tour_path = 'Tour' . '/' . $tour->id;
        File::deleteDirectory($tour_path);

        $tour->delete();
        return back()->with('success', 'Delete successfully');
    }

    public function tour($code){
        $tour = Tour::with(['setting_tour','template','setting_display','setting_color','category_panos.panos','panos.category_pano','panos.hotspots.icon'])->where('code',$code)->first();
        if($tour ==null){
            abort(404);
        }
            $tour_group = $tour->panos->groupBy('category_pano.name');
            $list_hotspot_first = $tour->panos[0]->hotspots;
            $file = $tour->path . "/tour.xml";
            $isEditor = false;
          if($tour->template ==null){
              return view('template.template1',compact('isEditor','tour','tour_group','file','list_hotspot_first'));
            }
          else{
              return view('template.'.$tour->template->link_code,compact('isEditor','tour','tour_group','list_hotspot_first','file'));
          }
    }
    public function ListHotSpot($code,$scene){
        $tour = Tour::with(['category_panos.panos','panos.hotspots.icon'])->where('code',$code)->first();
        $pano = $tour->panos->where('name',$scene);
        return json_encode($pano);
    }

    public function cloneTour($id){
        $tour= Tour::with('setting_tour','setting_display','panos.hotspots.contents.voices', 'setting_color','category_panos','panos.category_pano','map', 'font','infors.images','infors.voices','icons')->findOrFail($id);
        dispatch( new ProcessCloneTour($tour, $this->fm));
    }

}
