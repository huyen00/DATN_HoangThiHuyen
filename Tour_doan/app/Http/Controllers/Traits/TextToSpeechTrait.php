<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Illuminate\Support\Str;
use Google_Client;
use GuzzleHttp\Client;
trait TextToSpeechTrait
{
    public function GoogleTextSpeech($content, $text, $language, $voicePath)
    {
        
        $voiceSavePath = $voicePath . $language . '/';
        if (!file_exists($voiceSavePath)) {
            mkdir($voiceSavePath, 0777);
        }

        $client = new Google_Client();
      

        putenv('GOOGLE_APPLICATION_CREDENTIALS' . '=' . storage_path() . '/laravel-google-analytics/true360-295503-faeb62a25085.json');
        $client->useApplicationDefaultCredentials();
        $textToSpeechClient = new TextToSpeechClient();

        $input = new SynthesisInput();
        $input->setText($text);
        $voice = (new VoiceSelectionParams())
            ->setLanguageCode($language)
            ->setSsmlGender(SsmlVoiceGender::SSML_VOICE_GENDER_UNSPECIFIED);

        $audioConfig = (new AudioConfig())
            ->setAudioEncoding(AudioEncoding::MP3);

        $resp = $textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);
        $name= time();
        // $voice = $newfile->getContent();
        file_put_contents($voiceSavePath . $content->id .$name. '.mp3', $resp->getAudioContent());
        switch ($language) {
            case "en-US":
                $content->voice = $voiceSavePath . $content->id .$name. '.mp3';
                break;
            case 'vi-VN':
                $content->voice =$voiceSavePath . $content->id .$name. '.mp3';
                break;
        
        }

        $content->save();
    }
    public function texToSpeechAPI($item,$text,$name,$path){
        $token = 'do4YBRcFD8xX-2jQ617Kptlzo1ABX6K66amKw2n0RHhC0UqOKgulMthhuwaXrtcg';
        $callApi = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Content-Disposition' => 'attachment; filename="examp.wav"',
                'Content-Description' => 'File Transfer',

                'token' =>  $token,
            ]
        ]);
        $body['text'] = $text;
        $body['voice'] = $name;
        $body['id'] = $item->id;
        $body['without_filter'] = false;
        $body['speed'] = 1.0;
        $body['tts_return_option'] = 2;

        $body = json_encode($body, JSON_UNESCAPED_UNICODE);
        $response  = $callApi->request('POST', 'https://viettelgroup.ai/voice/api/tts/v1/rest/syn', [

            'body' => $body
        ]);



        $file = $response->getBody();
        $headers = [
            'Content-Type' => 'application/json',
            'Content-Type' => 'audio/wav',
            'Content-Disposition' => 'attachment; filename="1.wav"'
        ];
        $newfile = \Response::make($file, 200, $headers);
        $voice = $newfile->getContent();
        $name= time();
        file_put_contents($path . $item->id .$name. '.wav', $voice);
        $item->voice = $path .  $item->id .$name . '.wav';
        $item->save();
    }
}
