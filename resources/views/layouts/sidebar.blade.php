<div class="w-64 bg-white shadow-sm flex flex-col border-r border-gray-200">
    <!-- Sidebar Header -->
    <div class="px-6 py-5 border-b border-gray-200">
        <h1 class="text-lg font-semibold text-gray-900">Admin Dashboard</h1>
        <p class="text-xs text-gray-500 mt-1">Scholarship Management</p>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-1 py-4 overflow-y-auto">
        @php
            $links = [
                ['route' => 'admin.students.index', 'label' => 'Manage Students', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ['route' => 'admin.donators.index', 'label' => 'Manage Donators', 'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'],
                ['route' => 'admin.scholarships.index', 'label' => 'Scholarships', 'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222'],
                ['route' => 'admin.rules.index', 'label' => 'AI Rules', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                ['route' => 'admin.applications.screened', 'label' => 'Review Applications', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                ['route' => 'admin.documents.verify', 'label' => 'Verify Documents', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['route' => 'admin.applications.review', 'label' => 'Approve Applications', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['route' => 'admin.applications.shortlist', 'label' => 'Shortlist Applicants', 'icon' => 'M5 13l4 4L19 7'],
                ['route' => 'admin.funds.monitor', 'label' => 'Monitor Funds', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['route' => 'admin.reports.index', 'label' => 'Reports', 'icon' => 'M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z'],
                ['route' => 'admin.accounts.index', 'label' => 'Admin Accounts', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
            ];
        @endphp

        <div class="space-y-1 px-3">
            @foreach ($links as $link)
                @php
                    $isActive = request()->routeIs($link['route']);
                @endphp
                
                <a href="{{ route($link['route']) }}" 
                   class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-150 {{ $isActive ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 {{ $isActive ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" 
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="{{ $link['icon'] }}" />
                    </svg>
                    <span class="truncate">{{ $link['label'] }}</span>
                </a>
            @endforeach
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="px-6 py-4 border-t border-gray-200">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">Admin User</p>
                <p class="text-xs text-gray-500">System Administrator</p>
            </div>
        </div>
    </div>
</div>