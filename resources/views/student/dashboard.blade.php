<x-app-layout>
    <div class="flex h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-slate-50">
        <!-- Sidebar -->
        @include('layouts.student-sidebar')

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200/60 px-4 sm:px-6 lg:px-8 py-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent tracking-tight">Student Dashboard</h1>
                        <p class="text-xs sm:text-sm text-slate-600 mt-0.5">Manage your scholarship applications</p>
                    </div>
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}" class="p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto space-y-6 sm:space-y-8">
                    <!-- Welcome Section -->
                    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-teal-600 to-green-700 rounded-2xl p-6 sm:p-8 shadow-2xl shadow-emerald-500/20">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 sm:w-40 sm:h-40 bg-white/10 rounded-full blur-3xl"></div>
                        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 sm:w-40 sm:h-40 bg-white/10 rounded-full blur-3xl"></div>
                        <div class="relative flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-5">
                                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl sm:text-2xl font-bold text-white mb-1">Welcome back, {{ Auth::user()->name ?? 'Student' }}</h2>
                                    <p class="text-emerald-100 text-sm sm:text-base">Explore available scholarships and manage your applications.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats Grid -->
                    @php
                        $userApplications = \App\Models\Application::whereHas('student', function($q) {
                            $q->where('user_id', auth()->id());
                        })->get();
                        $totalApplications = $userApplications->count();
                        $approvedApplications = $userApplications->where('status', 'approved')->count();
                        $pendingApplications = $userApplications->where('status', 'pending')->count();
                        $availableScholarships = \App\Models\Scholarship::where('status', 'active')->count();
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                        <!-- Total Applications -->
                        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
                            <div class="flex items-start justify-between mb-3 sm:mb-4">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
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

                    <!-- My Applications -->
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span>My Applications</span>
                            </h3>
                        </div>

                        <div class="space-y-3">
                            @forelse($userApplications as $application)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-3 sm:p-4 bg-slate-50 hover:bg-slate-100 rounded-xl transition-colors space-y-2 sm:space-y-0">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                                        {{ substr($application->scholarship->name ?? 'S', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 text-sm sm:text-base">{{ $application->scholarship->name ?? 'Scholarship' }}</p>
                                        <p class="text-xs sm:text-sm text-slate-500">Applied {{ $application->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="text-xs px-2 sm:px-3 py-1 rounded-full font-semibold
                                        {{ $application->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $application->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $application->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-6 sm:py-8 text-slate-400">
                                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p>No applications yet</p>
                                <p class="text-xs mt-1">Start by browsing available scholarships</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Available Scholarships -->
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </div>
                                <span>Available Scholarships</span>
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @forelse(\App\Models\Scholarship::where('status', 'active')->take(6)->get() as $scholarship)
                            <div class="bg-gradient-to-br from-slate-50 to-white p-4 rounded-xl border border-slate-200/60 hover:shadow-lg transition-shadow">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <span class="text-xs font-semibold bg-purple-100 text-purple-700 px-2 py-1 rounded-full">₱{{ number_format($scholarship->amount, 0) }}</span>
                                </div>
                                <h4 class="font-semibold text-slate-900 text-sm mb-2">{{ $scholarship->name }}</h4>
                                <p class="text-xs text-slate-600 mb-3 line-clamp-2">{{ $scholarship->description ?? 'No description available' }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-slate-500">{{ $scholarship->applications_count ?? 0 }} applicants</span>
                                    <button class="text-xs font-medium text-purple-600 hover:text-purple-700">Apply Now</button>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-full text-center py-6 sm:py-8 text-slate-400">
                                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p>No scholarships available</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
