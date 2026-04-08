<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Admin Account Details</h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <a href="{{ route('admin.accounts.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Accounts
        </a>

        <div class="rounded-2xl p-6 space-y-4" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-xl font-bold" style="color:#FFD700;">{{ $account->full_name }}</h1>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="font-semibold" style="color:#8b949e;">Role:</span> <span style="color:#e2e8f0;">{{ $account->role }}</span></div>
                <div><span class="font-semibold" style="color:#8b949e;">Email:</span> <span style="color:#e2e8f0;">{{ $account->email }}</span></div>
                <div><span class="font-semibold" style="color:#8b949e;">Contact:</span> <span style="color:#e2e8f0;">{{ $account->contact_number ?? '—' }}</span></div>
                <div><span class="font-semibold" style="color:#8b949e;">Created:</span> <span style="color:#e2e8f0;">{{ $account->created_at->format('M d, Y') }}</span></div>
            </div>
            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin.accounts.edit', $account->id) }}"
                   class="px-5 py-2.5 text-sm font-semibold rounded-xl transition"
                   style="background:rgba(251,191,36,0.15);color:#fbbf24;border:1px solid rgba(251,191,36,0.3);">Edit</a>
                <form action="{{ route('admin.accounts.destroy', $account->id) }}" method="POST"
                      onsubmit="return confirm('Delete this account?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition"
                            style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
