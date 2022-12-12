<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotsPot extends Model
{
    use HasFactory;
    protected $table = 'hots_pots';
    protected $fillable = ['id', 'name','html', 'ath', 'atv','style', 'distorted',
    'x' ,'y','z','renderer','scale','alpha','onload','onloaded','onhover','onclick','linkedscene',
    'zoom','url', 'pano_id', 'category_hotspot_id', 'icon_id','created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();
    }
    public function pano()
    {
        return $this->belongsTo(Pano::class, 'pano_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryHotspot::class, 'category_hotspot_id');
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'hotspot_id');
    }
    public function icon()
    {
        return $this->belongsTo(IconTour::class, 'icon_id');
    }
}
