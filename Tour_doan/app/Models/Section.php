<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $fillable = ['id', 'title', 'sub_title', 'description', 'active', 'id_priority', 'page_id', 'theme_id', 'created_at', 'updated_at'];

    public function page_contents()
    {
        return $this->morphMany(PageContent::class, 'page_contentable')->orderBy('id_priority', 'asc')->orderBy('id', 'asc');;
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function languages()
    {
        return $this->morphMany(Language::class, 'languageable');
    }
}
