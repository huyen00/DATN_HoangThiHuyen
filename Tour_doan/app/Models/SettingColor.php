<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingColor extends Model
{
    use HasFactory;
    protected $table = 'setting_colors';
    protected $fillable = ['id', 'icon_color', 'bg_icon_color', 'hover_color_icon','hover_bg_icon_color','active_icon_color','active_bg_icon_color','bg_menu_color','bg_color_category','color_category','color_item','hover_color_item','active_color_item', 'tour_id', 'created_at', 'updated_at'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

}
