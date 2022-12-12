<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;
    protected $table = 'page_contents';
    protected $fillable = ['id', 'id_priority', 'title', 'description', 'page_id', 'created_at', 'updated_at'];


    public function page_contentable()
    {
        return $this->morphTo();
    }

    public function languages()
    {
        return $this->morphMany(Language::class, 'languageable');
    }
    public function images()
    {
        return $this->hasMany(Picture::class, 'page_content_id')->orderBy('id_priority', 'asc')->orderBy('id', 'asc');
    }
}
