<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ScholarHub') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }
        
        /* Sidebar transition */
        .sidebar-overlay {
            transition: opacity 0.3s ease;
        }
        
        .sidebar-panel {
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans antialiased">

<!-- Mobile Sidebar Overlay -->
<div id="sidebar-overlay" 
     class="fixed inset-0 bg-black/50 z-40 lg:hidden sidebar-overlay opacity-0 pointer-events-none"
     onclick="toggleMobileSidebar()">
</div>

<div class="flex h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-slate-50">

    <!-- ✅ STUDENT SIDEBAR - Hidden on mobile, fixed on lg+ -->
    @include('layouts.student-sidebar')

    <!-- Main content - Add margin on lg screens to account for fixed sidebar -->
    <div class="flex-1 flex flex-col overflow-hidden lg:ml-60">

        <!-- Mobile Header with Menu Button -->
        <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200/60 px-4 sm:px-6 lg:px-8 py-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <!-- Mobile Menu Button -->
                    <button onclick="toggleMobileSidebar()" 
                            class="lg:hidden p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent tracking-tight">
                            {{ $header ?? 'Student Portal' }}
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-600 mt-0.5">
                            Manage your scholarship applications
                        </p>
                    </div>
                </div>

                <div class="flex items-center space-x-2 sm:space-x-3">
                    <a href="{{ route('profile.edit') }}"
                       class="p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto space-y-6 sm:space-y-8">
                {{ $slot }}
            </div>
        </main>

    </div>
</div>

<script>
    function toggleMobileSidebar() {
        const sidebar = document.getElementById('student-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar) {
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        }
        
        if (overlay) {
            overlay.classList.toggle('opacity-0');
            overlay.classList.toggle('pointer-events-none');
            overlay.classList.toggle('opacity-100');
        }
    }
</script>

</body>
</html>
