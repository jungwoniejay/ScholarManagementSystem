<x-app-layout>
    <div class="px-8 py-10 max-w-6xl mx-auto">
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
                <!-- Scholarship Header -->
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                    {{ substr($scholarship->name, 0, 1) }}
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $scholarship->name }}</h1>
                                    <p class="text-sm text-gray-500">{{ $scholarship->academic_year }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            @if($scholarship->status === 'active')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Key Details -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-4 border-t border-b border-gray-100">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Amount</p>
                            <p class="text-lg font-bold text-gray-900">${{ number_format($scholarship->amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Recipients</p>
                            <p class="text-lg font-bold text-gray-900">{{ $scholarship->max_recipients }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Deadline</p>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ $scholarship->application_deadline ? $scholarship->application_deadline->format('M d, Y') : 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Funding Progress</p>
                            <p class="text-sm font-semibold text-gray-900">{{ number_format($scholarship->funding_progress, 1) }}%</p>
                        </div>
                    </div>

                    <!-- Funding Progress Bar -->
                    <div class="mt-4">
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-gray-500">Funding Progress</span>
                            <span class="font-semibold text-gray-900">${{ number_format($scholarship->total_funded, 2) }} of ${{ number_format($scholarship->amount * $scholarship->max_recipients, 2) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-purple-500 to-pink-600 h-2 rounded-full" style="width: {{ $scholarship->funding_progress }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Description</h2>
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! nl2br(e($scholarship->description)) !!}
                    </div>
                </div>

                <!-- Eligibility Criteria -->
                @if($scholarship->eligibility_criteria)
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Eligibility Criteria</h2>
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! nl2br(e($scholarship->eligibility_criteria)) !!}
                    </div>
                </div>
                @endif

                <!-- Donator Information -->
                @if($scholarship->donator)
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Provided By</h2>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                            {{ substr($scholarship->donator->organization_name ?? 'D', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $scholarship->donator->organization_name ?? 'Anonymous Donor' }}</p>
                            <p class="text-sm text-gray-500">Donor</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar - Application Actions -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border p-6 sticky top-8">
                    @if($existingApplication)
                        <!-- Already Applied -->
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Application Submitted</h3>
                            <p class="text-sm text-gray-500 mb-4">You have already applied for this scholarship.</p>
                            <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Current Status</p>
                                <p class="text-sm font-semibold text-gray-900 capitalize">{{ $existingApplication->status }}</p>
                            </div>
                            <a href="{{ route('student.scholarships.status') }}" class="block w-full bg-gray-100 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition-colors text-center">
                                View All Applications
                            </a>
                        </div>
                    @elseif($scholarship->isAcceptingApplications())
                        <!-- Can Apply -->
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Ready to Apply?</h3>
                            <p class="text-sm text-gray-500 mb-6">Make sure you meet all eligibility requirements before applying.</p>
                            
                            <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="scholarship_id" value="{{ $scholarship->id }}">
                                
                                <div class="space-y-4 mb-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Personal Statement</label>
                                        <textarea name="personal_statement" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm" placeholder="Tell us why you deserve this scholarship..." required></textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Required Documents</label>
                                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-3">
                                            <p class="text-xs text-blue-800 font-semibold mb-2">📄 Required Documents (Submit all 3 for maximum AI score):</p>
                                            <ul class="text-xs text-blue-700 space-y-1">
                                                <li>• <strong>Grade 12 Report Card / Transcript</strong> - Official academic records</li>
                                                <li>• <strong>Certificate of Indigency</strong> - From Barangay or Municipal Hall</li>
                                                <li>• <strong>Proof of Income</strong> - ITR, Certificate of Compensation, or Barangay Certificate</li>
                                            </ul>
                                            <p class="text-xs text-blue-600 mt-2">💡 Submitting all 3 documents gives you the highest AI score and better chances of approval.</p>
                                        </div>
                                        <input type="file" name="documents[]" multiple class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100"/>
                                        <p class="text-xs text-gray-500 mt-1">Upload scanned copies or clear photos of your documents (PDF, JPG, PNG - Max 10MB each)</p>
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    Submit Application
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Cannot Apply -->
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Applications Closed</h3>
                            <p class="text-sm text-gray-500">
                                @if($scholarship->approval_status !== 'approved')
                                    This scholarship is pending approval.
                                @elseif($scholarship->status !== 'active')
                                    This scholarship is currently inactive.
                                @elseif($scholarship->application_deadline && $scholarship->application_deadline->isPast())
                                    The application deadline has passed.
                                @elseif($scholarship->isFullyFunded())
                                    This scholarship has reached its maximum funding.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
