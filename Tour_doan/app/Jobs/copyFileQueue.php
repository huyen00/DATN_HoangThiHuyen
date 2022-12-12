<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
class copyFileQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $file_path;
    protected $save_path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file_path, $save_path)
    {
        $this->file_path= $file_path;
        $this->save_path = $save_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
     
        if (file_exists(public_path() .'/'.$this->file_path)) {
            File::copyDirectory(public_path() .'/'.$this->file_path, public_path() .'/'.$this->save_path);
        }
       
    }
}
