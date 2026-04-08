<x-app-layout>
    <!-- Welcome Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-teal-600 to-green-700 rounded-2xl p-6 sm:p-8 shadow-2xl shadow-emerald-500/20">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 sm:w-40 sm:h-40 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 sm:w-40 sm:h-40 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-5">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-white mb-1">
                        Welcome back, {{ Auth::user()->name ?? 'Student' }}
                    </h2>
                    <p class="text-emerald-100 text-sm sm:text-base">
                        Explore available scholarships and manage your applications.
                    </p>
                </div>
            </div>
        </div>
    </div>

    @php
        // Get the student id linked to the authenticated user
        $studentId = auth()->user()->student->id ?? null;

        $userApplications = $studentId
            ? \App\Models\Application::where('student_id', $studentId)->latest()->take(10)->get()
            : collect();

        $totalApplications = $studentId
            ? \App\Models\Application::where('student_id', $studentId)->count()
            : 0;

        $approvedApplications = $studentId
            ? \App\Models\Application::where('student_id', $studentId)->where('status', 'approved')->count()
            : 0;

        $pendingApplications = $studentId
            ? \App\Models\Application::where('student_id', $studentId)->where('status', 'pending')->count()
            : 0;

        $availableScholarships = \App\Models\Scholarship::where('status', 'active')->count();
    @endphp

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-6">
        <!-- Total Applications -->
        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
            <div class="flex items-start justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs sm:text-sm font-medium text-slate-600 mb-1">My Applications</p>
            <p class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">{{ number_format($totalApplications) }}</p>
            <div class="flex items-center text-xs text-blue-600">
                <span class="font-semibold">Total Submitted</span>
            </div>
        </div>

        <!-- Approved Applications -->
        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
            <div class="flex items-start justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs sm:text-sm font-medium text-slate-600 mb-1">Approved</p>
            <p class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">{{ number_format($approvedApplications) }}</p>
            <div class="flex items-center text-xs text-emerald-600">
                <span class="font-semibold">Successful</span>
            </div>
        </div>

        <!-- Pending Applications -->
        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
            <div class="flex items-start justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs sm:text-sm font-medium text-slate-600 mb-1">Pending Review</p>
            <p class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">{{ number_format($pendingApplications) }}</p>
            <div class="flex items-center text-xs text-amber-600">
                <span class="font-semibold">Under Review</span>
            </div>
        </div>

        <!-- Available Scholarships -->
        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
            <div class="flex items-start justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>
            <p class="text-xs sm:text-sm font-medium text-slate-600 mb-1">Available Scholarships</p>
            <p class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">{{ number_format($availableScholarships) }}</p>
            <div class="flex items-center text-xs text-purple-600">
                <span class="font-semibold">Browse Now</span>
            </div>
        </div>
    </div>

    <!-- Applications List -->
    @include('student.applications-list', ['applications' => $userApplications])

    <!-- Available Scholarships -->
    @include('student.available-scholarships', ['scholarships' => \App\Models\Scholarship::where('status','active')->take(6)->get()])

</x-app-layout>
