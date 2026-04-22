<style>
    #student-sidebar { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
    .st-item {
        display: flex; align-items: center; gap: 10px;
        padding: 9px 14px; margin: 1px 8px; border-radius: 10px;
        font-size: 13px; font-weight: 500; color: rgba(255,255,255,0.65);
        text-decoration: none; transition: background 0.15s, color 0.15s;
    }
    .st-item:hover { background: rgba(255,255,255,0.08); color: #fff; }
    .st-item.active {
        background: linear-gradient(135deg, rgba(255,215,0,0.18), rgba(184,134,11,0.12));
        color: #FFD700; font-weight: 600;
        border: 1px solid rgba(255,215,0,0.2);
    }
    .st-item svg { flex-shrink: 0; opacity: 0.6; }
    .st-item:hover svg { opacity: 1; }
    .st-item.active svg { opacity: 1; color: #FFD700; }
    .st-label {
        font-size: 9.5px; font-weight: 700; letter-spacing: 1.2px;
        text-transform: uppercase; color: rgba(255,255,255,0.3);
        padding: 10px 22px 3px;
    }
    .st-divider { height: 1px; background: rgba(255,255,255,0.07); margin: 5px 14px; }
</style>

{{-- Mobile overlay --}}
<div id="student-sidebar-overlay"
     class="fixed inset-0 z-40 lg:hidden"
     style="background:rgba(0,0,0,0.6);display:none;"
     onclick="closeSidebar('student')"></div>

{{-- SIDEBAR --}}
<div id="student-sidebar"
     class="fixed left-0 top-0 bottom-0 w-64 z-50 flex flex-col h-screen overflow-hidden"
     style="background: linear-gradient(180deg, #0A1628 0%, #0F2044 60%, #0A1628 100%); border-right: 1px solid rgba(255,215,0,0.1); box-shadow: 4px 0 24px rgba(0,0,0,0.3); transform: translateX(-100%); transition: transform 0.3s ease;">

    {{-- Glow blob --}}
    <div class="absolute top-0 right-0 w-40 h-40 rounded-full pointer-events-none" style="background:rgba(255,215,0,0.06);filter:blur(40px);"></div>

    {{-- Brand --}}
    <div class="flex items-center gap-3 px-5 py-5" style="border-bottom: 1px solid rgba(255,255,255,0.07);">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
             style="background: linear-gradient(135deg,#FFD700,#B8860B); box-shadow: 0 4px 12px rgba(255,215,0,0.35);">
            <svg width="18" height="18" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13
                         C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                         m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                         v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div>
            <div style="font-size:15px;font-weight:800;color:#fff;letter-spacing:-0.3px;">ScholarHub</div>
            <div style="font-size:10px;color:rgba(255,215,0,0.7);font-weight:500;">Student Portal</div>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 overflow-y-auto py-3" style="scrollbar-width:thin;">

        <a href="{{ route('student.dashboard') }}"
           class="st-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2
                         m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2
                         a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <div class="st-divider"></div>
        <div class="st-label">Scholarships</div>

        <a href="{{ route('student.scholarships.index') }}"
           class="st-item {{ request()->routeIs('student.scholarships.index') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253
                         v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                         m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                         v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            Browse Scholarships
        </a>

        <a href="{{ route('student.scholarships.awarded') }}"
           class="st-item {{ request()->routeIs('student.scholarships.awarded') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Awarded
        </a>

        <a href="{{ route('student.scholarships.status') }}"
           class="st-item {{ request()->routeIs('student.scholarships.status') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2
                         zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2
                         m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Application Status
        </a>

        <div class="st-divider"></div>
        <div class="st-label">My Account</div>

        <a href="{{ route('student.applications.index') }}"
           class="st-item {{ request()->routeIs('student.applications.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586
                         a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            My Applications
        </a>

        <a href="{{ route('student.documents.index') }}"
           class="st-item {{ request()->routeIs('student.documents.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414
                         A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            My Documents
        </a>

        <a href="{{ route('student.wallet.index') }}"
           class="st-item {{ request()->routeIs('student.wallet.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6
                         a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
            My Wallet
        </a>

        <a href="{{ route('profile.edit') }}"
           class="st-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            My Profile
        </a>

    </nav>

    {{-- Footer --}}
    <div class="px-4 py-4" style="border-top: 1px solid rgba(255,255,255,0.07);">
        <div class="flex items-center gap-3 p-3 rounded-xl" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,215,0,0.1);">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm flex-shrink-0"
                 style="background: linear-gradient(135deg,#FFD700,#B8860B); color:#0A1628;">
                {{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-size:12.5px;font-weight:600;color:#fff;" class="truncate">{{ auth()->user()->name ?? 'Student' }}</div>
                <div style="font-size:10.5px;color:rgba(255,215,0,0.6);">Student</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Log out"
                        style="width:28px;height:28px;background:transparent;border:none;cursor:pointer;
                               color:rgba(255,255,255,0.4);border-radius:7px;display:flex;align-items:center;justify-content:center;"
                        onmouseover="this.style.background='rgba(239,68,68,0.15)';this.style.color='#ef4444'"
                        onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.4)'">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6
                                 a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
