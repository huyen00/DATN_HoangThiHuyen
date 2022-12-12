<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = $request->input('lang');
        if($lang){
            if(!array_key_exists($lang,config('app.locales'))){
                $lang = 'vn';
            };
            $request->session()->put('lang', $lang);
            App::setLocale($lang);

        } else {
            $lang = $request->session()->get('lang');
            if(!array_key_exists($lang,config('app.locales'))){
                $request->session()->put('lang', $lang);
                $lang = 'vn';
            };
            App::setLocale($lang);
        }
        View::share('lang',$lang);
        $response = $next($request);
        $response->headers->set('X-Frame-Options', '*', false);
        return $response;
    }
}
