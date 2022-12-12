<?php

namespace App\Http\Controllers;

use App\Models\CategoryNew;
use App\Models\Language;
use App\Models\News;
use App\Models\Page;
use App\Models\PageContent;
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

    public function chitiet_tintuc(Request $request, $slug)
    {
        $page = Page::with(['sections.page_contents.images',  'sections.theme','sections'=>function($q){
            $q->where('active',1);
        }])->findOrFail(1);
        $number_all = News::count();
        $theloais = CategoryNew::withCount('news')->get();

        $language = Language::where('en', $slug)->orWhere('vn', $slug)->first();
        if ($language) {
            $tintuc = News::with('category', 'tags')->findOrFail($language->languageable->id);

            $tintuc_lienquan =  News::with('category', 'tags')->where('category_id', $tintuc->category->id)->where('title', '!=', $tintuc->title)->take(3)->get();
            if ($tintuc) {
                return view('landingpage.new_detail', compact('tintuc', 'tintuc_lienquan', 'number_all', 'theloais'));
            }
        } else {
            return view('landingpage.not-found');
        }
    }

    public function post_detail(Request $request, $slug)
    {
        $page = Page::with(['sections.page_contents.images',  'sections.theme','sections'=>function($q){
            $q->where('active',1);
        }])->findOrFail(1);


        $language = Language::where('en', $slug)->orWhere('vn', $slug)->first();
        if ($language) {
            $content = PageContent::findOrFail($language->languageable->id);

            $content_lienquan =  PageContent::where('title', '!=', $content->title)->take(3)->get();
            if ($content) {
                return view('landingpage.post_detail', compact('content', 'content_lienquan'));
            }
        } else {
            return view('landingpage.not-found');
        }
    }

    public function tintuc(){
        $news =  News::with('category', 'tags')->take(5)->get();
        $outstanding_news = News::with('category', 'tags')->where('outstanding',1)->take(4)->get();
        return view('landingpage.tintuc',compact('news','outstanding_news'));
    }
}
