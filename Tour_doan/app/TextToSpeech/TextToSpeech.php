<?php 
namespace App\TextToSpeech;

abstract class TextToSpeech{
 
    abstract function toSpeech($text);
}