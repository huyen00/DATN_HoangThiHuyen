<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = ['id','id_priority', 'name', 'image','imageable_id','imageable_type', 'created_at', 'updated_at'];
    public function imageable()
    {
        return $this->morphTo();
    }
}
