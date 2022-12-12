<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryHotspot extends Model
{
    use HasFactory;
    protected $table = 'category_hotspots';
    protected $fillable = ['id', 'name','description', 'active', 'created_at', 'updated_at'];

    // public function hotspots()
    // {
    //     return $this->hasMany(::class, 'category_pano_id');
    // }

}
