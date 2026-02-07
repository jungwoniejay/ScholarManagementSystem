@extends('layouts.app')

@section('content')
<div class="flex-1 overflow-y-auto bg-slate-50">
    <header class="bg-white shadow-sm border-b sticky top-0 z-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Administrator Dashboard</h1>
                        <p class="text-sm text-gray-600">Manage and monitor scholarship operations</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('admin.search') }}" method="GET" class="hidden md:block">
                            <input type="text" name="q" placeholder="Search..." class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </form>
                        <button class="p-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <a href="{{ route('admin.settings') }}" class="p-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
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
                                <h2 class="text-xl sm:text-2xl font-bold text-white mb-1">Welcome back, {{ Auth::user()->name ?? 'Administrator' }}</h2>
                                <p class="text-emerald-100 text-sm sm:text-base">Here's what's happening with your scholarship program today.</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.scholarships.create') }}" class="w-full sm:w-auto flex items-center justify-center space-x-2 bg-white/20 hover:bg-white/30 backdrop-blur-xl px-4 sm:px-6 py-3 rounded-xl text-white font-medium transition-all duration-200 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span class="text-sm sm:text-base">New Scholarship</span>
                        </a>
                    </div>
                </div>

                <!-- Quick Stats Grid -->
                @php
                    $totalStudents = \App\Models\Student::count();
                    $activeScholarships = \App\Models\Scholarship::where('status', 'active')->count();
                    $pendingApplications = \App\Models\Application::where('status', 'pending')->count();
                    $totalFunding = \App\Models\Scholarship::where('status', 'active')->sum('amount');
                    $distributedFunding = \App\Models\Application::where('status', 'approved')->sum('awarded_amount');
                    $distributionPercentage = $totalFunding > 0 ? round(($distributedFunding / $totalFunding) * 100) : 0;
                    $totalDonors = \App\Models\Donator::count();
                    $totalDonorFunds = \App\Models\Donator::sum('total_fund');
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 sm:gap-6">
                    <!-- Stat Cards -->
                    <a href="{{ route('admin.students.index') }}" class="group bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
                        <div class="flex items-start justify-between mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">Active</span>
                        </div>
                        <p class="text-xs sm:text-sm font-medium text-slate-600 mb-1">Total Students</p>
                        <p class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">{{ number_format($totalStudents) }}</p>
                        <div class="flex items-center text-xs text-emerald-600">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">View Students</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.scholarships.index') }}" class="group bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
                        <div class="flex items-start justify-between mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">Available</span>
                        </div>
                        <p class="text-xs sm:text-sm font-medium text-slate-600 mb-1">Active Scholarships</p>
                        <p class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">{{ number_format($activeScholarships) }}</p>
                        <div class="flex items-center text-xs text-blue-600">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Manage Programs</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.applications.review') }}" class="group bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
                        <div class="flex items-start justify-between mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            @if($pendingApplications > 0)
                            <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full animate-pulse">Review</span>
                            @endif
                        </div>
                        <p class="text-xs sm:text-sm font-medium text-slate-600 mb-1">Pending Applications</p>
                        <p class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">{{ number_format($pendingApplications) }}</p>
                        @if($pendingApplications > 0)
                        <div class="flex items-center text-xs text-amber-600">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Review Now</span>
                        </div>
                        @else
                        <div class="flex items-center text-xs text-slate-400">
                            <span class="font-semibold">All reviewed</span>
                        </div>
                        @endif
                    </a>

                    <a href="{{ route('admin.funds.monitor') }}" class="group bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
                        <div class="flex items-start justify-between mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2 py-1 rounded-full">{{ $distributionPercentage }}%</span>
                        </div>
                        <p class="text-xs sm:text-sm font-medium text-slate-600 mb-1">Total Funding</p>
                        <p class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">₱{{ number_format($totalFunding, 0) }}</p>
                        @if($totalFunding > 0)
                        <div class="flex items-center text-xs">
                            <div class="flex-1 bg-slate-200 rounded-full h-1.5 mr-2">
                                <div class="bg-gradient-to-r from-purple-500 to-pink-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $distributionPercentage }}%"></div>
                            </div>
                            <span class="text-purple-600 font-semibold">Distributed</span>
                        </div>
                        @endif
                    </a>

                    <a href="{{ route('admin.donators.index') }}" class="group bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
                        <div class="flex items-start justify-between mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-cyan-600 bg-cyan-50 px-2 py-1 rounded-full">Donors</span>
                        </div>
                        <p class="text-xs sm:text-sm font-medium text-slate-600 mb-1">Total Donors</p>
                        <p class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">{{ number_format($totalDonors) }}</p>
                        <div class="flex items-center text-xs text-cyan-600">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Manage Donors</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.donators.index') }}" class="group bg-white rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
                        <div class="flex items-start justify-between mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-rose-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg shadow-rose-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-rose-600 bg-rose-50 px-2 py-1 rounded-full">Funds</span>
                        </div>
                        <p class="text-xs sm:text-sm font-medium text-slate-600 mb-1">Donor Funds</p>
                        <p class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">₱{{ number_format($totalDonorFunds, 0) }}</p>
                        <div class="flex items-center text-xs text-rose-600">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">View Funds</span>
                        </div>
                    </a>
                </div>

                <!-- Charts and Recent Activity Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                    <!-- Recent Applications -->
                    <div class="lg:col-span-2 bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-base sm:text-lg font-bold text-slate-900">Recent Applications</h3>
                            </div>
                            <a href="{{ route('admin.applications.screened') }}" class="text-xs sm:text-sm font-medium text-emerald-600 hover:text-emerald-700 flex items-center space-x-1">
                                <span>View all</span>
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Application List -->
                        <div class="space-y-3">
                            @forelse(\App\Models\Application::with(['student.user', 'scholarship'])->latest()->take(5)->get() as $application)
                            <a href="{{ route('admin.applications.show', $application->id) }}" class="flex flex-col sm:flex-row sm:items-center justify-between p-3 sm:p-4 bg-slate-50 hover:bg-slate-100 rounded-xl transition-colors space-y-2 sm:space-y-0">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                                        {{ substr($application->student->user->name ?? 'N', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 text-sm sm:text-base">{{ $application->student->user->name ?? 'Unknown' }}</p>
                                        <p class="text-xs sm:text-sm text-slate-500 truncate max-w-[200px]">{{ $application->scholarship->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="text-xs px-2 sm:px-3 py-1 rounded-full font-semibold
                                        {{ $application->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $application->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $application->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                    <span class="text-xs text-slate-400 whitespace-nowrap">{{ $application->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                            @empty
                            <div class="text-center py-6 sm:py-8 text-slate-400">
                                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p>No applications yet</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
                        <h3 class="text-base sm:text-lg font-bold text-slate-900 mb-4 flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span>Quick Actions</span>
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('admin.scholarships.create') }}" class="flex items-center justify-between p-3 bg-emerald-50 hover:bg-emerald-100 rounded-xl transition-colors group">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700">New Scholarship</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('admin.applications.review') }}" class="flex items-center justify-between p-3 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors group">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700">Review Applications</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('admin.reports.index') }}" class="flex items-center justify-between p-3 bg-purple-50 hover:bg-purple-100 rounded-xl transition-colors group">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700">View Reports</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-purple-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('admin.students.index') }}" class="flex items-center justify-between p-3 bg-amber-50 hover:bg-amber-100 rounded-xl transition-colors group">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700">Manage Students</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-amber-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('admin.settings') }}" class="flex items-center justify-between p-3 bg-rose-50 hover:bg-rose-100 rounded-xl transition-colors group">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700">System Settings</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-rose-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- System Status -->
                        <div class="mt-6 pt-6 border-t border-slate-200">
                            <h4 class="text-sm font-semibold text-slate-900 mb-3">System Status</h4>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                        <span class="text-xs text-slate-600">All Systems</span>
                                    </div>
                                    <span class="text-xs font-semibold text-emerald-600">Operational</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <span class="text-xs text-slate-600">Database</span>
                                    </div>
                                    <span class="text-xs font-semibold text-blue-600">Connected</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                        <span class="text-xs text-slate-600">Last Backup</span>
                                    </div>
                                    <span class="text-xs font-semibold text-purple-600">2 hours ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Section -->
                <div class="mt-6 text-center pb-8">
                    <p class="text-xs sm:text-sm text-slate-500">
                        Last updated: {{ now()->format('F d, Y - h:i A') }}
                    </p>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection