<x-student-layout>
    <div class="px-8 py-10 max-w-6xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Scholarship Awards</h1>
            <p class="text-gray-500 mt-1">Review and respond to your scholarship awards</p>
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

        <!-- Awaiting Your Response -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Awaiting Your Response
            </h2>

            @if($awardedApplications->count() > 0)
                <div class="grid gap-4">
                    @foreach($awardedApplications as $application)
                        <div class="bg-white rounded-xl shadow-sm border p-6">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $application->scholarship->name }}</h3>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            Approved by Donor
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-500">Amount:</span>
                                            <span class="font-semibold text-gray-900 ml-1">${{ number_format($application->awarded_amount, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Donor:</span>
                                            <span class="font-medium text-gray-900 ml-1">{{ $application->donator->organization_name ?? 'Anonymous' }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Approved:</span>
                                            <span class="font-medium text-gray-900 ml-1">{{ $application->donor_reviewed_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    @if($application->donor_remarks)
                                        <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                            <p class="text-sm text-gray-600"><strong>Donor's Message:</strong> {{ $application->donor_remarks }}</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="ml-4 flex flex-col gap-2">
                                    <form action="{{ route('student.scholarships.respond', $application) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="response" value="accept">
                                        <button type="submit" class="w-full bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-700 transition-colors text-sm">
                                            ✓ Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('student.scholarships.respond', $application) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="response" value="decline">
                                        <button type="submit" class="w-full bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors text-sm">
                                            ✗ Decline
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border p-8 text-center">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-gray-500">No scholarship awards awaiting your response.</p>
                </div>
            @endif
        </div>

        <!-- Your Responses -->
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                Your Responses
            </h2>

            @if($respondedApplications->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Scholarship</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Your Response</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Responded On</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($respondedApplications as $application)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $application->scholarship->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $application->donator->organization_name ?? 'Anonymous' }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">${{ number_format($application->awarded_amount, 2) }}</td>
                                    <td class="px-6 py-4">
                                        @if($application->student_response === 'accept')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Accepted</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Declined</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $application->student_responded_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border p-8 text-center">
                    <p class="text-gray-500">No responses recorded yet.</p>
                </div>
            @endif
        </div>
    </div>
</x-student-layout>
