<x-app-layout>
    <div class="flex h-screen bg-gradient-to-br from-slate-50 via-emerald-50/30 to-slate-50">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200/60 px-4 sm:px-6 lg:px-8 py-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent tracking-tight">Administrator Dashboard</h1>
                        <p class="text-xs sm:text-sm text-slate-600 mt-0.5">Manage and monitor scholarship operations</p>
                    </div>
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <!-- Search -->
                        <form action="{{ route('admin.search') }}" method="GET" class="hidden md:flex items-center bg-slate-100 rounded-xl px-3 sm:px-4 py-2 space-x-2 min-w-[240px] lg:min-w-[280px] hover:bg-slate-200 transition-colors">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" name="q" placeholder="Search..." class="bg-transparent text-sm text-slate-700 placeholder-slate-400 outline-none flex-1 w-0">
                        </form>

                        <!-- Notifications Dropdown -->
                        @php
                            // Optimize database queries
                            $recentTime = now()->subDays(7);
                            
                            $newStudents = \App\Models\Student::with('user')
                                ->where('created_at', '>=', $recentTime)
                                ->get(['id', 'user_id', 'created_at']);
                            
                            $newApplications = \App\Models\Application::with(['student.user', 'scholarship'])
                                ->where('created_at', '>=', $recentTime)
                                ->get(['id', 'student_id', 'scholarship_id', 'created_at']);
                            
                            $pendingReviews = \App\Models\Application::with('student.user')
                                ->where('status', 'pending')
                                ->limit(5)
                                ->get(['id', 'student_id', 'created_at', 'status']);
                            
                            $pendingDocuments = \App\Models\Application::whereHas('documents', function($q) {
                                $q->where('status', 'pending');
                            })
                            ->with('student.user')
                            ->limit(3)
                            ->get(['id', 'student_id', 'updated_at']);
                            
                            $approvedApplications = \App\Models\Application::with('student.user')
                                ->where('status', 'approved')
                                ->where('updated_at', '>=', now()->subDays(3))
                                ->limit(3)
                                ->get(['id', 'student_id', 'updated_at']);
                            
                            $notifications = collect();
                            
                            foreach($newStudents as $student) {
                                $notifications->push([
                                    'type' => 'new_student',
                                    'title' => 'New Student Registration',
                                    'message' => ($student->user->name ?? 'Student') . ' has registered',
                                    'time' => $student->created_at,
                                    'icon' => 'user',
                                    'color' => 'emerald',
                                    'color_class' => 'emerald',
                                    'link' => route('admin.students.index')
                                ]);
                            }
                            
                            foreach($newApplications as $application) {
                                $notifications->push([
                                    'type' => 'new_application',
                                    'title' => 'New Application',
                                    'message' => ($application->student->user->name ?? 'Student') . ' applied for ' . ($application->scholarship->name ?? 'scholarship'),
                                    'time' => $application->created_at,
                                    'icon' => 'document',
                                    'color' => 'blue',
                                    'color_class' => 'blue',
                                    'link' => route('admin.applications.screened')
                                ]);
                            }
                            
                            foreach($pendingReviews as $review) {
                                $notifications->push([
                                    'type' => 'pending_review',
                                    'title' => 'Pending Review',
                                    'message' => 'Application from ' . ($review->student->user->name ?? 'Student') . ' needs review',
                                    'time' => $review->created_at,
                                    'icon' => 'clock',
                                    'color' => 'amber',
                                    'color_class' => 'amber',
                                    'link' => route('admin.applications.review')
                                ]);
                            }
                            
                            foreach($pendingDocuments as $doc) {
                                $notifications->push([
                                    'type' => 'pending_document',
                                    'title' => 'Document Verification',
                                    'message' => 'Documents from ' . ($doc->student->user->name ?? 'Student') . ' need verification',
                                    'time' => $doc->updated_at,
                                    'icon' => 'check',
                                    'color' => 'purple',
                                    'color_class' => 'purple',
                                    'link' => route('admin.documents.verify')
                                ]);
                            }
                            
                            foreach($approvedApplications as $approved) {
                                $notifications->push([
                                    'type' => 'approved',
                                    'title' => 'Application Approved',
                                    'message' => ($approved->student->user->name ?? 'Student') . '\'s application was approved',
                                    'time' => $approved->updated_at,
                                    'icon' => 'success',
                                    'color' => 'green',
                                    'color_class' => 'green',
                                    'link' => route('admin.applications.review')
                                ]);
                            }
                            
                            $notifications = $notifications->sortByDesc('time')->take(10);
                            $notificationCount = $notifications->count();
                        @endphp

                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="relative p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                @if($notificationCount > 0)
                                    <span class="absolute top-1.5 right-1.5 flex h-5 w-5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-5 w-5 bg-gradient-to-br from-red-500 to-pink-600 items-center justify-center text-white text-xs font-bold">
                                            {{ $notificationCount > 9 ? '9+' : $notificationCount }}
                                        </span>
                                    </span>
                                @endif
                            </button>

                            <!-- Notification Dropdown -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="fixed md:absolute right-2 mt-2 w-[calc(100vw-1rem)] md:w-96 bg-white rounded-2xl shadow-2xl border border-slate-200 z-50 max-h-[70vh] md:max-h-[600px] overflow-hidden"
                                 x-cloak>
                                
                                <div class="px-4 sm:px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-emerald-50 to-teal-50">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-bold text-slate-900">Notifications</h3>
                                        @if($notificationCount > 0)
                                        <span class="text-xs font-semibold bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-full">
                                            {{ $notificationCount }} new
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="overflow-y-auto max-h-[calc(70vh-120px)] md:max-h-[480px] divide-y divide-slate-100">
                                    @forelse($notifications as $notification)
                                        <a href="{{ $notification['link'] }}" class="block px-4 sm:px-6 py-4 hover:bg-slate-50 transition-colors">
                                            <div class="flex items-start space-x-3">
                                                <!-- Fixed icon with conditional classes -->
                                                @php
                                                    $iconClasses = [
                                                        'emerald' => 'bg-emerald-100 text-emerald-600',
                                                        'blue' => 'bg-blue-100 text-blue-600',
                                                        'amber' => 'bg-amber-100 text-amber-600',
                                                        'purple' => 'bg-purple-100 text-purple-600',
                                                        'green' => 'bg-green-100 text-green-600',
                                                    ];
                                                    $colorClass = $iconClasses[$notification['color_class'] ?? 'emerald'];
                                                @endphp
                                                
                                                <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center {{ $colorClass }}">
                                                    @if($notification['icon'] === 'user')
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                    @elseif($notification['icon'] === 'document')
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    @elseif($notification['icon'] === 'clock')
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    @elseif($notification['icon'] === 'check')
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    @endif
                                                </div>

                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-semibold text-slate-900 truncate">
                                                        {{ $notification['title'] }}
                                                    </p>
                                                    <p class="text-sm text-slate-600 mt-0.5 line-clamp-2">
                                                        {{ $notification['message'] }}
                                                    </p>
                                                    <p class="text-xs text-slate-400 mt-1">
                                                        {{ $notification['time']->diffForHumans() }}
                                                    </p>
                                                </div>

                                                @if($notification['time']->isToday())
                                                <div class="flex-shrink-0">
                                                    @php
                                                        $dotClasses = [
                                                            'emerald' => 'bg-emerald-500',
                                                            'blue' => 'bg-blue-500',
                                                            'amber' => 'bg-amber-500',
                                                            'purple' => 'bg-purple-500',
                                                            'green' => 'bg-green-500',
                                                        ];
                                                        $dotClass = $dotClasses[$notification['color_class'] ?? 'emerald'];
                                                    @endphp
                                                    <div class="w-2 h-2 rounded-full {{ $dotClass }}"></div>
                                                </div>
                                                @endif
                                            </div>
                                        </a>
                                    @empty
                                        <div class="px-6 py-12 text-center">
                                            <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                            </svg>
                                            <p class="text-slate-500 font-medium">No notifications</p>
                                            <p class="text-xs text-slate-400 mt-1">You're all caught up!</p>
                                        </div>
                                    @endforelse
                                </div>

                                @if($notificationCount > 0)
                                <div class="px-6 py-3 border-t border-slate-200 bg-slate-50">
                                    <a href="{{ route('admin.notifications.all') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 flex items-center justify-center">
                                        View all notifications
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Settings -->
                        <a href="{{ route('admin.settings') }}" class="p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                        <!-- Stat Cards with clickable links -->
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

                    <!-- Scholarship Overview & Statistics -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Top Scholarships -->
                        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
                            <div class="flex items-center justify-between mb-4 sm:mb-6">
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                    </div>
                                    <span>Top Scholarships</span>
                                </h3>
                                <a href="{{ route('admin.scholarships.index') }}" class="text-xs sm:text-sm font-medium text-purple-600 hover:text-purple-700">View all</a>
                            </div>

                            <div class="space-y-3 sm:space-y-4">
                                @forelse(\App\Models\Scholarship::withCount('applications')->orderBy('applications_count', 'desc')->take(5)->get() as $scholarship)
                                <a href="{{ route('admin.scholarships.show', $scholarship->id) }}" class="flex items-center justify-between p-3 sm:p-4 bg-gradient-to-r from-slate-50 to-transparent rounded-xl hover:from-purple-50 transition-colors">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-slate-900 text-sm sm:text-base truncate mb-1">{{ $scholarship->name }}</h4>
                                        <div class="flex flex-col sm:flex-row sm:items-center space-y-1 sm:space-y-0 sm:space-x-4 text-xs text-slate-500">
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                                </svg>
                                                {{ $scholarship->applications_count }} applicants
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                                </svg>
                                                ₱{{ number_format($scholarship->amount, 0) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-3 sm:ml-4 flex-shrink-0">
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl flex items-center justify-center">
                                            <span class="text-base sm:text-lg font-bold text-purple-600">{{ $scholarship->applications_count }}</span>
                                        </div>
                                    </div>
                                </a>
                                @empty
                                <div class="text-center py-6 sm:py-8 text-slate-400">
                                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <p>No scholarships available</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Application Status Chart -->
                        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
                            <div class="flex items-center justify-between mb-4 sm:mb-6">
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <span>Application Status</span>
                                </h3>
                            </div>

                            @php
                                $statusCounts = \App\Models\Application::selectRaw('status, COUNT(*) as count')
                                    ->groupBy('status')
                                    ->pluck('count', 'status');
                                $totalApps = $statusCounts->sum();
                                
                                $approved = $statusCounts->get('approved', 0);
                                $pending = $statusCounts->get('pending', 0);
                                $rejected = $statusCounts->get('rejected', 0);
                                
                                $approvedPercent = $totalApps > 0 ? round(($approved / $totalApps) * 100) : 0;
                                $pendingPercent = $totalApps > 0 ? round(($pending / $totalApps) * 100) : 0;
                                $rejectedPercent = $totalApps > 0 ? round(($rejected / $totalApps) * 100) : 0;
                            @endphp

                            <div class="space-y-4 sm:space-y-6">
                                <!-- Approved -->
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                            <span class="text-sm font-medium text-slate-700">Approved</span>
                                        </div>
                                        <span class="text-sm font-bold text-slate-900">{{ $approvedPercent }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-200 rounded-full h-2.5">
                                        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $approvedPercent }}%"></div>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">{{ number_format($approved) }} applications</p>
                                </div>

                                <!-- Pending -->
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                                            <span class="text-sm font-medium text-slate-700">Pending</span>
                                        </div>
                                        <span class="text-sm font-bold text-slate-900">{{ $pendingPercent }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-200 rounded-full h-2.5">
                                        <div class="bg-gradient-to-r from-amber-500 to-orange-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $pendingPercent }}%"></div>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">{{ number_format($pending) }} applications</p>
                                </div>

                                <!-- Rejected -->
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                            <span class="text-sm font-medium text-slate-700">Rejected</span>
                                        </div>
                                        <span class="text-sm font-bold text-slate-900">{{ $rejectedPercent }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-200 rounded-full h-2.5">
                                        <div class="bg-gradient-to-r from-red-500 to-pink-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $rejectedPercent }}%"></div>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">{{ number_format($rejected) }} applications</p>
                                </div>

                                <!-- Total Applications Summary -->
                                <div class="pt-4 border-t border-slate-200">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-semibold text-slate-700">Total Applications</span>
                                        <span class="text-lg font-bold text-slate-900">{{ number_format($totalApps) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Section -->
                    <div class="mt-6 text-center">
                        <p class="text-xs sm:text-sm text-slate-500">
                            Last updated: {{ now()->format('F d, Y - h:i A') }}
                        </p>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>