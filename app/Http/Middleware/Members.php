<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Members
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(Request $request)
    {
        $this->category = $request->segment(2);
    }
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('Members')->check()){
            return $next($request);
        }
        return redirect(Session('lang')."/login?redirect=".$request->fullUrl());
    }
}
