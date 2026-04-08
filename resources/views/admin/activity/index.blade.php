<x-app-layout>
    <div class="px-6 py-8 max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Dashboard
                </a>
                <h1 class="text-2xl font-semibold text-gray-900">Activity Monitoring</h1>
                <p class="text-sm text-gray-500 mt-1">Track user behavior and detect anomalies</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.activity.export.csv', request()->query()) }}" class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    CSV
                </a>
                <a href="{{ route('admin.activity.export.json', request()->query()) }}" class="inline-flex items-center gap-1.5 px-3 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    JSON
                </a>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-50 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_activities'] ?? 0) }}</div>
                        <div class="text-xs text-gray-500">Total Activities</div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-red-50 rounded-lg">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-red-600">{{ number_format($stats['suspicious_count'] ?? 0) }}</div>
                        <div class="text-xs text-gray-500">Suspicious</div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-emerald-50 rounded-lg">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900">{{ number_format($stats['active_users'] ?? 0) }}</div>
                        <div class="text-xs text-gray-500">Active Users</div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-amber-50 rounded-lg">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-amber-600">{{ number_format($stats['failed_logins'] ?? 0) }}</div>
                        <div class="text-xs text-gray-500">Failed Logins</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-900">Activity Overview</h3>
                <span class="text-xs text-gray-400">Last 7 days</span>
            </div>
            <div class="h-64">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        <!-- Suspicious Alert -->
        @if(count($suspiciousActivities) > 0)
        <div class="bg-red-50 border border-red-100 rounded-xl p-4 mb-6">
            <div class="flex items-center gap-2 mb-3">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span class="text-sm font-medium text-red-800">Recent Suspicious Activities ({{ count($suspiciousActivities) }})</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach($suspiciousActivities as $activity)
                <div class="bg-white rounded-lg border border-red-100 p-3">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-800">{{ $activity->description }}</p>
                            <p class="text-xs text-red-600 mt-1">{{ $activity->suspicion_reason }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mt-2 text-xs text-gray-400">
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

        <!-- Filters Bar -->
        <div class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
            <form action="{{ route('admin.activity') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3">
                    <div class="lg:col-span-1">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search activities..." class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="lg:col-span-1">
                        <select name="user" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Users</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $userFilter == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="lg:col-span-1">
                        <select name="type" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Types</option>
                            @foreach($activityTypes as $key => $label)
                                <option value="{{ $key }}" {{ $typeFilter == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="lg:col-span-1">
                        <input type="date" name="date_from" value="{{ $dateFrom }}" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="lg:col-span-1">
                        <input type="date" name="date_to" value="{{ $dateTo }}" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                    <div class="flex items-center gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="suspicious" value="1" {{ $suspiciousOnly ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-600">Suspicious only</span>
                        </label>
                        <select name="per_page" class="px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10/page</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25/page</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50/page</option>
                            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100/page</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">Apply</button>
                        <a href="{{ route('admin.activity') }}" class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Activity Log Table -->
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-sm font-medium text-gray-900">Activity Log</h3>
                <span class="text-xs text-gray-400">{{ $activities->total() }} records</span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">User</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Description</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide hidden md:table-cell">IP Address</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide hidden lg:table-cell">Device</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Time</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wide">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($activities as $activity)
                        <tr class="hover:bg-gray-50 transition {{ $activity->is_suspicious ? 'bg-red-50/30' : '' }}">
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg {{ $activity->badge_class }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $activity->icon }}"/>
                                    </svg>
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-gray-900">{{ $activity->user?->name ?? 'System' }}</div>
                                <div class="text-xs text-gray-400">{{ Str::limit($activity->user?->email ?? 'N/A', 20) }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm text-gray-600 max-w-xs">{{ Str::limit($activity->description, 60) }}</div>
                                @if($activity->suspicion_reason)
                                    <div class="text-xs text-red-600 mt-1">{{ Str::limit($activity->suspicion_reason, 40) }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm text-gray-500 font-mono">{{ $activity->ip_address ?? '-' }}</div>
                                @if($activity->location)
                                    <div class="text-xs text-gray-400">{{ $activity->location }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 hidden lg:table-cell">
                                <div class="text-sm text-gray-500">{{ Str::limit($activity->browser ?? '-', 20) }}</div>
                                <div class="text-xs text-gray-400">{{ Str::limit($activity->device ?? '-', 20) }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm text-gray-900">{{ $activity->occurred_at->format('M d, H:i') }}</div>
                                <div class="text-xs text-gray-400">{{ $activity->human_readable_time }}</div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($activity->is_suspicious)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Suspicious</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $activity->badge_class }}">{{ ucfirst(str_replace('_', ' ', $activity->log_type)) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-gray-400 text-sm">No activities found matching your filters</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($activities->hasPages())
            <div class="px-5 py-4 border-t border-gray-200">
                {{ $activities->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Chart.js -->
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
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.05)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 0,
                    pointHoverRadius: 4,
                    pointHoverBackgroundColor: '#6366f1',
                }, {
                    label: 'Suspicious',
                    data: chartData.suspicious_data,
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.05)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 0,
                    pointHoverRadius: 4,
                    pointHoverBackgroundColor: '#ef4444',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20, boxWidth: 8 }
                    }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { stepSize: 1 } },
                    x: { grid: { display: false } }
                },
                interaction: { intersect: false, mode: 'index' }
            }
        });
    });
    </script>
</x-app-layout>