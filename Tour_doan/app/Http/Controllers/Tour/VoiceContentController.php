<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\VoiceContent;
use Illuminate\Http\Request;
use App\TextToSpeech\TextToSpeechFactory;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Tour\VoiceRequest;
use App\Http\Requests\Tour\VoiceUpdateRequest;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class VoiceContentController extends Controller
{
    use FileUploadTrait;

    public function index($id){
        $content = Content::with('hotspot.pano.tour', 'voices')->findOrFail($id);
        $pano = $content->hotspot->pano;
        $tour = $content->hotspot->pano->tour;
        $hotspot =  $content->hotspot;
        $voices = $content->voices;
        $response   = Http::get('https://viettelgroup.ai/voice/api/tts/v1/rest/voices');
        $google_voices=  array(
            [
             'name' => 'English',
             'code' => 'en-US'
           ],
           [
               'name' => 'VieNamese',
               'code' => 'vi-VN'
             ],
         );
      
        $category_voices =$response->json();
        return Inertia::render('Tour/Hotspot/Voice', compact('hotspot', 'tour', 'pano','voices', 'content','category_voices','google_voices'));
    }
    public function store(VoiceRequest $request , $id){
        $content = Content::with('hotspot.pano.tour')->findOrFail($id);
        $tour = $content->hotspot->pano->tour;
        $hotspot =  $content->hotspot;
        $hotspot_path = $this->createDirectory($tour, $hotspot);
        $voice_path = $hotspot_path . '/content/';
        if (!file_exists($voice_path)) {
            mkdir($voice_path, 0777, true);
        }
        $voice = VoiceContent::create([
            'name' => $request->name,
            'content_id' => $content->id,
            'type' => $request->type,
            'type_voice' => $request->type_voice
        ]);
     
        switch($request->type){
            case 'Google':
            
                if($content->description_en ){
                    $texToSpeech= TextToSpeechFactory::getTypeTextToSpeech('Google',$voice,  $request->type_voice,$voice_path);
                    if($request->type_voice =='en-US'){
                        $texToSpeech->toSpeech($content->description_en);
                    }
                    if($request->type_voice =='vi-VN'){
                        $texToSpeech->toSpeech($content->description_vn);
                    }
                }
                break;
               
            case 'Viettel':
               
                if($content->description_vn && $request->type_voice){
                    $texToSpeech= TextToSpeechFactory::getTypeTextToSpeech('Viettel',$voice, $request->type_voice,$voice_path);
                    $texToSpeech->toSpeech($content->description_vn);
                }
                break;  
        }
        return back()->with('success', "Create voice successfully");
      
        

    }

    public function update(VoiceUpdateRequest $request ,$id){
        $voice = VoiceContent::with('content.hotspot.pano.tour')->findOrFail($id);
        $tour = $voice->content->hotspot->pano->tour;
        $hotspot =  $voice->content->hotspot;
        $hotspot_path = $this->createDirectory($tour, $hotspot);
        $content= $voice->content;
        $voice_path = $hotspot_path . '/content/';
        $voice->update([
            'name' => $request->name,
            'type_voice' => $request->type_voice,
            'type' => $request->type
        ]);
        $extension =" ";
        switch($request->type){
            case 'Google':
            
                if($content->description_en ){
                  
                    $this->DeleteFolder($voice->voice, $extension);
                    $texToSpeech= TextToSpeechFactory::getTypeTextToSpeech('Google',$voice,  $request->type_voice,$voice_path);
                    if($request->type_voice =='en-US'){
                        $texToSpeech->toSpeech($content->description_en);
                    }
                    if($request->type_voice =='vi-VN'){
                        $texToSpeech->toSpeech($content->description_vn);
                    }
                }
                break;
               
            case 'Viettel':
               
                if($content->description_vn && $request->type_voice){
                    $this->DeleteFolder($voice->voice, $extension);
                    $texToSpeech= TextToSpeechFactory::getTypeTextToSpeech('Viettel',$voice, $request->type_voice,$voice_path);
                    $texToSpeech->toSpeech($content->description_vn);
                }
                break;  
        }
        return back()->with('success', "Update voice successfully");

    }

    public function delete($id){
        $voice = VoiceContent::findOrFail($id);

        $extension =" ";
        $this->DeleteFolder($voice->voice, $extension);
        $voice->delete();
        return back()->with('success', "Delete voice successfully");
    }
}
