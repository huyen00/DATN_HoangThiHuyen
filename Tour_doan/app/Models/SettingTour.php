<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTour extends Model
{
    use HasFactory;
    protected $table = 'setting_tours';
    protected $fillable = ['id', 'thumb', 'logo', 'favicon','description', 'tour_id', 'created_at', 'updated_at'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
