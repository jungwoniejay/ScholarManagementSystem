<x-app-layout>
    <div class="px-8 py-10 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Applications for Review</h1>
                <p class="text-gray-500 mt-1">Review shortlisted applications and make funding decisions</p>
            </div>
            <a href="{{ route('donator.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-sm border p-4">
                <div class="text-sm text-gray-500 mb-1">Pending Review</div>
                <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border p-4">
                <div class="text-sm text-gray-500 mb-1">Approved</div>
                <div class="text-2xl font-bold text-green-600">{{ $stats['approved'] }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border p-4">
                <div class="text-sm text-gray-500 mb-1">Rejected</div>
                <div class="text-2xl font-bold text-red-600">{{ $stats['rejected'] }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border p-4">
                <div class="text-sm text-gray-500 mb-1">Total Applications</div>
                <div class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</div>
            </div>
        </div>

        <!-- Status Filter Tabs -->
        <div class="bg-white rounded-xl shadow-sm border mb-6 overflow-hidden">
            <div class="flex border-b border-gray-200">
                @php
                    $tabs = [
                        ['id' => 'pending', 'label' => 'Pending Review', 'count' => $stats['pending']],
                        ['id' => 'approved', 'label' => 'Approved', 'count' => $stats['approved']],
                        ['id' => 'rejected', 'label' => 'Rejected', 'count' => $stats['rejected']],
                        ['id' => 'all', 'label' => 'All Applications', 'count' => $stats['total']],
                    ];
                @endphp
                @foreach($tabs as $tab)
                    <a href="{{ route('donator.applications.index', ['status' => $tab['id']]) }}"
                       class="flex-1 px-6 py-4 text-center font-medium transition-colors {{ $status === $tab['id'] ? 'bg-emerald-50 text-emerald-700 border-b-2 border-emerald-500' : 'text-gray-600 hover:bg-gray-50' }}">
                        {{ $tab['label'] }}
                        <span class="ml-2 px-2 py-0.5 rounded-full text-xs {{ $status === $tab['id'] ? 'bg-emerald-200 text-emerald-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $tab['count'] }}
                        </span>
                    </a>
                @endforeach
            </div>

            <!-- Applications Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Scholarship</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">AI Score</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Admin Remarks</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Documents</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($applications as $application)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-semibold">
                                            {{ strtoupper(substr($application->student->user->name ?? 'S', 0, 1)) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="font-medium text-gray-900">{{ $application->student->user->name ?? 'Student' }}</div>
                                            <div class="text-sm text-gray-500">{{ $application->student->user->email ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $application->scholarship->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">${{ number_format($application->scholarship->amount ?? 0, 2) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($application->ai_score)
                                        <div class="flex items-center">
                                            <span class="font-semibold text-gray-900">{{ $application->ai_score }}</span>
                                            @if($application->ai_score >= 80)
                                                <span class="ml-2 px-2 py-0.5 rounded-full text-xs bg-green-100 text-green-800">Excellent</span>
                                            @elseif($application->ai_score >= 60)
                                                <span class="ml-2 px-2 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-800">Good</span>
                                            @else
                                                <span class="ml-2 px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-600">Fair</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs truncate text-sm text-gray-600" title="{{ $application->remarks }}">
                                        {{ $application->remarks ?? 'No remarks' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $application->documents->count() }} document(s)
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <a href="{{ route('donator.applications.show', $application) }}"
                                       class="text-emerald-600 hover:text-emerald-900 font-medium">
                                        Review →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p>No applications found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($applications->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>