<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $timeoutMinutes = config('session.lifetime', 120);
        $lastActivity   = session('last_activity_time');

        if ($lastActivity && (time() - $lastActivity) > ($timeoutMinutes * 60)) {
            Auth::logout();
            session()->flush();
            return redirect()->route('login')
                ->with('error', 'Your session has expired due to inactivity. Please log in again.');
        }

        session(['last_activity_time' => time()]);

        return $next($request);
    }
}
