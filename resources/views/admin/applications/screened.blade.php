<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Screened Applications</h2>
    </x-slot>
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Scholarship</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Verification Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Review Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications ?? [] as $app)
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">#{{ $app->id }}</td>
                            <td class="px-6 py-4 text-sm font-semibold" style="color:#e2e8f0;">{{ $app->student->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $app->scholarship->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background:rgba(96,165,250,0.15);color:#60a5fa;">
                                    Screened
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $app->review_date ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.applications.show', $app->id) }}"
                                   class="px-3 py-1 text-xs font-semibold rounded"
                                   style="background:rgba(96,165,250,0.15);color:#60a5fa;">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-sm" style="color:#8b949e;">No screened applications.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($applications->hasPages())
            <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">{{ $applications->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
