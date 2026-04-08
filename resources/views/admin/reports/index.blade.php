<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">System Logs & Reports</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <div>
            <h1 class="text-2xl font-bold" style="color:#e2e8f0;">System Logs & Reports</h1>
            <p class="text-sm" style="color:#8b949e;">View all system activity and event logs</p>
        </div>

        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Log Type</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Related ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">User ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $log->id }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full font-mono"
                                      style="background:rgba(96,165,250,0.15);color:#60a5fa;">
                                    {{ $log->log_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $log->related_id ?? '—' }}</td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $log->user_id ?? '—' }}</td>
                            <td class="px-6 py-4 text-sm max-w-xs truncate" style="color:#e2e8f0;">{{ $log->description ?? '—' }}</td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $log->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm" style="color:#8b949e;">No system logs found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">{{ $logs->links() }}</div>
        </div>
    </div>
</x-app-layout>
