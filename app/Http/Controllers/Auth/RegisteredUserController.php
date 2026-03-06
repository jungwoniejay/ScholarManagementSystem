<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donator;
use App\Models\Student;
use App\Models\AdminAccount;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:student,donator'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Create corresponding record based on role
        if ($request->role === 'donator') {
            Donator::create([
                'user_id' => $user->id,
                'organization_name' => $request->name,
                'contact_person' => $request->name,
                'email' => $request->email,
                'contact_number' => '',
                'total_fund' => 0,
                'available_fund' => 0,
            ]);
        } elseif ($request->role === 'student') {
            Student::create([
                'user_id' => $user->id,
                'first_name' => $request->name,
                'last_name' => '',
                'email' => $request->email,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'donator') {
            return redirect()->route('donator.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
}
