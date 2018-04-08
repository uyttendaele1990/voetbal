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
        // redirect na succesvolle login 
        switch ($guard) {
            // admin side
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect('admin/home');
                }
                break;
            // userside
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }
        

        return $next($request);
    }
}
