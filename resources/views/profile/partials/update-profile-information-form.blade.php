<section>
    <p class="text-sm mb-5" style="color:rgba(255,255,255,0.4);">Update your account's profile information and email address.</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color:rgba(255,255,255,0.4);">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.65rem 0.9rem;color:#fff;font-size:0.9rem;outline:none;"
                   onfocus="this.style.borderColor='rgba(255,215,0,0.5)'"
                   onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
            <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color:rgba(255,255,255,0.4);">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.65rem 0.9rem;color:#fff;font-size:0.9rem;outline:none;"
                   onfocus="this.style.borderColor='rgba(255,215,0,0.5)'"
                   onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
            <x-input-error class="mt-1.5" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 rounded-lg text-sm" style="background:rgba(251,191,36,0.1);border:1px solid rgba(251,191,36,0.2);color:#FBBF24;">
                    Your email address is unverified.
                    <button form="send-verification" class="underline ml-1 font-semibold">Re-send verification email</button>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm" style="color:#4ADE80;">A new verification link has been sent to your email address.</p>
                @endif
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;font-weight:700;border:none;border-radius:8px;padding:0.6rem 1.5rem;font-size:0.875rem;cursor:pointer;">
                Save Changes
            </button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm" style="color:#4ADE80;">Saved.</p>
            @endif
        </div>
    </form>
</section>
