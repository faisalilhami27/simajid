<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "pengurus" && Auth::guard($guard)->check()) {
            return redirect('/choose/roles');
        }

        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
