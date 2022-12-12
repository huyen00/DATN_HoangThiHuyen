<?php

namespace App\Models;

use Google\Service\Texttospeech\Resource\Voices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InforTour extends Model
{
    use HasFactory;
    protected $table = 'infor_tours';
    protected $fillable = ['id','id_priority', 'title', 'description_en','description_vn', 'tour_id', 'created_at', 'updated_at'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->orderBy('id_priority', 'asc')->orderBy('id', 'asc');
    }
    public function voices()
    {
        return $this->hasMany(VoiceContent::class, 'infor_id');
    }
    public function voice()
    {
        return $this->hasOne(VoiceContent::class, 'infor_id')->where('state',1)->latest();
    }
    public function voice_active()
    {
        return $this->voice();
    }


}
