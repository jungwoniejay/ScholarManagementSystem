<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Create your account</h2>
        <p class="text-sm text-slate-500 mt-1">Join ScholarHub and start your journey</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4 grid grid-cols-2 gap-3">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label :value="__('I am registering as')" />
            <div class="mt-2 grid grid-cols-3 gap-3">
                <label class="relative flex cursor-pointer">
                    <input type="radio" name="role" value="student" checked class="sr-only peer">
                    <div class="w-full flex items-center gap-2 px-3 py-3 rounded-xl border-2 border-slate-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 transition-all text-sm font-medium text-slate-700 peer-checked:text-yellow-800">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                        </svg>
                        Student
                    </div>
                </label>
                <label class="relative flex cursor-pointer">
                    <input type="radio" name="role" value="donator" class="sr-only peer">
                    <div class="w-full flex items-center gap-2 px-3 py-3 rounded-xl border-2 border-slate-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 transition-all text-sm font-medium text-slate-700 peer-checked:text-yellow-800">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Donator
                    </div>
                </label>
                <label class="relative flex cursor-pointer">
                    <input type="radio" name="role" value="admin" class="sr-only peer">
                    <div class="w-full flex items-center gap-2 px-3 py-3 rounded-xl border-2 border-slate-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 transition-all text-sm font-medium text-slate-700 peer-checked:text-yellow-800">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Admin
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit"
                class="w-full flex justify-center items-center px-4 py-3 font-semibold rounded-xl focus:outline-none transition-all duration-200"
                style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;box-shadow:0 4px 15px rgba(255,215,0,0.4);">
                {{ __('Create Account') }}
            </button>
        </div>

        <div class="mt-5 text-center">
            <p class="text-sm text-slate-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold" style="color:#B8860B;"
                   onmouseover="this.style.color='#FFD700'" onmouseout="this.style.color='#B8860B'">
                    Sign in
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
