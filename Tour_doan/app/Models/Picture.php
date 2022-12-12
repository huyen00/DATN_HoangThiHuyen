<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $table = 'pictures';
    protected $fillable = ['id', 'id_priority', 'name', 'embed', 'element', 'image', 'page_content_id', 'created_at', 'updated_at'];
    public function content()
    {
        return $this->belongsTo(PageContent::class);
    }
}
