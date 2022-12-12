<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = "news";
    protected $fillable = ['id', 'title', 'slug', 'content', 'image', 'outstanding', 'view', 'category_id', 'created_at', 'updated_at'];
    public function category()
    {
        return $this->belongsTo(CategoryNew::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_new', 'new_id', 'tag_id');
    }

    public function languages()
    {
        return $this->morphMany(Language::class, 'languageable');
    }
}
