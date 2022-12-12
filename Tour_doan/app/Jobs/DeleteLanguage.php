<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteLanguage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $key;
    protected $path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key , $path)
    {
        $this->key= $key;
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $jsonString = file_get_contents(base_path('resources/lang/' . $this->path));
        $data = json_decode($jsonString, true);
        foreach($data as  $data_key =>$element){
            $data[$data_key] =$this->format( $element);
        }
        unset($data[$this->key]);
        $newJsonString = json_encode($data, JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/' . $this->path), stripslashes($newJsonString));
    }
    public function format($string){
        $str = substr(json_encode($string, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),1);
        $new_str =substr($str,0,-1);
        return $new_str;
    }


}
