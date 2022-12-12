<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourFont extends Model
{
    use HasFactory;

    protected $table = 'fonts';
    protected $fillable = ['id', 'name', 'font', 'size', 'weight', 'tour_id', 'created_at', 'updated_at'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
