<section>
    <p class="text-sm mb-5" style="color:rgba(255,255,255,0.4);">Ensure your account is using a long, random password to stay secure.</p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        @foreach([
            ['id'=>'update_password_current_password','name'=>'current_password','label'=>'Current Password','autocomplete'=>'current-password'],
            ['id'=>'update_password_password','name'=>'password','label'=>'New Password','autocomplete'=>'new-password'],
            ['id'=>'update_password_password_confirmation','name'=>'password_confirmation','label'=>'Confirm Password','autocomplete'=>'new-password'],
        ] as $field)
        <div>
            <label for="{{ $field['id'] }}" class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color:rgba(255,255,255,0.4);">{{ $field['label'] }}</label>
            <input id="{{ $field['id'] }}" name="{{ $field['name'] }}" type="password" autocomplete="{{ $field['autocomplete'] }}"
                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.65rem 0.9rem;color:#fff;font-size:0.9rem;outline:none;"
                   onfocus="this.style.borderColor='rgba(255,215,0,0.5)'"
                   onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
            <x-input-error :messages="$errors->updatePassword->get($field['name'])" class="mt-1.5" />
        </div>
        @endforeach

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;font-weight:700;border:none;border-radius:8px;padding:0.6rem 1.5rem;font-size:0.875rem;cursor:pointer;">
                Update Password
            </button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm" style="color:#4ADE80;">Saved.</p>
            @endif
        </div>
    </form>
</section>
