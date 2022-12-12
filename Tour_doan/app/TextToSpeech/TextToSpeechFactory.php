<?php
namespace App\TextToSpeech;
use App\TextToSpeech\FactoryInterface;
class TextToSpeechFactory implements FactoryInterface{


    public static function getTypeTextToSpeech( string $type, $content, $language,string $path){
        switch ($type) {
            case 'Google':
                return new GoogleApi($language,$content, $path);
            case 'Viettel':
                return  new ViettelApi($language,$content, $path);
            default:
                throw new \Exception('Notifier invalid');
        }
    }
}