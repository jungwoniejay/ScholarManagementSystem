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
        body { background:#0A1628; }
    </style>
</head>

<body style="background:#0A1628;" class="font-sans antialiased">

<!-- Mobile Sidebar Overlay -->
<div id="sidebar-overlay"
     class="fixed inset-0 z-40 lg:hidden"
     style="background:rgba(0,0,0,0.5);display:none;"
     onclick="toggleMobileSidebar()">
</div>

<div style="background:#0A1628;min-height:100vh;">

    @include('layouts.student-sidebar')

    <div class="flex flex-col min-h-screen" id="student-main-content" style="margin-left:0;">

        <header style="background:rgba(10,22,40,0.9);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,215,0,0.1);" class="px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button onclick="toggleMobileSidebar()"
                            class="lg:hidden p-2 rounded-xl"
                            style="color:rgba(255,215,0,0.7);border:1px solid rgba(255,215,0,0.2);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold" style="color:#FFD700;">
                            {{ $header ?? 'Student Portal' }}
                        </h1>
                        <p class="text-xs sm:text-sm mt-0.5" style="color:rgba(255,255,255,0.4);">
                            Manage your scholarship applications
                        </p>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}"
                   class="p-2 rounded-xl"
                   style="color:rgba(255,215,0,0.6);border:1px solid rgba(255,215,0,0.15);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </a>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8" style="background:#0A1628;">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>

    </div>
</div>

<script>
function toggleMobileSidebar() {
    var sb = document.getElementById('student-sidebar');
    var ov = document.getElementById('sidebar-overlay');
    var isOpen = sb.style.transform === 'translateX(0px)' || sb.style.transform === 'translateX(0)';
    if (isOpen) {
        sb.style.transform = 'translateX(-100%)';
        ov.style.display = 'none';
    } else {
        sb.style.transform = 'translateX(0)';
        ov.style.display = 'block';
    }
}
function handleResize() {
    var sb = document.getElementById('student-sidebar');
    var mc = document.getElementById('student-main-content');
    var ov = document.getElementById('sidebar-overlay');
    if (window.innerWidth >= 1024) {
        sb.style.transform = 'translateX(0)';
        mc.style.marginLeft = '256px';
        ov.style.display = 'none';
    } else {
        sb.style.transform = 'translateX(-100%)';
        mc.style.marginLeft = '0';
    }
}
window.addEventListener('resize', handleResize);
document.addEventListener('DOMContentLoaded', handleResize);
</script>

</body>
</html>
