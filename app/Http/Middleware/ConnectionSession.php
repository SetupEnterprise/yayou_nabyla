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
            return redirect()->route('login');
        }
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Store the session data...
    }
}
