<x-app-layout>
    <div class="px-8 py-10 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Funded Scholarships</h1>
                <p class="text-gray-500 mt-1">Track your funded scholarships and student responses</p>
            </div>
            <a href="{{ route('donator.applications.index') }}" class="text-sm text-gray-600 hover:text-gray-900 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Applications
            </a>
        </div>

        @if($applications->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Scholarship</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Student Response</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Responded On</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($applications as $application)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white text-sm font-semibold">
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
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    ${{ number_format($application->awarded_amount, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($application->student_response === 'accept')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            ✓ Accepted
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                            ✗ Declined
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $application->student_responded_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $applications->links() }}
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border p-12 text-center">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Funded Scholarships Yet</h3>
                <p class="text-gray-500">You haven't funded any scholarships that have been responded to by students.</p>
            </div>
        @endif
    </div>
</x-app-layout>