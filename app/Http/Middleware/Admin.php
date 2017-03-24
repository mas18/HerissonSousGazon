<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = Auth::user();

        if (!$user)
        {
            echo "pas de user";
            throw new UnauthorizedException();
        }


        if ($user->level==0)
        {
            echo "pas le leve";
            throw new UnauthorizedException();
        }

            return $next($request);


    }
}
