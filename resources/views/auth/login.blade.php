<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Demo Credentials Banner -->
    <div class="mb-5 p-3 rounded-xl" style="background:linear-gradient(135deg,rgba(255,215,0,0.08),rgba(184,134,11,0.08));border:1px solid rgba(255,215,0,0.25);">
        <div class="flex items-start gap-2.5">
            <span style="font-size:1rem;">🔑</span>
            <div style="flex:1;font-size:0.72rem;">
                <p style="color:#B8860B;font-weight:600;margin-bottom:0.35rem;">Demo Credentials</p>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.5rem;">
                    <div>
                        <div style="color:#8b949e;">Admin:</div>
                        <div style="color:#B8860B;font-weight:600;">admin@scholarhub.com</div>
                        <div style="color:#B8860B;font-weight:600;">admin123</div>
                    </div>
                    <div>
                        <div style="color:#8b949e;">Donor:</div>
                        <div style="color:#B8860B;font-weight:600;">donor@scholarhub.com</div>
                        <div style="color:#B8860B;font-weight:600;">donor123</div>
                    </div>
                </div>
                <a href="/credentials" style="color:#B8860B;margin-top:0.35rem;display:inline-block;text-decoration:underline;">View all credentials →</a>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Welcome back</h2>
        <p class="text-sm text-slate-500 mt-1">Sign in to your ScholarHub account</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 shadow-sm"
                    style="accent-color:#B8860B;"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm font-medium" style="color:#B8860B;"
                   onmouseover="this.style.color='#FFD700'" onmouseout="this.style.color='#B8860B'"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit"
                class="w-full flex justify-center items-center px-4 py-3 font-semibold rounded-xl focus:outline-none transition-all duration-200"
                style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;box-shadow:0 4px 15px rgba(255,215,0,0.4);">
                {{ __('Sign In') }}
            </button>
        </div>

        @if (Route::has('register'))
        <div class="mt-5 text-center">
            <p class="text-sm text-slate-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold" style="color:#B8860B;"
                   onmouseover="this.style.color='#FFD700'" onmouseout="this.style.color='#B8860B'">
                    Create one free
                </a>
            </p>
        </div>
        @endif
    </form>
</x-guest-layout>
