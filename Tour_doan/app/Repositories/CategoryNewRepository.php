<?php

namespace App\Repositories;

use App\Models\CategoryNew;


class CategoryNewRepository extends BaseRepository
{

    protected function model()
    {
        return new CategoryNew();
    }

    public function get()
    {
        return  $this->model()->get();
    }
}
