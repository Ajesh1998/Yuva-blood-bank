<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaticGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If user is already authenticated via static auth, redirect to dashboard
        if (Session::has('user')) {
            return redirect()->route('dashboard')->with('info', 'You are already logged in.');
        }

        return $next($request);
    }
}
