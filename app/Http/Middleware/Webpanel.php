<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class Webpanel
{
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            
            $language = Session::get('lang'); 
            if (!$language) {
                Session::put('lang', 'th'); 
                App::setLocale('th');
            }

            $expiresAt = now()->addMinutes(3); /* keep online for 3 min */
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
            /* last seen */
            \App\Models\UsersMd::where('id', Auth::user()->id)->update(['last_seen' => now()]);

            return $next($request);
        }
        return redirect('webpanel/login?redirect='.$request->fullUrl());
    }
}