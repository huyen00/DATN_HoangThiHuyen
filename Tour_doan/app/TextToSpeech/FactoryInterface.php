<?php
namespace App\TextToSpeech;

interface FactoryInterface{

    public static function getTypeTextToSpeech( string $type, $content, $language,string $path);
}