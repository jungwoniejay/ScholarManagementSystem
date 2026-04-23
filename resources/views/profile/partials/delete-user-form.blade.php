<section class="space-y-4">
    <p class="text-sm" style="color:rgba(255,255,255,0.4);">
        Once your account is deleted, all of its resources and data will be permanently deleted.
        Please download any data you wish to retain before proceeding.
    </p>

    <button type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            style="background:rgba(248,113,113,0.15);color:#F87171;border:1px solid rgba(248,113,113,0.3);border-radius:8px;padding:0.6rem 1.5rem;font-size:0.875rem;font-weight:700;cursor:pointer;transition:background 0.2s;"
            onmouseover="this.style.background='rgba(248,113,113,0.25)'"
            onmouseout="this.style.background='rgba(248,113,113,0.15)'">
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6"
              style="background:#0F2044;">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-white mb-2">Are you sure?</h2>
            <p class="text-sm mb-5" style="color:rgba(255,255,255,0.5);">
                Once your account is deleted, all of its resources and data will be permanently deleted.
                Please enter your password to confirm.
            </p>

            <div class="mb-5">
                <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5 sr-only" style="color:rgba(255,255,255,0.4);">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password"
                       style="width:100%;max-width:400px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.65rem 0.9rem;color:#fff;font-size:0.9rem;outline:none;"
                       onfocus="this.style.borderColor='rgba(248,113,113,0.5)'"
                       onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1.5" />
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                        style="background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.6);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.6rem 1.25rem;font-size:0.875rem;font-weight:600;cursor:pointer;">
                    Cancel
                </button>
                <button type="submit"
                        style="background:rgba(248,113,113,0.2);color:#F87171;border:1px solid rgba(248,113,113,0.3);border-radius:8px;padding:0.6rem 1.25rem;font-size:0.875rem;font-weight:700;cursor:pointer;"
                        onmouseover="this.style.background='rgba(248,113,113,0.35)'"
                        onmouseout="this.style.background='rgba(248,113,113,0.2)'">
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>
</section>
