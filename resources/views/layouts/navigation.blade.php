<nav x-data="{ open: false }" style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
            @auth

            {{-- Mobile sidebar toggle --}}
            @if(auth()->user()->role === 'admin')
            <div class="flex items-center lg:hidden mr-2">
                <button onclick="toggleAdminSidebar()" class="p-2 rounded-lg" style="color:#8b949e;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            @elseif(auth()->user()->role === 'donator')
            <div class="flex items-center lg:hidden mr-2">
                <button onclick="openSidebar('donator')" class="p-2 rounded-lg" style="color:#8b949e;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            @endif

            {{-- Nav links per role --}}
            @if(auth()->user()->role === 'admin')
                <div class="hidden sm:flex sm:items-center sm:gap-1 sm:ms-4">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition"
                       style="color:{{ request()->routeIs('admin.dashboard') ? '#FFD700' : '#8b949e' }};">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.students.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition"
                       style="color:{{ request()->routeIs('admin.students.*') ? '#FFD700' : '#8b949e' }};">
                        Students
                    </a>
                    <a href="{{ route('admin.scholarships.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition"
                       style="color:{{ request()->routeIs('admin.scholarships.*') ? '#FFD700' : '#8b949e' }};">
                        Scholarships
                    </a>
                </div>
            @elseif(auth()->user()->role === 'donator')
                <div class="hidden sm:flex sm:items-center sm:gap-1 sm:ms-4">
                    <a href="{{ route('donator.dashboard') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition"
                       style="color:{{ request()->routeIs('donator.dashboard') ? '#FFD700' : '#8b949e' }};">
                        Dashboard
                    </a>
                    <a href="{{ route('donator.donations.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition"
                       style="color:{{ request()->routeIs('donator.donations.*') ? '#FFD700' : '#8b949e' }};">
                        My Donations
                    </a>
                </div>
            @elseif(auth()->user()->role === 'student')
                <div class="hidden sm:flex sm:items-center sm:gap-1 sm:ms-4">
                    <a href="{{ route('student.dashboard') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition"
                       style="color:{{ request()->routeIs('student.dashboard') ? '#FFD700' : '#8b949e' }};">
                        Dashboard
                    </a>
                    <a href="{{ route('student.scholarships.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition"
                       style="color:{{ request()->routeIs('student.scholarships.*') ? '#FFD700' : '#8b949e' }};">
                        Scholarships
                    </a>
                    <a href="{{ route('student.applications.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition"
                       style="color:{{ request()->routeIs('student.applications.*') ? '#FFD700' : '#8b949e' }};">
                        Applications
                    </a>
                </div>
            @endif

            @endauth
            </div>

            {{-- Right side --}}
            <div class="hidden sm:flex sm:items-center sm:gap-3">
            @auth
                {{-- Language switcher --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-xl focus:outline-none transition"
                            style="color:#8b949e;background:rgba(255,255,255,0.05);">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                        {{ strtoupper(app()->getLocale()) }}
                        <svg class="fill-current h-3 w-3 ml-1" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-40 rounded-xl shadow-xl z-50"
                         style="background:#0F2044;border:1px solid #1E3A8A;">
                        <a href="{{ route('lang.switch', 'en') }}" class="flex items-center px-4 py-2 text-sm" style="color:{{ app()->getLocale()==='en'?'#FFD700':'#8b949e' }};">🇺🇸 English</a>
                        <a href="{{ route('lang.switch', 'es') }}" class="flex items-center px-4 py-2 text-sm" style="color:{{ app()->getLocale()==='es'?'#FFD700':'#8b949e' }};">🇪🇸 Español</a>
                        <a href="{{ route('lang.switch', 'fr') }}" class="flex items-center px-4 py-2 text-sm" style="color:{{ app()->getLocale()==='fr'?'#FFD700':'#8b949e' }};">🇫🇷 Français</a>
                    </div>
                </div>

                {{-- User dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-xl focus:outline-none transition"
                                style="color:#e2e8f0;background:rgba(255,255,255,0.05);">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2 text-xs font-bold flex-shrink-0"
                                 style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span style="color:#e2e8f0;">{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-3 w-3 ml-2" style="color:#8b949e;" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-3" style="border-bottom:1px solid #1E3A8A;">
                            <p class="text-sm font-semibold" style="color:#e2e8f0;">{{ Auth::user()->name }}</p>
                            <p class="text-xs mt-0.5" style="color:#8b949e;">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <div style="border-top:1px solid #1E3A8A;"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                style="color:#f87171;">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endauth
            </div>

            {{-- Mobile hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl focus:outline-none transition" style="color:#8b949e;">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="border-top:1px solid #1E3A8A;background:#0A1628;">
        <div class="pt-2 pb-3 space-y-1 px-3">
            <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg" style="color:#8b949e;">
                {{ __('Dashboard') }}
            </a>
        </div>
        @auth
        <div class="pt-4 pb-3" style="border-top:1px solid #1E3A8A;">
            <div class="px-4 mb-3 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center font-bold text-sm flex-shrink-0"
                     style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-semibold text-sm" style="color:#e2e8f0;">{{ Auth::user()->name }}</div>
                    <div class="text-xs" style="color:#8b949e;">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="space-y-1 px-3">
                <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg" style="color:#8b949e;">
                    {{ __('Profile') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg" style="color:#f87171;">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
