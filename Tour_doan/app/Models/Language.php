<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table = 'languages';
    protected $fillable = ['id', 'key', 'en', 'vn', 'created_at', 'updated_at'];
    public function languageable()
    {
        return $this->morphTo();
    }
}
