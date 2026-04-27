<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Services\ActivityMonitor;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
        } catch (\Exception $e) {
            // Log failed login attempt
            try {
                $user = \App\Models\User::where('email', $request->email)->first();
                if ($user) {
                    app(ActivityMonitor::class)->logLogin($user, false);
                }
            } catch (\Exception) {}
            throw $e;
        }

        $request->session()->regenerate();
        $user = Auth::user();

        try {
            app(ActivityMonitor::class)->logLogin($user, true);
        } catch (\Exception) {}

        if ($user->role === 'donator') {
            return redirect()->route('donator.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        try {
            app(ActivityMonitor::class)->logLogout(Auth::user());
        } catch (\Exception) {}

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
