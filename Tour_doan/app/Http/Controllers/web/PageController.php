<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;
class PageController extends Controller
{
    //
    public function index(){
        $pages = DB::select('SELECT * FROM pages');
        return Inertia::render('web/page',compact('pages'));
        // return view('Pages.web.page', compact('page'));
    }
    public function postAdd(Request $request){
        // $request->validate([

        // ])
    }
    
}
