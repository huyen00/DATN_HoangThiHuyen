<?php
namespace App\TextToSpeech;
use App\Http\Controllers\Traits\TextToSpeechTrait;
use App\TextToSpeech\TextToSpeech;
class GoogleApi extends TextToSpeech{
    use TextToSpeechTrait;
    protected $language;
    protected $content;
    protected $pathSave;
    public function __construct(string $language,  $content, string $pathSave)
    {
        
        $this->language = $language;
        $this->content = $content;
        $this->pathSave = $pathSave;

    }

    public function toSpeech($text)
    {

         $this->GoogleTextSpeech($this->content, $text, $this->language, $this->pathSave);
    }
}