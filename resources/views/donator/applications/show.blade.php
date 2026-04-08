<x-app-layout>
    <div class="px-8 py-10 max-w-5xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <a href="{{ route('donator.applications.index') }}" class="text-sm text-gray-600 hover:text-gray-900 flex items-center mb-2">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Applications
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Application Review</h1>
            </div>
            <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $application->donor_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($application->donor_status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                {{ ucfirst($application->donor_status ?? 'Pending') }}
            </span>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Student Information -->
                <div class="bg-white rounded-xl shadow-sm border p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Student Information
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm text-gray-500">Name</label>
                            <p class="font-medium text-gray-900">{{ $application->student->user->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Email</label>
                            <p class="font-medium text-gray-900">{{ $application->student->user->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Student ID</label>
                            <p class="font-medium text-gray-900">{{ $application->student->student_id ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Applied Date</label>
                            <p class="font-medium text-gray-900">{{ $application->applied_at->format('M d, Y') ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Scholarship Information -->
                <div class="bg-white rounded-xl shadow-sm border p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Scholarship Details
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="text-sm text-gray-500">Scholarship Name</label>
                            <p class="font-medium text-gray-900">{{ $application->scholarship->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Amount</label>
                            <p class="font-medium text-gray-900">${{ number_format($application->scholarship->amount ?? 0, 2) }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Academic Year</label>
                            <p class="font-medium text-gray-900">{{ $application->scholarship->academic_year ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- AI Score & Admin Remarks -->
                <div class="bg-white rounded-xl shadow-sm border p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        AI Evaluation & Admin Review
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm text-gray-500">AI Score</label>
                            <div class="flex items-center mt-1">
                                <span class="text-3xl font-bold {{ $application->ai_score >= 80 ? 'text-green-600' : ($application->ai_score >= 60 ? 'text-yellow-600' : 'text-gray-600') }}">
                                    {{ $application->ai_score ?? 'N/A' }}
                                </span>
                                @if($application->ai_score)
                                    <span class="ml-2 px-3 py-1 rounded-full text-xs font-semibold {{ $application->ai_score >= 80 ? 'bg-green-100 text-green-800' : ($application->ai_score >= 60 ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ $application->ai_score >= 80 ? 'Excellent' : ($application->ai_score >= 60 ? 'Good' : 'Fair') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">AI Rank</label>
                            <p class="text-3xl font-bold text-gray-900 mt-1">
                                #{{ $application->ai_rank ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm text-gray-500">Admin Remarks</label>
                            <p class="mt-1 p-3 bg-gray-50 rounded-lg text-gray-700">
                                {{ $application->remarks ?? 'No remarks provided by admin.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="bg-white rounded-xl shadow-sm border p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        Uploaded Documents
                    </h2>
                    @if($application->documents && $application->documents->count() > 0)
                        <div class="space-y-2">
                            @foreach($application->documents as $document)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <span class="font-medium text-gray-900">{{ $document->name ?? 'Document' }}</span>
                                    </div>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $document->verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $document->verified ? 'Verified' : 'Pending Verification' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No documents uploaded.</p>
                    @endif
                </div>
            </div>

            <!-- Decision Panel -->
            <div class="lg:col-span-1">
                @if($application->donor_status === 'pending')
                    <form action="{{ route('donator.applications.decision', $application) }}" method="POST" class="bg-white rounded-xl shadow-sm border p-6 sticky top-6">
                        @csrf
                        @method('PATCH')
                        
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Make Decision</h2>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Your Decision</label>
                                <select name="decision" id="decision" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                    <option value="">Select decision...</option>
                                    <option value="approved">Approve & Fund</option>
                                    <option value="rejected">Reject</option>
                                </select>
                            </div>

                            <div id="awarded_amount_field" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Awarded Amount ($)</label>
                                <input type="number" name="awarded_amount" id="awarded_amount" step="0.01" min="0" 
                                       value="{{ $application->scholarship->amount ?? 0 }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <p class="text-xs text-gray-500 mt-1">Scholarship amount: ${{ number_format($application->scholarship->amount ?? 0, 2) }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Remarks (Optional)</label>
                                <textarea name="remarks" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Add your remarks for the student..."></textarea>
                            </div>

                            <div class="pt-4 border-t border-gray-200">
                                <button type="submit" class="w-full bg-emerald-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                                    Submit Decision
                                </button>
                            </div>

                            <p class="text-xs text-gray-500 text-center">
                                The student will be notified of your decision immediately.
                            </p>
                        </div>
                    </form>
                @else
                    <div class="bg-white rounded-xl shadow-sm border p-6 sticky top-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Decision Status</h2>
                        
                        <div class="text-center py-4">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full {{ $application->donor_status === 'approved' ? 'bg-green-100' : 'bg-red-100' }} mb-3">
                                <svg class="w-8 h-8 {{ $application->donor_status === 'approved' ? 'text-green-600' : 'text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($application->donor_status === 'approved')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    @endif
                                </svg>
                            </div>
                            <p class="text-lg font-semibold {{ $application->donor_status === 'approved' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($application->donor_status) }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                Reviewed on {{ $application->donor_reviewed_at->format('M d, Y') }}
                            </p>
                        </div>

                        @if($application->donor_remarks)
                            <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-600">{{ $application->donor_remarks }}</p>
                            </div>
                        @endif

                        @if($application->donor_status === 'approved')
                            <div class="mt-4 p-3 bg-emerald-50 rounded-lg border border-emerald-200">
                                <p class="text-sm text-emerald-800 font-medium">Awarded Amount</p>
                                <p class="text-2xl font-bold text-emerald-600">${{ number_format($application->awarded_amount, 2) }}</p>
                            </div>

                            @if($application->student_response)
                                <div class="mt-4 p-3 {{ $application->student_response === 'accept' ? 'bg-green-50 border border-green-200' : 'bg-gray-50 border border-gray-200' }} rounded-lg">
                                    <p class="text-sm text-gray-600">Student Response</p>
                                    <p class="text-lg font-semibold {{ $application->student_response === 'accept' ? 'text-green-600' : 'text-gray-600' }}">
                                        {{ ucfirst($application->student_response) }}
                                    </p>
                                </div>
                            @else
                                <div class="mt-4 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                                    <p class="text-sm text-yellow-800">Awaiting student response...</p>
                                </div>
                            @endif
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('decision').addEventListener('change', function() {
            const amountField = document.getElementById('awarded_amount_field');
            if (this.value === 'approved') {
                amountField.classList.remove('hidden');
            } else {
                amountField.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>