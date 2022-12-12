<?php

namespace App\Repositories;

use App\Models\Theme;

class ThemeRepository extends BaseRepository
{

    protected function model()
    {
        return new Theme();
    }

    public function get()
    {
        return $this->model()->get();
    }
}
