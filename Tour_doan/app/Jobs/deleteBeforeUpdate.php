<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\File;
class deleteBeforeUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,FileUploadTrait;
    protected $file_path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file_path)
    {
        $this->file_path= $file_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      
        if (file_exists(public_path() .'/'.$this->file_path)) {
            // dd(public_path() .$this->file_path);
            File::deleteDirectory(public_path() .'/'.$this->file_path);
        }
    }
}
