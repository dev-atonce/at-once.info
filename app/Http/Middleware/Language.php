<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {
        $availableLangs = ['en', 'th', 'jp', 'zh'];

        $uriLang = $request->segment(1);

        if (in_array($uriLang, $availableLangs)) {
            Session::put('lang', $uriLang);
            App::setLocale($uriLang);
        } else {
            $sessionLang = Session::get('lang', 'th');
            App::setLocale($sessionLang);
        }

        return $next($request);
    }
    public function setLang($lang)
    {
        $availableLangs = ['th', 'en', 'jp', 'zh'];
        if (in_array($lang, $availableLangs)) {
            session()->put('lang', $lang);
            App::setLocale($lang);
        }
        return redirect()->back();
    }
}
