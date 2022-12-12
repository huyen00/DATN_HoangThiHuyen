<?php

namespace App\Repositories;

use App\Models\News;

class NewRepository extends BaseRepository
{

    protected function model()
    {
        return new News();
    }

    public function query($request)
    {
        return  $this->model()->whereHas('languages', function ($query) use ($request) {
            $query->where('en', 'LIKE', '%' . $request->term . '%')->orwhere('vn', 'LIKE', '%' .  $request->term . '%')->orwhere('key', 'LIKE', '%' .  $request->term . '%');
        })->with(['category', 'tags', 'languages' => function ($q) use ($request) {

            $q->where('en', 'LIKE', '%' . $request->term . '%')->orwhere('vn', 'LIKE', '%' .  $request->term . '%')->orwhere('key', 'LIKE', '%' .  $request->term . '%');
        }])->paginate(5)->appends(['term' => $request->term]);
    }
}
