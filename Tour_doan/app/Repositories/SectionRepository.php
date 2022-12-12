<?php 
namespace App\Repositories;

use App\Models\Section;

class SectionRepository extends BaseRepository{


    protected function model(){
        return new Section();
    }


    public function findOnebySlug($slug){
        return $this->model()->with('page_contents.languages', 'page', 'theme', 'theme', 'languages')->where('title', $slug)->first();
    }


    
}