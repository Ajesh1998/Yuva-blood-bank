<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaticAuth
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
        if (!Session::has('user')) {
            // Return JSON response for API requests (React frontend)
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized. Please login to access this resource.'
                ], 401);
            }
            
            // For web requests, redirect to React frontend
            return redirect()->away('http://localhost:3001/login');
        }

        return $next($request);
    }
}