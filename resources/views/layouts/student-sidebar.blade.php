    <div class="w-64 bg-white shadow-xl flex flex-col border-r border-slate-200/60 relative overflow-hidden">
        <!-- Decorative gradient background -->
        <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-br from-blue-500/10 to-indigo-500/10 pointer-events-none"></div>

        <!-- Sidebar Header -->
        <div class="px-6 py-6 border-b border-slate-200/60 relative">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">ScholarHub</h1>
                    <p class="text-xs text-slate-500 font-medium">Student Portal</p>
                </div>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 py-4 overflow-y-auto scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-transparent">
            @php
                $links = [
                    [
                        'route' => 'profile.edit',
                        'label' => 'My Profile',
                        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                        'color' => 'indigo'
                    ],
                    [
                        'route' => 'documents.index',
                        'label' => 'Documents',
                        'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                        'color' => 'teal'
                    ],
                    [
                        'label' => 'Scholarships',
                        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                        'color' => 'purple',
                        'sub' => [
                            [
                                'route' => '#', // Placeholder for Available Scholarships
                                'label' => 'Available Scholarships',
                            ],
                            [
                                'route' => 'applications.index',
                                'label' => 'My Applications',
                            ],
                            [
                                'route' => '#', // Placeholder for Awarded Scholarships
                                'label' => 'Awarded Scholarships',
                            ],
                        ]
                    ],
                    [
                        'route' => '#', // Placeholder for Application Tracker
                        'label' => 'Application Tracker',
                        'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        'color' => 'emerald'
                    ],
                    [
                        'route' => '#', // Placeholder for Notifications
                        'label' => 'Notifications',
                        'icon' => 'M15 17h5l-5 5V17zM4 12H3a2 2 0 00-2 2v4a2 2 0 002 2h1m8-10V3a2 2 0 00-2-2H5a2 2 0 00-2 2v4h10z',
                        'color' => 'blue'
                    ],
                    [
                        'route' => '#', // Placeholder for Scholarship History
                        'label' => 'Scholarship History',
                        'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                        'color' => 'orange'
                    ],
                    [
                        'route' => '#', // Placeholder for Settings
                        'label' => 'Settings',
                        'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
                        'color' => 'gray'
                    ],
                ];

                $colorClasses = [
                    'blue' => ['active' => 'bg-blue-50 text-blue-700 shadow-sm', 'icon' => 'text-blue-600', 'hover' => 'hover:bg-blue-50'],
                    'indigo' => ['active' => 'bg-indigo-50 text-indigo-700 shadow-sm', 'icon' => 'text-indigo-600', 'hover' => 'hover:bg-indigo-50'],
                    'purple' => ['active' => 'bg-purple-50 text-purple-700 shadow-sm', 'icon' => 'text-purple-600', 'hover' => 'hover:bg-purple-50'],
                    'emerald' => ['active' => 'bg-emerald-50 text-emerald-700 shadow-sm', 'icon' => 'text-emerald-600', 'hover' => 'hover:bg-emerald-50'],
                    'teal' => ['active' => 'bg-teal-50 text-teal-700 shadow-sm', 'icon' => 'text-teal-600', 'hover' => 'hover:bg-teal-50'],
                    'orange' => ['active' => 'bg-orange-50 text-orange-700 shadow-sm', 'icon' => 'text-orange-600', 'hover' => 'hover:bg-orange-50'],
                    'gray' => ['active' => 'bg-gray-50 text-gray-700 shadow-sm', 'icon' => 'text-gray-600', 'hover' => 'hover:bg-gray-50'],
                ];
            @endphp

            <div class="space-y-1 px-3">
                @foreach ($links as $index => $link)
                    @php
                        $isActive = isset($link['route']) ? request()->routeIs($link['route']) : false;
                        $colors = $colorClasses[$link['color']] ?? $colorClasses['blue'];
                        $hasSub = isset($link['sub']) && is_array($link['sub']);
                    @endphp

                    @if($hasSub)
                        <div class="relative">
                            <button onclick="toggleSubMenu('submenu-{{ $index }}')"
                                    class="group flex items-center w-full px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ $isActive ? $colors['active'] : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}">
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center mr-3 flex-shrink-0 transition-all duration-200 {{ $isActive ? 'bg-gradient-to-br from-' . $link['color'] . '-500 to-' . $link['color'] . '-600 shadow-lg shadow-' . $link['color'] . '-500/30' : 'bg-slate-100 group-hover:bg-' . $link['color'] . '-100' }}">
                                    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-500 group-hover:' . $colors['icon'] }}"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="{{ $link['icon'] }}" />
                                    </svg>
                                </div>
                                <span class="truncate flex-1">{{ $link['label'] }}</span>
                                <svg class="w-4 h-4 text-slate-500 transition-transform duration-200" id="arrow-{{ $index }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div id="submenu-{{ $index }}" class="ml-12 mt-1 space-y-1 hidden">
                                @foreach ($link['sub'] as $subLink)
                                    @php
                                        $subIsActive = isset($subLink['route']) && $subLink['route'] !== '#' ? request()->routeIs($subLink['route']) : false;
                                    @endphp
                                    <a href="{{ isset($subLink['route']) && $subLink['route'] !== '#' ? route($subLink['route']) : '#' }}"
                                    class="block px-3 py-2 text-xs font-medium rounded-lg transition-all duration-200 {{ $subIsActive ? 'bg-' . $link['color'] . '-100 text-' . $link['color'] . '-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                        {{ $subLink['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ isset($link['route']) && $link['route'] !== '#' ? route($link['route']) : '#' }}"
                        class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ $isActive ? $colors['active'] : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900' }}">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center mr-3 flex-shrink-0 transition-all duration-200 {{ $isActive ? 'bg-gradient-to-br from-' . $link['color'] . '-500 to-' . $link['color'] . '-600 shadow-lg shadow-' . $link['color'] . '-500/30' : 'bg-slate-100 group-hover:bg-' . $link['color'] . '-100' }}">
                                <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-500 group-hover:' . $colors['icon'] }}"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="{{ $link['icon'] }}" />
                                </svg>
                            </div>
                            <span class="truncate flex-1">{{ $link['label'] }}</span>
                            @if($isActive)
                                <svg class="w-4 h-4 text-{{ $link['color'] }}-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </a>
                    @endif
                @endforeach
            </div>
        </nav>

        <!-- Quick Stats in Sidebar -->
        <div class="px-6 py-4 border-t border-slate-200/60">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 mb-3">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-semibold text-slate-600">Application Status</span>
                    <div class="flex items-center space-x-1">
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                        <span class="text-xs font-bold text-blue-600">Active</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-600">My Applications</span>
                        <span class="font-bold text-indigo-600">{{ \App\Models\Application::whereHas('student', function($q) { $q->where('user_id', auth()->id()); })->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-600">Available Scholarships</span>
                        <span class="font-bold text-purple-600">{{ \App\Models\Scholarship::where('status', 'active')->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Footer -->
        <div class="px-6 py-4 border-t border-slate-200/60 bg-slate-50">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-blue-500 border-2 border-white rounded-full"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-900 truncate">{{ Auth::user()->name ?? 'Student' }}</p>
                    <p class="text-xs text-slate-500 truncate">Student Account</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="p-2 hover:bg-slate-200 rounded-lg transition-colors" title="Logout">
                        <svg class="w-4 h-4 text-slate-500 hover:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background-color: rgb(148 163 184);
        }
    </style>

    <script>
        function toggleSubMenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            const arrow = document.getElementById('arrow-' + submenuId.split('-')[1]);

            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                arrow.classList.add('rotate-90');
            } else {
                submenu.classList.add('hidden');
                arrow.classList.remove('rotate-90');
            }
        }
    </script>
