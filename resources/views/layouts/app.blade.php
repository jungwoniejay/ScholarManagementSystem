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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans antialiased">

    {{-- Sidebar --}}
    @if(auth()->user()->isAdmin())
    @include('layouts.sidebar')

    @elseif(auth()->user()->isDonator())
        @include('layouts.donator-sidebar')

    @else
        @include('layouts.students-sidebar')
    @endif


    {{-- Main content --}}
    <div class="ml-64 min-h-screen flex flex-col">
        {{-- Navigation (if any) --}}
        @include('layouts.navigation')

        {{-- Page Heading --}}
        @isset($header)
            <header class="bg-white shadow">
                    <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-9">
                        {{ $header }}
                    </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main class="flex-1 p-6 overflow-auto">
            @if(isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </main>
    </div>

    {{-- Toast Notifications --}}
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <script>
        window.showToast = function(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            const bgColors = {
                success: 'bg-emerald-500',
                error: 'bg-red-500',
                warning: 'bg-amber-500',
                info: 'bg-blue-500'
            };

            toast.className = `${bgColors[type]} text-white px-6 py-4 rounded-lg shadow-lg transition-all duration-300 max-w-sm`;
            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>${message}</span>
                </div>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        };
    </script>
</body>
</html>
