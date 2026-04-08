<x-app-layout>
    <div class="px-8 py-10 max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">My Applications</h1>
            <p class="text-gray-500">Track the status of all your scholarship applications</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Status Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-sm border p-4">
                <div class="text-sm text-gray-500 mb-1">Total Applications</div>
                <div class="text-2xl font-bold text-gray-900">{{ $applications->total() }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border p-4">
                <div class="text-sm text-gray-500 mb-1">Pending</div>
                <div class="text-2xl font-bold text-blue-600">{{ $groupedApplications['pending']->count() }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border p-4">
                <div class="text-sm text-gray-500 mb-1">Shortlisted</div>
                <div class="text-2xl font-bold text-yellow-600">{{ $groupedApplications['shortlisted']->count() }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border p-4">
                <div class="text-sm text-gray-500 mb-1">Awaiting Response</div>
                <div class="text-2xl font-bold text-green-600">{{ $groupedApplications['awaiting_response']->count() }}</div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border p-4">
                <div class="text-sm text-gray-500 mb-1">Accepted</div>
                <div class="text-2xl font-bold text-purple-600">{{ $groupedApplications['accepted']->count() }}</div>
            </div>
        </div>

        @if($applications->count() > 0)
            <!-- All Applications Table -->
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Application History</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Scholarship</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Applied Date</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Donor Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Your Response</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($applications as $application)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $application->scholarship->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $application->scholarship->academic_year }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-gray-900">${{ number_format($application->awarded_amount ?? $application->scholarship->amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $application->applied_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-blue-100 text-blue-800',
                                                'review' => 'bg-blue-100 text-blue-800',
                                                'shortlisted' => 'bg-yellow-100 text-yellow-800',
                                                'completed' => 'bg-green-100 text-green-800',
                                                'declined' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusLabels = [
                                                'pending' => 'Pending',
                                                'review' => 'Under Review',
                                                'shortlisted' => 'Shortlisted',
                                                'completed' => 'Completed',
                                                'declined' => 'Declined',
                                            ];
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$application->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $statusLabels[$application->status] ?? ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $donorStatusClasses = [
                                                'pending' => 'bg-gray-100 text-gray-800',
                                                'approved' => 'bg-green-100 text-green-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                            ];
                                            $donorStatusLabels = [
                                                'pending' => 'Pending',
                                                'approved' => 'Approved',
                                                'rejected' => 'Rejected',
                                            ];
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $donorStatusClasses[$application->donor_status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $donorStatusLabels[$application->donor_status] ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($application->student_response === 'accept')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Accepted</span>
                                        @elseif($application->student_response === 'decline')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">Declined</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('student.scholarships.show', $application->scholarship) }}" 
                                           class="text-purple-600 hover:text-purple-800 font-medium">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $applications->links() }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm border p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Applications Yet</h3>
                <p class="text-gray-500 mb-6">You haven't submitted any scholarship applications. Browse available scholarships to get started!</p>
                <a href="{{ route('student.scholarships.index') }}" class="inline-flex items-center bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-2 px-6 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Browse Scholarships
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
