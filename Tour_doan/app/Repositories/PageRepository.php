<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository extends BaseRepository implements GeneralInterface
{

    protected function model()
    {
        return new Page;
    }

    public function get()
    {
        return  $this->model()->with('languages')->orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();
    }

 

    public function priority($data)
    {
        for ($i = 0; $i < count($data); $i++) {
            $this->model()->find($data[$i]['id'])->update(['id_priority' => $i]);
        }
    }
}
