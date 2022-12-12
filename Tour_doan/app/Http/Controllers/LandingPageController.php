<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __invoke()
    {
    
        $page = Page::with(['sections.page_contents.images',  'sections.theme','sections'=>function($q){
            $q->where('active',1);
        }])->findOrFail(1);
        // return $page;
    
        $last_new  = News::with('languages', 'category', 'tags')->orderBy('created_at', 'desc')->take(5)->get();
     
        return view('landingpage.index', compact('page','last_new'));
    }
}
