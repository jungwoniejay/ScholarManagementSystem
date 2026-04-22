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
</head>

<body style="background:#0A1628;" class="font-sans antialiased">

<div class="min-h-screen" style="background: linear-gradient(135deg, #0A1628 0%, #0F2044 60%, #0A1628 100%);">

    {{-- Student Sidebar ONLY --}}
    @include('layouts.student-sidebar')

    {{-- Main Content --}}
    <div class="flex flex-col min-h-screen" id="main-content" style="margin-left:0; transition: margin-left 0.3s ease;">

        {{-- Top Bar --}}
        <header style="background:rgba(10,22,40,0.9);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,215,0,0.1);" class="px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                {{-- Hamburger (mobile only) --}}
                <button class="lg:hidden mr-3 p-2 rounded-lg" style="color:rgba(255,215,0,0.7);border:1px solid rgba(255,215,0,0.2);"
                        onclick="openSidebar('student')">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
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
                <a href="{{ route('profile.edit') }}"
                   class="p-2 rounded-xl transition"
                   style="color:rgba(255,215,0,0.6);border:1px solid rgba(255,215,0,0.15);"
                   onmouseover="this.style.background='rgba(255,215,0,0.08)';this.style.color='#FFD700'"
                   onmouseout="this.style.background='transparent';this.style.color='rgba(255,215,0,0.6)'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </a>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8" style="background:#0A1628;">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>

    </div>
</div>

<script>
function openSidebar(name) {
    document.getElementById(name+'-sidebar').style.transform = 'translateX(0)';
    var ov = document.getElementById(name+'-sidebar-overlay');
    if (ov) ov.style.display = 'block';
}
function closeSidebar(name) {
    document.getElementById(name+'-sidebar').style.transform = 'translateX(-100%)';
    var ov = document.getElementById(name+'-sidebar-overlay');
    if (ov) ov.style.display = 'none';
}
function handleResize() {
    var sb = document.getElementById('student-sidebar');
    var mc = document.getElementById('main-content');
    var ov = document.getElementById('student-sidebar-overlay');
    if (window.innerWidth >= 1024) {
        sb.style.transform = 'translateX(0)';
        if (mc) mc.style.marginLeft = '256px';
        if (ov) ov.style.display = 'none';
    } else {
        sb.style.transform = 'translateX(-100%)';
        if (mc) mc.style.marginLeft = '0';
    }
}
window.addEventListener('resize', handleResize);
document.addEventListener('DOMContentLoaded', handleResize);
</script>

</body>
</html>
