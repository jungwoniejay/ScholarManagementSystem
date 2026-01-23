<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Example: check if authenticated user has 'admin' role
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized'); // or redirect()->route('dashboard');
        }

        return $next($request);
    }
}
