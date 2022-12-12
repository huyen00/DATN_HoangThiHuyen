<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $table = 'templates';
    protected $fillable = ['id', 'name', 'image', 'link_code','link_css','responsive','link_js','created_at', 'updated_at'];

    public function tours()
    {
        return $this->hasMany(Tour::class, 'template_id');
    }
    
}
