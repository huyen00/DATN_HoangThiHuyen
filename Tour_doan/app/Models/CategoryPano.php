<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tour;
class CategoryPano extends Model
{
    use HasFactory;
    protected $table = 'category_panos';
    protected $fillable = ['id', 'name', 'tour_id', 'id_priority', 'created_at', 'updated_at'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
    public function panos()
    {
        return $this->hasMany(Pano::class, 'category_pano_id');
    }
}
