<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IconTour extends Model
{
    use HasFactory;

    protected $table = 'icon_tours';
    protected $fillable = ['id', 'name', 'icon', 'tour_id', 'created_at', 'updated_at'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
