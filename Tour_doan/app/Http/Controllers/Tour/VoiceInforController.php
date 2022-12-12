<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Tour\VoiceRequest;
use Inertia\Inertia;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Tour\VoiceUpdateRequest;
use App\Models\InforTour;
use App\Models\Tour;
use App\Models\VoiceContent;
use App\TextToSpeech\TextToSpeechFactory;
use Illuminate\Support\Facades\Http;
class VoiceInforController extends Controller
{
    use FileUploadTrait;

    public function index($id, $slug){
        $tour = Tour::findOrFail($id);
        $infor= InforTour::with('voices')->findOrFail($slug);
        $voices = $infor->voices;
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
        $response   = Http::get('https://viettelgroup.ai/voice/api/tts/v1/rest/voices');
        $category_voices =$response->json();
        return Inertia::render('Tour/Infor/Voice', compact('infor','voices','tour','category_voices','google_voices'));
    }

    public function store(VoiceRequest $request , $id, $slug){

        $tour = Tour::findOrFail($id);
        $infor= InforTour::with('voices')->findOrFail($slug);
        $path = $this->createDirectoryTour($tour,'infor');
        $destinationpath= $path.$infor->id .'/';
        if (!file_exists($destinationpath)) {
            mkdir($destinationpath, 0777, true);
        }

        $voice = VoiceContent::create([
            'name' => $request->name,
            'infor_id' => $infor->id,
            'type' => $request->type,
            'type_voice' => $request->type_voice
        ]);

        switch($request->type){
            case 'Google':

                if($infor->description_en ||  $infor->description_vn){
                    $texToSpeech= TextToSpeechFactory::getTypeTextToSpeech('Google',$voice,  $request->type_voice,$destinationpath);
                    if($request->type_voice =='en-US'){
                        $texToSpeech->toSpeech($infor->description_en);
                    }
                    if($request->type_voice =='vi-VN'){
                        $texToSpeech->toSpeech($infor->description_vn);
                    }
                }
                break;

            case 'Viettel':

                if($infor->description_vn && $request->type_voice){
                    $texToSpeech= TextToSpeechFactory::getTypeTextToSpeech('Viettel',$voice, $request->type_voice,$destinationpath);
                    $texToSpeech->toSpeech($infor->description_vn);
                }
                break;
        }
        return back()->with('success', "Create voice successfully");



    }

    public function update(VoiceUpdateRequest $request ,$id, $slug){
        $infor= InforTour::with('tour')->findOrFail($id);
        $voice = VoiceContent::findOrFail($slug);
        $path = $this->createDirectoryTour($infor->tour,'infor');
        $destinationpath= $path.$infor->id .'/';
        if (!file_exists($destinationpath)) {
            mkdir($destinationpath, 0777, true);
        }


        $voice->update([
            'name' => $request->name,
            'type' => $request->type,
            'type_voice' => $request->type_voice
        ]);
        $extension =" ";
        switch($request->type){
            case 'Google':

                if($infor->description_en ||  $infor->description_vn){
                    $this->DeleteFolder($voice->voice, $extension);
                    $texToSpeech= TextToSpeechFactory::getTypeTextToSpeech('Google',$voice,  $request->type_voice,$destinationpath);
                    if($request->type_voice =='en-US'){
                        $texToSpeech->toSpeech($infor->description_en);
                    }
                    if($request->type_voice =='vi-VN'){
                        $texToSpeech->toSpeech($infor->description_vn);
                    }
                }
                break;

            case 'Viettel':

                if($infor->description_vn && $request->type_voice){
                    $this->DeleteFolder($voice->voice, $extension);
                    $texToSpeech= TextToSpeechFactory::getTypeTextToSpeech('Viettel',$voice, $request->type_voice,$destinationpath);
                    $texToSpeech->toSpeech($infor->description_vn);
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

    public function selectVoice(Request $request){

        $data = $request->voices;
            for ($i = 0; $i < count($data); $i++) {
                VoiceContent::findOrFail($data[$i]['id'])->update(['state' =>false]);
            }
        $select_voice = VoiceContent::findOrFail($request->id);
        $select_voice->update([
            'state'=> true
        ]);
        return back()->with('success', "Select voice successfully");
    }
}
