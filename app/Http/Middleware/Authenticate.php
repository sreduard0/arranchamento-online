<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {

        $session = session('user');
        if (!$session) {
            return redirect('http://sistao.3bsup.eb.mil.br');
        }
        return $next($request);
    }
}
