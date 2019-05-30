<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAssociate
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
        if ($request->session()->exists('associateId')) 
        {
             return $next($request);
        }
       else
       {
         return redirect('/home/login');
       }
     }
       /* if (Auth::guard($guard)->check()) {
            return redirect('/');
        }
*/
        
    }

