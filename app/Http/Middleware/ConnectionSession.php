<?php

namespace App\Http\Middleware;

use Closure;

class ConnectionSession
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
        if(!session()->get('user')){
            return redirect('layouts/gerant_login');
        }
        return $next($request);
    }
}
