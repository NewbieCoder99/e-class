<?php

namespace App\Http\Middleware;

use Closure;

class IsInstalled
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
        if(env('IS_INSTALLED') != 0)
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('installer');
        }
    }
}
