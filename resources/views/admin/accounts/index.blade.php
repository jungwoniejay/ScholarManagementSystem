<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Admin Accounts</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold" style="color:#e2e8f0;">Admin Accounts</h1>
                <p class="text-sm" style="color:#8b949e;">Manage administrator accounts</p>
            </div>
            <a href="{{ route('admin.accounts.create') }}"
               class="px-4 py-2 text-sm font-semibold rounded-lg transition"
               style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                + Add Admin
            </a>
        </div>

        @if(session('success'))
            <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <table class="min-w-full">
                <thead>
                    <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Full Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                    <tr style="border-bottom:1px solid #1E3A8A;">
                        <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $admin->id }}</td>
                        <td class="px-6 py-4 text-sm font-semibold" style="color:#e2e8f0;">{{ $admin->full_name }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:rgba(96,165,250,0.15);color:#60a5fa;">{{ $admin->role }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $admin->email }}</td>
                        <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $admin->contact_number ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.accounts.show', $admin->id) }}"
                                   class="px-2 py-1 text-xs font-semibold rounded"
                                   style="background:rgba(96,165,250,0.15);color:#60a5fa;">View</a>
                                <a href="{{ route('admin.accounts.edit', $admin->id) }}"
                                   class="px-2 py-1 text-xs font-semibold rounded"
                                   style="background:rgba(251,191,36,0.15);color:#fbbf24;">Edit</a>
                                <form action="{{ route('admin.accounts.destroy', $admin->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this account?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-2 py-1 text-xs font-semibold rounded"
                                            style="background:rgba(248,113,113,0.15);color:#f87171;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-sm" style="color:#8b949e;">No admin accounts found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4" style="border-top:1px solid #1E3A8A;">{{ $admins->links() }}</div>
        </div>
    </div>
</x-app-layout>
