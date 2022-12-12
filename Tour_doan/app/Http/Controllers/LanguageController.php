<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use App\Http\Requests\LanguageRequest;

class LanguageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:users-manager', ['only' => ['index', 'store', 'update', 'delete']]);
    }
    public function index(Request $reuquest){
        $locale = App::getLocale();
    
        $current_language =config('app.locales')[$locale];
        $datas= translations(
            resource_path('lang/' . $locale . '.json')
        );
        if(count($datas) ==0){
            $languages=[];
        }
        else{
            foreach($datas as $key=> $language){
                $languages[$key]= $language;
            }
        }
     
        return Inertia::render('Language/Index', compact('current_language','languages'));
    }

    public function update(LanguageRequest $request){
        
        $locale = $request->locale;
        $languages= translations(
            resource_path('lang/' . $locale . '.json')
        );
        $languages[$request->key] = $request->language;
        $newJsonString = json_encode($languages, JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/'.$locale .'.json'), stripslashes($newJsonString));  
        return back()->with('success', 'Update successfully');

    }
}
