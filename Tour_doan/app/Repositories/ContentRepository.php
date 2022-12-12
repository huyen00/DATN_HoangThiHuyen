<?php

use App\Models\PageContent;
use App\Repositories\BaseRepository;

class ContentRepository extends BaseRepository
{


    protected function model()
    {
        return new PageContent();
    }
}
