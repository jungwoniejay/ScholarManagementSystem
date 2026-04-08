<x-app-layout>
    <div class="px-8 py-10 max-w-7xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Application Header -->
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                    {{ substr($application->scholarship->name ?? 'A', 0, 1) }}
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $application->scholarship->name ?? 'N/A' }}</h1>
                                    <p class="text-sm text-gray-500">Application ID: #{{ $application->id }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'review' => 'bg-blue-100 text-blue-800',
                                    'shortlisted' => 'bg-purple-100 text-purple-800',
                                    'approved' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                    'completed' => 'bg-green-100 text-green-800',
                                    'declined' => 'bg-gray-100 text-gray-800',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Key Details -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-4 border-t border-b border-gray-100">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Student</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $application->student->user->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Applied On</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $application->applied_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">AI Score</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $application->ai_score ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">AI Rank</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $application->ai_rank ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Student Information -->
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Student Information</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Full Name</p>
                            <p class="text-sm font-medium text-gray-900">{{ $application->student->user->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Email</p>
                            <p class="text-sm font-medium text-gray-900">{{ $application->student->user->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Student ID</p>
                            <p class="text-sm font-medium text-gray-900">#{{ $application->student->id ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">GPA</p>
                            <p class="text-sm font-medium text-gray-900">{{ $application->student->gpa ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Course</p>
                            <p class="text-sm font-medium text-gray-900">{{ $application->student->course ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Enrollment Year</p>
                            <p class="text-sm font-medium text-gray-900">{{ $application->student->enrollment_year ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Personal Statement -->
                @if($application->personal_statement)
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Personal Statement</h2>
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! nl2br(e($application->personal_statement)) !!}
                    </div>
                </div>
                @endif

                <!-- Documents -->
                @if($application->documents && $application->documents->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Submitted Documents</h2>
                    <div class="space-y-3">
                        @foreach($application->documents as $document)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $document->document_name ?? 'Document' }}</p>
                                    <p class="text-xs text-gray-500">Uploaded: {{ $document->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <a href="{{ $document->file_path ?? '#' }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                View
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Donor Status -->
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Donor Review Status</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Donor Status</p>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $application->donor_status === 'approved' ? 'bg-green-100 text-green-800' : ($application->donor_status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($application->donor_status ?? 'Pending') }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Awarded Amount</p>
                            <p class="text-sm font-semibold text-gray-900">${{ number_format($application->awarded_amount ?? 0, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Donor Reviewed</p>
                            <p class="text-sm font-medium text-gray-900">{{ $application->donor_reviewed_at ? $application->donor_reviewed_at->format('M d, Y') : 'Not yet' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Donor</p>
                            <p class="text-sm font-medium text-gray-900">{{ $application->donator->organization_name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    @if($application->donor_remarks)
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-2">Donor Remarks</p>
                        <p class="text-sm text-gray-700">{{ $application->donor_remarks }}</p>
                    </div>
                    @endif
                </div>

                <!-- Student Response -->
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Student Response</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Response</p>
                            @if($application->student_response === 'accept')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Accepted</span>
                            @elseif($application->student_response === 'decline')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">Declined</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Pending</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Responded On</p>
                            <p class="text-sm font-medium text-gray-900">{{ $application->student_responded_at ? $application->student_responded_at->format('M d, Y') : 'Not yet' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Actions -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border p-6 sticky top-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Admin Actions</h3>
                    
                    <div class="space-y-3">
                        <!-- Update Status -->
                        <form action="{{ route('admin.applications.update', $application->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                                <select name="status" id="status" onchange="toggleDonorDropdown()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                    <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="review" {{ $application->status === 'review' ? 'selected' : '' }}>Under Review</option>
                                    <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                    <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>

                            <div class="mb-4" id="donor_dropdown" style="display: none;">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Assign to Donor</label>
                                <select name="donator_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                    <option value="">-- Select Donor --</option>
                                    @foreach($donators as $donor)
                                        <option value="{{ $donor->donator_id }}" {{ $application->donator_id == $donor->donator_id ? 'selected' : '' }}>
                                            {{ $donor->organization_name ?? 'Donor #' . $donor->donator_id }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Select a donor to review this application. The application will appear in their dashboard.</p>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Admin Remarks</label>
                                <textarea name="admin_remarks" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" placeholder="Add notes about this application...">{{ $application->remarks ?? '' }}</textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                                Update Status
                            </button>
                        </form>
                        
                        <hr class="my-4">
                        
                        <!-- Quick Actions -->
                        <div class="space-y-2">
                            <a href="{{ route('admin.students.edit', $application->student->id ?? '#') }}" class="block w-full text-center bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                                View Student Profile
                            </a>
                            <a href="{{ route('admin.scholarships.show', $application->scholarship->id ?? '#') }}" class="block w-full text-center bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                                View Scholarship Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDonorDropdown() {
            const statusSelect = document.getElementById('status');
            const donorDropdown = document.getElementById('donor_dropdown');
            
            if (statusSelect.value === 'shortlisted') {
                donorDropdown.style.display = 'block';
            } else {
                donorDropdown.style.display = 'none';
            }
        }

        // Run on page load to show/hide based on current status
        document.addEventListener('DOMContentLoaded', function() {
            toggleDonorDropdown();
        });
    </script>
</x-app-layout>
