<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            return back();
        }
        return $next($request);
        // return $next($request);
    }
}
