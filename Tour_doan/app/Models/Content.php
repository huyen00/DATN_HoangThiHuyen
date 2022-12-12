<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $table = 'contents';
    protected $fillable = ['id', 'name', 'video', 'description_en','description_vn' ,'image', 'image', 'link', 'hotspot_id', 'created_at', 'updated_at'];

    public function hotspot()
    {
        return $this->belongsTo(HotsPot::class, 'hotspot_id');
    }

    public function voices()
    {
        return $this->hasMany(VoiceContent::class, 'content_id');
    }
}
