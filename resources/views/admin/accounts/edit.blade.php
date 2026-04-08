<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Edit Admin Account</h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <a href="{{ route('admin.accounts.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Accounts
        </a>

        <div class="rounded-2xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-xl font-bold mb-4" style="color:#e2e8f0;">Edit Admin Account</h1>
            <form method="POST" action="{{ route('admin.accounts.update', $account->id) }}" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $account->full_name) }}" required
                           class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">
                    @error('full_name')<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Role</label>
                    <input type="text" name="role" value="{{ old('role', $account->role) }}" required
                           class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">
                    @error('role')<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $account->email) }}" required
                           class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">
                    @error('email')<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Contact Number</label>
                    <input type="text" name="contact_number" value="{{ old('contact_number', $account->contact_number) }}"
                           class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">
                        New Password <span style="color:#4b5563;font-weight:400;">(leave blank to keep current)</span>
                    </label>
                    <input type="password" name="password"
                           class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">
                    @error('password')<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Save Changes</button>
                    <a href="{{ route('admin.accounts.index') }}" class="px-5 py-2.5 text-sm font-medium rounded-xl transition"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
