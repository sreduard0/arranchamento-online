<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIsFurrielMiddleware
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
        if (session('Arranchamento')['profileType'] == 2) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
