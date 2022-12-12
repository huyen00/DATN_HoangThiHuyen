<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceContent extends Model
{
    use HasFactory;
    protected $table = 'voice_contents';
    protected $fillable = ['id', 'name','voice', 'content_id', 'state','infor_id','type_voice','type','created_at', 'updated_at'];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
    public function infor()
    {
        return $this->belongsTo(InforTour::class, 'infor_id');
    }
    
}
