<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\Flysystem\File;
class Tour extends Model
{
    use HasFactory;
    use \Bkwld\Cloner\Cloneable;
    protected $table = 'tours';
    protected $fillable = ['id', 'name', 'code', 'path', 'real_path', 'template_id', 'created_at', 'updated_at'];
    protected $cloneable_relations = ['setting_tour','setting_display','panos', 'setting_color','category_panos','map', 'font','infors','icons'];
    public function setting_tour()
    {
        return $this->hasOne(SettingTour::class, 'tour_id');
    }

    public function setting_color()
    {
        return $this->hasOne(SettingColor::class, 'tour_id');
    }
    public function setting_display()
    {
        return $this->hasOne(SettingDisplay::class, 'tour_id');
    }
    public function map()
    {
        return $this->hasOne(Map::class, 'tour_id');
    }
    public function font()
    {
        return $this->hasOne(TourFont::class, 'tour_id');
    }
    public function panos()
    {
        return $this->hasMany(Pano::class, 'tour_id')->orderBy('id_priority', 'asc')->orderBy('id', 'asc');
    }

    public function infors()
    {
        return $this->hasMany(InforTour::class, 'tour_id')->orderBy('id_priority', 'asc')->orderBy('id', 'asc');
    }
    public function icons()
    {
        return $this->hasMany(IconTour::class, 'tour_id');
    }
    public function category_panos()
    {
        return $this->hasMany(CategoryPano::class, 'tour_id')->orderBy('id_priority', 'asc')->orderBy('id', 'asc');
    }
    public function exists()
    {
        return file_exists($this->path());
    }

    public function template(){
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function sounds(){
        return $this->hasMany(Sound::class, 'tour_id')->orderBy('id_priority', 'asc')->orderBy('id', 'asc');
    }
}
