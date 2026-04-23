<style>
    #student-sidebar,
    #student-sidebar-mobile {
        font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        background: linear-gradient(180deg, #0A1628 0%, #0F2044 100%);
        color: #A8A8C0;
    }
    .st-label {
        font-size: 9px; font-weight: 700; letter-spacing: 1.3px;
        text-transform: uppercase; color: rgba(168,168,192,0.75);
        padding: 12px 16px 4px;
    }
    .st-item {
        display: flex; align-items: center; gap: 10px;
        padding: 8px 12px; margin: 1px 8px; border-radius: 9px;
        font-size: 12.5px; font-weight: 500; color: #A8A8C0;
        text-decoration: none; transition: background 0.18s, color 0.18s;
        position: relative; white-space: nowrap;
    }
    .st-item:hover { background: rgba(255,255,255,0.06); color: #fff; }
    .st-item svg { flex-shrink: 0; opacity: 0.7; transition: opacity 0.18s; }
    .st-item:hover svg { opacity: 1; }
    .st-item.active {
        background: linear-gradient(90deg, rgba(255,215,0,0.15), rgba(184,134,11,0.1));
        color: #FFD700; border-left: 3px solid #FFD700; padding-left: 9px;
    }
    .st-item.active svg { opacity: 1; color: #FFD700; }
    .st-divider { height: 1px; background: rgba(255,255,255,0.06); margin: 6px 16px; }
    .st-footer { padding: 14px; border-top: 1px solid rgba(255,255,255,0.07); }
    .st-user-card {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.07); border-radius: 10px;
    }
    .st-avatar {
        width: 34px; height: 34px;
        background: linear-gradient(135deg, #FFD700, #B8860B);
        border-radius: 8px; display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 700; color: #0A1628; flex-shrink: 0;
    }
    .st-user-name { font-size: 12.5px; font-weight: 600; color: #fff; line-height: 1.3; }
    .st-user-role { font-size: 10.5px; color: rgba(168,168,192,0.6); }
    .st-logout-btn {
        margin-left: auto; width: 30px; height: 30px;
        background: transparent; border: none; cursor: pointer;
        color: rgba(168,168,192,0.5); border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        transition: background 0.18s, color 0.18s;
    }
    .st-logout-btn:hover { background: rgba(239,68,68,0.12); color: #F87171; }
    .st-brand {
        display: flex; align-items: center; gap: 12px;
        padding: 18px 16px 14px; border-bottom: 1px solid rgba(255,215,0,0.1);
    }
    .st-brand-icon {
        width: 38px; height: 38px;
        background: linear-gradient(135deg, #FFD700, #B8860B);
        border-radius: 10px; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 0 20px rgba(255,215,0,0.3); flex-shrink: 0;
    }
    .st-brand-name { font-size: 15px; font-weight: 800; color: #fff; letter-spacing: -0.3px; }
    .st-brand-tag  { font-size: 10px; color: #FFD700; font-weight: 500; }
    #student-sidebar nav::-webkit-scrollbar,
    #student-sidebar-mobile nav::-webkit-scrollbar { width: 3px; }
    #student-sidebar nav::-webkit-scrollbar-thumb,
    #student-sidebar-mobile nav::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.1); border-radius: 3px;
    }
</style>

{{-- ── DESKTOP SIDEBAR ── --}}
<div id="student-sidebar"
     class="fixed left-0 top-0 bottom-0 w-64 z-50 hidden lg:flex flex-col h-screen overflow-hidden shadow-xl">

    <div class="st-brand">
        <div class="st-brand-icon">
            <svg width="20" height="20" fill="none" stroke="#1E3A8A" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13
                         C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                         m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                         v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div>
            <div class="st-brand-name">ScholarHub</div>
            <div class="st-brand-tag">Student Portal</div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-3" style="scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.1) transparent;">

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

    <div class="st-footer">
        <div class="st-user-card">
            <div class="st-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}</div>
            <div style="flex:1;min-width:0;">
                <div class="st-user-name truncate">{{ auth()->user()->name ?? 'Student' }}</div>
                <div class="st-user-role">Student</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="st-logout-btn" title="Log out">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6
                                 a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>


{{-- ── MOBILE OVERLAY ── --}}
<div id="student-sidebar-overlay"
     class="fixed inset-0 bg-black bg-opacity-60 z-40 lg:hidden hidden opacity-0 transition-opacity duration-300 backdrop-blur-sm"
     onclick="closeStudentSidebar()"></div>


{{-- ── MOBILE SIDEBAR ── --}}
<div id="student-sidebar-mobile"
     class="fixed inset-y-0 left-0 z-50 w-64 shadow-2xl transition-transform duration-300 ease-in-out -translate-x-full lg:hidden flex flex-col h-screen overflow-hidden">

    <div class="st-brand" style="padding-right:8px;">
        <div class="st-brand-icon">
            <svg width="20" height="20" fill="none" stroke="#1E3A8A" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253
                         v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                         m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                         v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div style="flex:1;">
            <div class="st-brand-name">ScholarHub</div>
            <div class="st-brand-tag">Student Portal</div>
        </div>
        <button onclick="closeStudentSidebar()"
                style="width:30px;height:30px;background:rgba(255,255,255,0.08);border:none;
                       border-radius:7px;cursor:pointer;color:#A8A8C0;
                       display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-3" style="scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.1) transparent;">

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

    <div class="st-footer">
        <div class="st-user-card">
            <div class="st-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}</div>
            <div style="flex:1;min-width:0;">
                <div class="st-user-name truncate">{{ auth()->user()->name ?? 'Student' }}</div>
                <div class="st-user-role">Student</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="st-logout-btn" title="Log out">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6
                                 a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>


{{-- ── JavaScript ── --}}
<script>
function openStudentSidebar() {
    const sidebar = document.getElementById('student-sidebar-mobile');
    const overlay = document.getElementById('student-sidebar-overlay');
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
    requestAnimationFrame(() => overlay.classList.remove('opacity-0'));
}

function closeStudentSidebar() {
    const sidebar = document.getElementById('student-sidebar-mobile');
    const overlay = document.getElementById('student-sidebar-overlay');
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('opacity-0');
    setTimeout(() => overlay.classList.add('hidden'), 300);
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script>
window.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap !== 'undefined') {
        gsap.from('#student-sidebar .st-item', {
            opacity: 0, x: -15, duration: 0.4,
            stagger: 0.03, ease: 'power2.out', delay: 0.2
        });
        document.querySelectorAll('.st-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active'))
                    gsap.to(this, { x: 4, duration: 0.2, ease: 'power2.out' });
            });
            item.addEventListener('mouseleave', function() {
                gsap.to(this, { x: 0, duration: 0.2, ease: 'power2.out' });
            });
        });
    }
});
</script>
