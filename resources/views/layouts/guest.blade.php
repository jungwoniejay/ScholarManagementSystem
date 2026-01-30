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
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-emerald-600 via-teal-600 to-green-700 relative overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
            </div>

            <!-- Logo Section -->
            <div class="relative z-10 mb-8">
                <a href="/" class="flex flex-col items-center group">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center shadow-2xl shadow-emerald-900/30 group-hover:scale-105 transition-transform duration-300 mb-4">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-1">ScholarHub</h1>
                    <p class="text-emerald-100 text-sm">Your Path to Educational Success</p>
                </a>
            </div>

            <!-- Main Card -->
            <div class="w-full sm:max-w-md relative z-10">
                <div class="bg-white/95 backdrop-blur-xl shadow-2xl rounded-2xl overflow-hidden border border-white/20">
                    <!-- Decorative Header Bar -->
                    <div class="h-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-green-600"></div>
                    
                    <!-- Content -->
                    <div class="px-8 py-8">
                        {{ $slot }}
                    </div>
                </div>

                <!-- Back to Home Link -->
                <div class="text-center mt-6">
                    <a href="/" class="inline-flex items-center text-sm text-white/90 hover:text-white transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="relative z-10 mt-8 text-center text-white/80 text-sm">
                <p>&copy; {{ date('Y') }} ScholarHub. All rights reserved.</p>
                <div class="flex items-center justify-center space-x-4 mt-2">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <span>•</span>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <span>•</span>
                    <a href="#" class="hover:text-white transition-colors">Contact</a>
                </div>
            </div>

            <!-- Decorative Stats (Optional) -->
            <div class="absolute bottom-8 left-8 right-8 hidden lg:flex justify-between items-center text-white/60 text-xs">
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                    <span>5,000+ Active Scholarships</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-teal-400 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                    <span>50,000+ Students Helped</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
                    <span>$50M+ Awarded</span>
                </div>
            </div>
        </div>

        <style>
            @keyframes pulse-custom {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: 0.5;
                }
            }
            
            .animate-pulse {
                animation: pulse-custom 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
        </style>
    </body>
</html>