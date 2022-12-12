<?php

namespace App\Models;

use App\Models\HotsPot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pano extends Model
{
    use HasFactory;
    protected $table = 'panos';
    protected $fillable = ['id', 'name', 'thumb_img', 'id_thumb','path_onstart', 'tour_id', 'id_priority', 'category_pano_id', 'created_at', 'updated_at'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
    public function category_pano()
    {
        return $this->belongsTo(CategoryPano::class, 'category_pano_id');
    }

    public function hotspots()
    {
        return $this->hasMany(HotsPot::class, 'pano_id');
    }

}
