<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
               session()->put([
            'Arranchamento' => [
                'profileType' => 2,
                'notification' =>1,
                'loginID' => 1,
            ],

            'user' => [
                'id' => 1,
                'name' => 'Eduardo Martins',
            	'photo' => 'img/img_profiles/1/img_profile_user_1-23-08-2021-15-08-17.png',
                'professionalName' => 'Eduardo',
                'email' => 'dudu.martins373@gmail.com',
                'rank' => 'Cb',
                'company' => [
                    'id' => 2,
                    'name' => 'CCSv'
                ]
            ],

            'theme' => 1,
        ]);

        $s = session('Arranchamento');
        $session = session('user');
        if ($session && $s) {
            return $next($request);
        }
        return redirect('http://sistao.3bsup.eb.mil.br');




        return $next($request);
    }
}
