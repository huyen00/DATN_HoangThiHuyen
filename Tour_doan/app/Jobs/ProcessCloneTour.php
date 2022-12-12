<?php

namespace App\Jobs;

use App\Models\Tour;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use App\Models\SettingTour;
use App\Models\SettingDisplay;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\FileManager;
use App\Models\InforTour;
use App\Models\Image;
use App\Models\VoiceContent;
use App\Http\Controllers\Traits\xmlTrait;
use App\Models\HotsPot;
use App\Models\Pano;
use Illuminate\Support\Facades\File;
class ProcessCloneTour implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,FileUploadTrait,xmlTrait;
    public $tour;
    public $fm;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Tour $tour, FileManager $fm)
    {
        $this->tour = $tour;
        $this->fm = $fm;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
   
        
        $path ='Tour' . '/';
        $name = time();
        $extracto = 'Tour';
        $string =  'Tour_copy-' . time();
     
        if (file_exists(public_path() .'/'.$this->tour->path)) {
            File::copyDirectory(public_path() .'/'.$this->tour->path, public_path() .'/'.$extracto . '/' . $string);
        }
        $path =  $extracto . '/' . $string;
        $clone_tour = Tour::create([
            'name' => $this->tour->name.'-copy',
            'path' => $path,
        ]);
        
        $clone_tour->code = $clone_tour->id.Str::random(15);
        $clone_tour->save();

        //   SettingDisplay     
        $setting_display = new SettingDisplay();
        $setting_display->tour_id = $clone_tour->id;
        $setting_display->save();
        //savePano

    
        $directories = $this->fm->getDeirectories(
            'local',
            $clone_tour->path . '/panos'
        );
       
        foreach ($directories as $dir) {
            $id_thumb = 'scene_' . Str::of($dir['basename'])->before('.tiles');
            $pano = Pano::create([
                'name' => $dir['basename'],
                'thumb_img' => $dir['path'] . '/thumb.jpg',
                'id_thumb' => $id_thumb,
                'tour_id' => $clone_tour->id
            ]);
        }
        $datascene = $this->readDataFileXml($clone_tour->path . "/tour.xml");

        // dd($datascene);
        // dd(array_column($datascene,'@attributes'));
        $array_sceneName = array_column(array_column($datascene,'@attributes'),'name');
        $id_scene = array_search('scene_1_flycam1',$array_sceneName);

        foreach($clone_tour->panos as $pano)
        {
            if(count($pano->hotspots) < 1){
                $index_scene = array_search($pano->id_thumb,$array_sceneName);
                foreach($datascene[$index_scene]['hotspot'] as $_hotspot){
                    if(array_key_exists('@attributes',$_hotspot) == true){
                        $hotspot_data = $_hotspot['@attributes'];
                        $hotspot = $this->createHotSpot($hotspot_data,$pano);
                    }
                }
            }
        }


        //SettingColor
        if($this->tour->setting_color)
        {
            $clone_tour->setting_color()->create([
                'icon_color' => $this->tour->setting_color->icon_color,
                'bg_icon_color' => $this->tour->setting_color->bg_icon_color,
                'hover_color_icon' => $this->tour->setting_color->hover_color_icon,
                'hover_bg_icon_color' => $this->tour->setting_color->hover_bg_icon_color,
                'active_icon_color' => $this->tour->setting_color->active_icon_color,
                'active_bg_icon_color' => $this->tour->setting_color->active_bg_icon_color,
                'bg_menu_color' => $this->tour->setting_color->bg_menu_color,
                'bg_color_category' => $this->tour->setting_color->bg_color_category,
                'color_category' => $this->tour->setting_color->color_category,
                'color_item' => $this->tour->setting_color->color_item,
                'hover_color_item' => $this->tour->setting_color->hover_color_item,
                'active_color_item' =>  $this->tour->setting_color->active_color_item,
            ]);
        }      
        //CategoryPano
        if(count($this->tour->category_panos) >0){
            foreach($this->tour->category_panos as $category){
                $clone_tour->category_panos()->create([
                    'name' => $category->name,
                    'id_priority' => $category->id_priority
                ]);
            }
        }
        //icon
        if(count($this->tour->icons) >0){
            $path = $this->createDirectoryTour($clone_tour, 'icons');
            foreach($this->tour->icons as $icon){
                $clone_tour->icons()->create([
                    'name' => $icon->name,
                    'icon' =>  $this->copy($icon->icon,$path),
                ]);
            }
        }

        if($this->tour->setting_tour){
            $path = $this->createDirectoryTour($clone_tour, 'setting');
            
            $clone_tour->setting_tour()->create([
                'thumb' => $this->tour->setting_tour->thumb ? $this->copy($this->tour->setting_tour->thumb,$path): null,
                'logo' => $this->tour->setting_tour->logo ? $this->copy($this->tour->setting_tour->logo,$path): null,
                'favicon' => $this->tour->setting_tour->favicon ? $this->copy( $this->tour->setting_tour->favicon,$path): null,
            ]);
        }
  
        //Map
        if($this->tour->map){
            $path = $this->createDirectoryTour($clone_tour, 'map');
       
            $clone_tour->map()->create([
                'name' => $this->tour->map->name,
                'address' => $this->tour->map->address,
                'latitude' => $this->tour->map->latitude,
                'longtitude' => $this->tour->map->longtitude,
                'image' => $this->tour->map->image ? $this->copy($this->tour->map->image,$path): null,
            ]);
        }
        //Font
        if($this->tour->font){
            $path = $this->createDirectoryTour($clone_tour, 'font');
          
            $clone_tour->font()->create([
                'name' => $this->tour->font->name,
                'weight' => $this->tour->font->weight,
                'size' => $this->tour->font->size,
                'font' => $this->tour->font->font ? $this->copy($this->tour->font->font,$path): null,
            ]);
        }
        //Infor
        if(count($this->tour->infors) >0){
            foreach($this->tour->infors as $infor){
                $new_infor = InforTour::create([
                    'title' => $infor->title,
                    'description_vn' => $infor->description_vn ? $infor->description_vn :null,
                    'description_en' => $infor->description_en ? $infor->description_en :null,
                    'tour_id' => $clone_tour->id
                ]);
                $path = $this->createDirectoryTour($clone_tour,'infor');
                $image_path = $path.$new_infor->id.'/';
                if (!file_exists(public_path().'/'.$image_path)) {
                    File::makeDirectory(public_path().'/'.$image_path, $mode = 0777, true, true);
                }
                if(count($infor->images) >0)
                {
                   
                    foreach($infor->images as $image){
                        // dd($image->image);
                        $new_image = Image::create([
                            'name' => $image->name,
                            'imageable_id' => $new_infor->id,
                            'imageable_type' => $image->imageable_type,
                            'image' =>  $image->image ? $this->copy($image->image,$image_path) : null,
                        ]);
                    }
                }
                if(count($infor->voices) >0)
                {
                    foreach($infor->voices as $voice){
                        $new_voice = VoiceContent::create([
                            'name' => $voice->name,
                            'infor_id' => $new_infor->id,
                            'state' => $voice->state,
                            'voice' =>$voice->voice? $this->copy($voice->voice,$image_path):null,
                        ]);
                    }
                }
              
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

            "pano_id"=> $pano->id
        ]);
        return $hotspot;
    }
}
