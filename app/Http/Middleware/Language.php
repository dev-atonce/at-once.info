<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {

        $language = Session::get('lang'); 
        if ($language==null) {
            Session::put('lang','th'); 
            $language = Session('lang');
            App::setLocale($language);
        } else { 
            // set from url
            $uri = $request->url(); 
            $uri_lang = $request->segment(1);
            Session::put('lang',$uri_lang); 
            App::setLocale($uri_lang);
        }
        return $next($request);
    }
}