<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class PreventLoggedInAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            if (Auth::user()->user_type === 'admin') {
                return redirect()->route('admin.dashboard'); // Admin dashboard route
            }

            return redirect()->route('patient.dashboard'); // Patient dashboard route
        }
        return $next($request);
    }
}


