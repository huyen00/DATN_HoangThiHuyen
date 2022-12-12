<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNew extends Model
{
    use HasFactory;

    protected $table = "category_news";
    protected $fillable = [
        "id",
        "name",
        "slug",
        "created_at",
        "updated_at"
    ];


    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }
}
