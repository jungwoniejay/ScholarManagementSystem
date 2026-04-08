<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Activity Monitoring</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold" style="color:#e2e8f0;">Activity Monitoring</h1>
                <p class="text-sm mt-1" style="color:#8b949e;">Track user behavior and detect anomalies</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.activity.export.csv', request()->query()) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-lg"
                   style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    CSV
                </a>
                <a href="{{ route('admin.activity.export.json', request()->query()) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-lg"
                   style="background:rgba(96,165,250,0.15);color:#60a5fa;border:1px solid rgba(96,165,250,0.3);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    JSON
                </a>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['label'=>'Total Activities','value'=>number_format($stats['total_activities'] ?? 0),'color'=>'#60a5fa'],
                ['label'=>'Suspicious','value'=>number_format($stats['suspicious_count'] ?? 0),'color'=>'#f87171'],
                ['label'=>'Active Users','value'=>number_format($stats['active_users'] ?? 0),'color'=>'#4ade80'],
                ['label'=>'Failed Logins','value'=>number_format($stats['failed_logins'] ?? 0),'color'=>'#fbbf24'],
            ] as $stat)
            <div class="p-4 rounded-xl" style="background:#0F2044;border:1px solid #1E3A8A;">
                <p class="text-xs font-semibold mb-1" style="color:#8b949e;">{{ $stat['label'] }}</p>
                <p class="text-2xl font-bold" style="color:{{ $stat['color'] }};">{{ $stat['value'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Chart --}}
        <div class="rounded-xl p-5" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold" style="color:#e2e8f0;">Activity Overview</h3>
                <span class="text-xs" style="color:#8b949e;">Last 7 days</span>
            </div>
            <div class="h-56">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        {{-- Suspicious Alert --}}
        @if(count($suspiciousActivities) > 0)
        <div class="rounded-xl p-4" style="background:rgba(248,113,113,0.08);border:1px solid rgba(248,113,113,0.25);">
            <div class="flex items-center gap-2 mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#f87171;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span class="text-sm font-semibold" style="color:#f87171;">Recent Suspicious Activities ({{ count($suspiciousActivities) }})</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach($suspiciousActivities as $activity)
                <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid rgba(248,113,113,0.2);">
                    <p class="text-sm" style="color:#e2e8f0;">{{ $activity->description }}</p>
                    <p class="text-xs mt-1" style="color:#f87171;">{{ $activity->suspicion_reason }}</p>
                    <div class="flex items-center gap-2 mt-2 text-xs" style="color:#8b949e;">
                        <span>{{ $activity->user?->name ?? 'Unknown' }}</span>
                        <span>•</span>
                        <span>{{ $activity->human_readable_time }}</span>
                        <span>•</span>
                        <span class="font-mono">{{ $activity->ip_address }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Filters --}}
        <div class="rounded-xl p-4" style="background:#0F2044;border:1px solid #1E3A8A;">
            @php $is = 'background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;padding:8px 12px;border-radius:8px;font-size:13px;width:100%;'; @endphp
            <form action="{{ route('admin.activity.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search activities..."
                           style="{{ $is }}">
                    <select name="user" style="{{ $is }}">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $userFilter == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <select name="type" style="{{ $is }}">
                        <option value="">All Types</option>
                        @foreach($activityTypes as $key => $label)
                            <option value="{{ $key }}" {{ $typeFilter == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="date_from" value="{{ $dateFrom }}" style="{{ $is }}">
                    <input type="date" name="date_to" value="{{ $dateTo }}" style="{{ $is }}">
                </div>
                <div class="flex items-center justify-between mt-3 pt-3" style="border-top:1px solid #1E3A8A;">
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="suspicious" value="1" {{ $suspiciousOnly ? 'checked' : '' }} style="accent-color:#f87171;">
                            <span class="text-sm" style="color:#8b949e;">Suspicious only</span>
                        </label>
                        <select name="per_page" style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;padding:6px 10px;border-radius:8px;font-size:13px;">
                            @foreach([10,25,50,100] as $pp)
                            <option value="{{ $pp }}" {{ $perPage == $pp ? 'selected' : '' }}>{{ $pp }}/page</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-lg"
                                style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Apply</button>
                        <a href="{{ route('admin.activity.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Activity Table --}}
        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="px-5 py-4 flex items-center justify-between" style="border-bottom:1px solid #1E3A8A;">
                <h3 class="text-sm font-semibold" style="color:#e2e8f0;">Activity Log</h3>
                <span class="text-xs" style="color:#8b949e;">{{ $activities->total() }} records</span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">User</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Description</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase hidden md:table-cell" style="color:#8b949e;">IP Address</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase hidden lg:table-cell" style="color:#8b949e;">Device</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Time</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold uppercase" style="color:#8b949e;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $activity)
                        <tr style="border-bottom:1px solid #1E3A8A;{{ $activity->is_suspicious ? 'background:rgba(248,113,113,0.05);' : '' }}">
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg {{ $activity->badge_class }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $activity->icon }}"/>
                                    </svg>
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm font-semibold" style="color:#e2e8f0;">{{ $activity->user?->name ?? 'System' }}</div>
                                <div class="text-xs" style="color:#8b949e;">{{ Str::limit($activity->user?->email ?? 'N/A', 20) }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm max-w-xs" style="color:#e2e8f0;">{{ Str::limit($activity->description, 60) }}</div>
                                @if($activity->suspicion_reason)
                                    <div class="text-xs mt-1" style="color:#f87171;">{{ Str::limit($activity->suspicion_reason, 40) }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 hidden md:table-cell">
                                <div class="text-sm font-mono" style="color:#8b949e;">{{ $activity->ip_address ?? '—' }}</div>
                                @if($activity->location)
                                    <div class="text-xs" style="color:#8b949e;">{{ $activity->location }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 hidden lg:table-cell">
                                <div class="text-sm" style="color:#8b949e;">{{ Str::limit($activity->browser ?? '—', 20) }}</div>
                                <div class="text-xs" style="color:#8b949e;">{{ Str::limit($activity->device ?? '—', 20) }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm" style="color:#e2e8f0;">{{ $activity->occurred_at->format('M d, H:i') }}</div>
                                <div class="text-xs" style="color:#8b949e;">{{ $activity->human_readable_time }}</div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($activity->is_suspicious)
                                    <span class="px-2 py-0.5 text-xs font-semibold rounded-full" style="background:rgba(248,113,113,0.15);color:#f87171;">Suspicious</span>
                                @else
                                    <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $activity->badge_class }}">{{ ucfirst(str_replace('_', ' ', $activity->log_type)) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-sm" style="color:#8b949e;">No activities found matching your filters.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($activities->hasPages())
            <div class="px-5 py-4" style="border-top:1px solid #1E3A8A;">{{ $activities->links() }}</div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('activityChart').getContext('2d');
        const chartData = @json($chartData);
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Activities',
                    data: chartData.data,
                    borderColor: '#60a5fa',
                    backgroundColor: 'rgba(96,165,250,0.08)',
                    fill: true, tension: 0.3, pointRadius: 0, pointHoverRadius: 4,
                }, {
                    label: 'Suspicious',
                    data: chartData.suspicious_data,
                    borderColor: '#f87171',
                    backgroundColor: 'rgba(248,113,113,0.08)',
                    fill: true, tension: 0.3, pointRadius: 0, pointHoverRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20, boxWidth: 8, color: '#8b949e' }
                    }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(30,58,138,0.5)' }, ticks: { stepSize: 1, color: '#8b949e' } },
                    x: { grid: { display: false }, ticks: { color: '#8b949e' } }
                },
                interaction: { intersect: false, mode: 'index' }
            }
        });
    });
    </script>
</x-app-layout>
