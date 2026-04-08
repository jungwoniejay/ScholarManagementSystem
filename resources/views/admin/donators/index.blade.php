<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Manage Donators</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold" style="color:#e2e8f0;">Donators</h1>
                <p class="text-sm" style="color:#8b949e;">Manage all registered donators</p>
            </div>
            <a href="{{ route('admin.donators.create') }}"
               class="px-4 py-2 text-sm font-semibold rounded-lg transition"
               style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                + Add Donator
            </a>
        </div>

        @if(session('success'))
            <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Organization</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Contact Person</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Total Fund</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Available Fund</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donators as $donator)
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <td class="px-6 py-4 text-sm font-semibold" style="color:#e2e8f0;">{{ $donator->organization_name }}</td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $donator->contact_person }}</td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $donator->email }}</td>
                            <td class="px-6 py-4 text-sm font-semibold" style="color:#4ade80;">₱{{ number_format($donator->total_fund, 2) }}</td>
                            <td class="px-6 py-4 text-sm font-semibold" style="color:#60a5fa;">₱{{ number_format($donator->available_fund, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full"
                                    style="{{ $donator->account_status == 'active' ? 'background:rgba(34,197,94,0.15);color:#4ade80;' : 'background:rgba(248,113,113,0.15);color:#f87171;' }}">
                                    {{ ucfirst($donator->account_status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.donators.show', $donator) }}"
                                       class="px-2 py-1 text-xs font-semibold rounded"
                                       style="background:rgba(96,165,250,0.15);color:#60a5fa;">View</a>
                                    <a href="{{ route('admin.donators.edit', $donator) }}"
                                       class="px-2 py-1 text-xs font-semibold rounded"
                                       style="background:rgba(251,191,36,0.15);color:#fbbf24;">Edit</a>
                                    <form method="POST" action="{{ route('admin.donators.destroy', $donator) }}" class="inline"
                                          onsubmit="return confirm('Deactivate this donator?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2 py-1 text-xs font-semibold rounded"
                                                style="background:rgba(248,113,113,0.15);color:#f87171;">Deactivate</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-sm" style="color:#8b949e;">No donators found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4" style="border-top:1px solid #1E3A8A;">{{ $donators->links() }}</div>
        </div>
    </div>
</x-app-layout>
