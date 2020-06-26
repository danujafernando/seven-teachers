<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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

        switch ($guard)
        {
            case 'admins':
                if (Auth::guard('admins')->check())
                {

                    return redirect()->route('admin.home');
                }
                break;
            case 'web':
                if (Auth::guard($guard)->check())
                {

                    return redirect()->route('home');
                }
                break;
            default:
                break;
        }
        return $next($request);
    }
}
