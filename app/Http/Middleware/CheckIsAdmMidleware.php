<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIsAdmMidleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('PARPS')['profileType'] >= 1) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
