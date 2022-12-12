<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'pages';
    protected $fillable = ['id', 'id_priority', 'title', 'description', 'created_at', 'updated_at'];

    public function sections()
    {
        return $this->hasMany(Section::class, 'page_id')->orderBy('id_priority', 'asc')->orderBy('id', 'asc');
    }

    public function languages()
    {
        return $this->morphMany(Language::class, 'languageable');
    }
}
