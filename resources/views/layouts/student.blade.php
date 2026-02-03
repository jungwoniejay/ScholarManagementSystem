<x-student-layout>
    <div class="flex h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-slate-50">
        <!-- Sidebar -->
        @include('layouts.student-sidebar')

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200/60 px-4 sm:px-6 lg:px-8 py-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent tracking-tight">{{ $header ?? 'Student Portal' }}</h1>
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
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</x-student-layout>
