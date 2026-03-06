<div class="hidden md:flex w-64 bg-white shadow-xl flex-col
            border-r border-slate-200/60
            fixed left-0 top-0 h-screen z-50">

    <!-- Decorative gradient background -->
    <div class="absolute top-0 left-0 right-0 h-40 bg-gradient-to-br from-emerald-600/10 via-teal-600/5 to-green-700/5 pointer-events-none z-0"></div>
    
    <!-- Sidebar Header -->
    <div class="px-6 py-6 border-b border-slate-200/60 relative z-10 flex-shrink-0">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">ScholarHub</h1>
                <p class="text-xs text-slate-500 font-medium">Admin Portal</p>
            </div>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-1 py-6 overflow-y-auto scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-transparent min-h-0">
        @php
            $links = [
                [
                    'route' => 'admin.dashboard', 
                    'label' => 'Dashboard', 
                    'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                    'color' => 'emerald'
                ],
                [
                    'route' => 'admin.students.index', 
                    'label' => 'Students', 
                    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                    'color' => 'emerald'
                ],
                [
                    'route' => 'admin.scholarships.index', 
                    'label' => 'Scholarships', 
                    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                    'color' => 'blue'
                ],
                [
                    'route' => 'admin.applications.screened', 
                    'label' => 'Applications', 
                    'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                    'color' => 'amber',
                    'badge' => \App\Models\Application::where('status', 'pending')->count()
                ],
                [
                    'route' => 'admin.donators.index', 
                    'label' => 'Donors', 
                    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                    'color' => 'cyan'
                ],
                [
                    'route' => 'admin.funds.monitor', 
                    'label' => 'Funds', 
                    'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    'color' => 'purple'
                ],
                [
                    'route' => 'admin.donations.index', 
                    'label' => 'Donations', 
                    'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                    'color' => 'rose'
                ],
                [
                    'route' => 'admin.documents.verify',
                    'label' => 'Verify Documents', 
                    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'color' => 'teal'
                ],
                [
                    'route' => 'admin.applications.review', 
                    'label' => 'Review Applications', 
                    'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
                    'color' => 'green'
                ],
                [
                    'route' => 'admin.applications.shortlist', 
                    'label' => 'Shortlist', 
                    'icon' => 'M5 13l4 4L19 7',
                    'color' => 'indigo'
                ],
                [
                    'route' => 'admin.rules.index', 
                    'label' => 'AI Rules', 
                    'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                    'color' => 'violet'
                ],
                [
                    'route' => 'admin.reports.index', 
                    'label' => 'Reports', 
                    'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                    'color' => 'rose'
                ],
                [
                    'route' => 'admin.accounts.index', 
                    'label' => 'Admin Accounts', 
                    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                    'color' => 'slate'
                ],
            ];
        @endphp

        <div class="space-y-1 px-3">
            @foreach ($links as $link)
                @php
                    $isActive = request()->routeIs($link['route']);
                @endphp
                
                <a href="{{ route($link['route']) }}"
                   class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-300 relative {{ $isActive ? 'bg-gradient-to-r from-' . $link['color'] . '-50 to-' . $link['color'] . '-50/50 text-' . $link['color'] . '-700 shadow-sm' : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}">
                    
                    <!-- Active indicator -->
                    @if($isActive)
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-gradient-to-b from-{{ $link['color'] }}-500 to-{{ $link['color'] }}-600 rounded-r-full"></div>
                    @endif

                    <!-- Icon -->
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-3 flex-shrink-0 transition-all duration-300 {{ $isActive ? 'bg-gradient-to-br from-' . $link['color'] . '-500 to-' . $link['color'] . '-600 shadow-lg shadow-' . $link['color'] . '-500/30 scale-105' : 'bg-slate-100 group-hover:bg-slate-200' }}">
                        <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-500 group-hover:text-slate-700' }}"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="{{ $link['icon'] }}" />
                        </svg>
                    </div>

                    <!-- Label -->
                    <span class="truncate flex-1">{{ $link['label'] }}</span>

                    <!-- Badge -->
                    @if(isset($link['badge']) && $link['badge'] > 0)
                        <span class="ml-auto px-2 py-0.5 text-xs font-bold bg-{{ $link['color'] }}-600 text-white rounded-full {{ $isActive ? 'animate-pulse' : '' }}">
                            {{ $link['badge'] }}
                        </span>
                    @endif

                    <!-- Arrow indicator for active state -->
                    @if($isActive)
                        <svg class="w-4 h-4 text-{{ $link['color'] }}-600 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    @endif
                </a>
            @endforeach
        </div>
    </nav>

    <!-- Quick Stats Card -->
    <div class="px-6 py-4 border-t border-slate-200/60 flex-shrink-0">
        <div class="bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 rounded-2xl p-4 shadow-sm border border-emerald-100/50">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-bold text-emerald-700">System Status</span>
                </div>
                <span class="text-xs font-semibold text-emerald-600 bg-emerald-100/50 px-2 py-0.5 rounded-full">Live</span>
            </div>
            
            <div class="space-y-2.5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs text-slate-600 font-medium">Pending</span>
                    </div>
                    <span class="text-sm font-bold text-amber-600">{{ \App\Models\Application::where('status', 'pending')->count() }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="text-xs text-slate-600 font-medium">Students</span>
                    </div>
                    <span class="text-sm font-bold text-emerald-600">{{ \App\Models\Student::count() }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span class="text-xs text-slate-600 font-medium">Programs</span>
                    </div>
                    <span class="text-sm font-bold text-blue-600">{{ \App\Models\Scholarship::where('status', 'active')->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- User Profile Footer -->
    <div class="px-6 py-4 border-t border-slate-200/60 bg-gradient-to-r from-slate-50/50 to-emerald-50/30 flex-shrink-0">
        <div class="flex items-center space-x-3">
            <div class="relative flex-shrink-0">
                <div class="w-11 h-11 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <span class="text-white font-bold text-base">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                </div>
                <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name ?? 'Admin User' }}</p>
                <p class="text-xs text-slate-500 truncate">Administrator</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-2 hover:bg-red-50 hover:text-red-600 rounded-lg transition-all duration-200 group" title="Logout">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-red-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Custom scrollbar styling */
    .scrollbar-thin::-webkit-scrollbar {
        width: 6px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background-color: rgb(203 213 225);
        border-radius: 20px;
        border: 2px solid transparent;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background-color: rgb(148 163 184);
    }

    /* Smooth transitions for hover states */
    .group:hover .group-hover\:scale-105 {
        transform: scale(1.05);
    }

    /* Pulse animation for badges */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: .8;
        }
    }
</style>