<?php

namespace App\Http\Middleware;

use Closure;
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
        if (!$request->user)
            throw new UnauthorizedException();

        if ($request->user()->level==0)
            throw new UnauthorizedException();

            return $next($request);


    }
}
