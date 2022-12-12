<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingDisplay extends Model
{
    use HasFactory;
    protected $table = 'setting_displays';
    protected $fillable = ['id', 'sound', 'share','back_scene', 'fullscreen', 'infor', 'setting_map','rotate', 'guide', 'show_hotspot', 'setting_vr', 'contact', 'tour_id', 'created_at', 'updated_at'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
