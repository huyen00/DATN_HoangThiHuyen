<?php
namespace App\TextToSpeech;
use App\Http\Controllers\Traits\TextToSpeechTrait;
use App\TextToSpeech\TextToSpeech;
class ViettelApi extends TextToSpeech{
    use TextToSpeechTrait;
    protected $voice;
    protected $content;
    protected $pathSave;
    public function __construct(string $voice,  $content, string $pathSave)
    {
       
        $this->voice = $voice;
        $this->content = $content;
        $this->pathSave = $pathSave;

    }

    public function toSpeech($text)
    {
        $this->texToSpeechAPI($this->content, $text, $this->voice, $this->pathSave);
    }
}