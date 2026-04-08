<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'ScholarHub') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <style>
            body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
            @keyframes pulse-glow {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.6; transform: scale(1.1); }
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            @keyframes pulse-dot {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.4; transform: scale(1.3); }
            }
            .feature-card {
                background: rgba(255,255,255,0.07);
                border: 1px solid rgba(255,215,0,0.15);
                border-radius: 12px;
                padding: 1rem 1.25rem;
                display: flex;
                align-items: flex-start;
                gap: 0.875rem;
                transition: background 0.3s;
            }
            .feature-card:hover { background: rgba(255,255,255,0.12); }
            .stat-badge {
                background: rgba(255,215,0,0.12);
                border: 1px solid rgba(255,215,0,0.25);
                border-radius: 999px;
                padding: 0.35rem 1rem;
                font-size: 0.75rem;
                color: #FFD700;
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
            }
        </style>
    </head>
    <body class="font-sans antialiased" style="background:#0A1628;">

        <div class="min-h-screen flex" style="background: linear-gradient(135deg, #0A1628 0%, #0F2044 50%, #1E3A8A 100%);">

            {{-- LEFT PANEL: Features --}}
            <div class="hidden lg:flex flex-col justify-between w-1/2 relative overflow-hidden px-14 py-12" id="left-panel" style="opacity:0;">
                {{-- Glow blobs --}}
                <div class="absolute top-0 right-0 w-80 h-80 rounded-full blur-3xl pointer-events-none" style="background:rgba(255,215,0,0.12);animation:pulse-glow 4s ease-in-out infinite;"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full blur-3xl pointer-events-none" style="background:rgba(184,134,11,0.1);animation:pulse-glow 4s ease-in-out infinite;animation-delay:2s;"></div>

                {{-- Logo --}}
                <div>
                    <a href="/" class="flex items-center gap-3 mb-12">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-lg" style="background:linear-gradient(135deg,#FFD700,#B8860B);box-shadow:0 6px 20px rgba(255,215,0,0.35);">
                            <svg class="w-7 h-7" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white leading-none">ScholarHub</h1>
                            <p class="text-xs mt-0.5" style="color:#FFD700;">Your Path to Educational Success</p>
                        </div>
                    </a>

                    <h2 class="text-3xl font-bold text-white leading-snug mb-3">Empowering Students<br>Through Scholarships</h2>
                    <p class="text-sm mb-8" style="color:rgba(255,255,255,0.6);">Connect with donors, discover opportunities, and fund your future — all in one place.</p>

                    {{-- Stats --}}
                    <div class="flex flex-wrap gap-2 mb-10">
                        <span class="stat-badge">
                            <span style="width:6px;height:6px;border-radius:50%;background:#FFD700;animation:pulse-dot 2s infinite;display:inline-block;"></span>
                            5,000+ Scholarships
                        </span>
                        <span class="stat-badge">
                            <span style="width:6px;height:6px;border-radius:50%;background:#FFD700;animation:pulse-dot 2s infinite;animation-delay:0.5s;display:inline-block;"></span>
                            50,000+ Students
                        </span>
                        <span class="stat-badge">
                            <span style="width:6px;height:6px;border-radius:50%;background:#FFD700;animation:pulse-dot 2s infinite;animation-delay:1s;display:inline-block;"></span>
                            $50M+ Awarded
                        </span>
                    </div>

                    {{-- Features --}}
                    <div class="flex flex-col gap-3">
                        <div class="feature-card">
                            <div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(255,215,0,0.15);">
                                <svg class="w-4 h-4" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-white">Smart Scholarship Matching</p>
                                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.5);">AI-powered recommendations tailored to your profile and goals.</p>
                            </div>
                        </div>
                        <div class="feature-card">
                            <div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(255,215,0,0.15);">
                                <svg class="w-4 h-4" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-white">Easy Application Tracking</p>
                                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.5);">Monitor every application status in real-time from one dashboard.</p>
                            </div>
                        </div>
                        <div class="feature-card">
                            <div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(255,215,0,0.15);">
                                <svg class="w-4 h-4" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-white">Direct Donor Connection</p>
                                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.5);">Bridge the gap between generous donors and deserving students.</p>
                            </div>
                        </div>
                        <div class="feature-card">
                            <div class="mt-0.5 w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(255,215,0,0.15);">
                                <svg class="w-4 h-4" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-white">Secure & Trusted Platform</p>
                                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.5);">Your data and transactions are protected with enterprise-grade security.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer links --}}
                <div class="flex items-center gap-4 text-xs" style="color:rgba(255,255,255,0.4);">
                    <a href="{{ route('privacy-policy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                    <span>•</span>
                    <a href="{{ route('terms-and-conditions') }}" class="hover:text-white transition-colors">Terms of Service</a>
                    <span>•</span>
                    <span>&copy; {{ date('Y') }} ScholarHub</span>
                </div>
            </div>

            {{-- RIGHT PANEL: Form --}}
            <div class="flex flex-col w-full lg:w-1/2 min-h-screen items-center justify-center px-6 py-10 relative" id="right-panel" style="opacity:0;">
                {{-- Mobile logo --}}
                <div class="lg:hidden mb-8 text-center">
                    <a href="/" class="inline-flex flex-col items-center gap-2">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background:linear-gradient(135deg,#FFD700,#B8860B);box-shadow:0 6px 20px rgba(255,215,0,0.35);">
                            <svg class="w-8 h-8" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">ScholarHub</span>
                    </a>
                </div>

                <div class="w-full max-w-md">
                    <div class="rounded-2xl overflow-hidden shadow-2xl" style="background:rgba(255,255,255,0.97);border:1px solid rgba(255,215,0,0.2);">
                        <div class="h-1.5" style="background:linear-gradient(90deg,#FFD700,#B8860B,#FFD700);"></div>
                        <div class="px-8 py-8">
                            {{ $slot }}
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <a href="/" class="inline-flex items-center text-sm transition-colors" style="color:#FFD700;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#FFD700'">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            gsap.to('#left-panel', { opacity: 1, x: 0, duration: 0.9, ease: 'power3.out' });
            gsap.to('#right-panel', { opacity: 1, x: 0, duration: 0.9, delay: 0.2, ease: 'power3.out' });

            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('focus', function() {
                    gsap.to(this, { boxShadow: '0 0 0 3px rgba(255,215,0,0.15)', duration: 0.3 });
                });
                input.addEventListener('blur', function() {
                    gsap.to(this, { boxShadow: '0 0 0 0 rgba(255,215,0,0)', duration: 0.3 });
                });
            });

            document.querySelectorAll('button[type="submit"]').forEach(btn => {
                btn.addEventListener('mouseenter', () => gsap.to(btn, { scale: 1.02, duration: 0.2 }));
                btn.addEventListener('mouseleave', () => gsap.to(btn, { scale: 1, duration: 0.2 }));
            });
        </script>
    </body>
</html>
