<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends BaseRepository
{


    protected function model()
    {
        return new Tag();
    }

    public function get()
    {
        return $this->model()->get();
    }
}
