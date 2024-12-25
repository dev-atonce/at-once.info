<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PopUp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session('lang')=='jp'){
            if(empty(Session('popup'))){
                Session::put('popup',['message'=>'Coming Soon.']);
            }else{
                Session::flash('popup',['message'=>'Coming Soon.','status'=>'past']);      
            }            
        }else{
            Session::forget('popup');
        }
        return $next($request);
        
    }
}
