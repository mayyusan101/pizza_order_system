<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role == 'user'){
            return back();
        }
        return $next($request);
    }
}
