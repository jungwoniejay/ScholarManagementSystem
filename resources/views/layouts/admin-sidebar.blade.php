{{-- ============================================================
     Admin Sidebar — ScholarHub (Desktop + Mobile)
     ============================================================ --}}

<style>
    /* ── Sidebar shell ── */
    #admin-sidebar,
    #admin-sidebar-mobile {
        font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        background: #1E1E2E;
        color: #A8A8C0;
    }

    /* ── Section label ── */
    .sb-label {
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1.3px;
        text-transform: uppercase;
        color: rgba(168,168,192,0.4);
        padding: 12px 16px 4px;
    }

    /* ── Nav item base ── */
    .sb-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        margin: 1px 8px;
        border-radius: 9px;
        font-size: 12.5px;
        font-weight: 500;
        color: #A8A8C0;
        text-decoration: none;
        transition: background 0.18s, color 0.18s;
        position: relative;
        white-space: nowrap;
    }
    .sb-item:hover {
        background: rgba(255,255,255,0.06);
        color: #fff;
    }
    .sb-item svg {
        flex-shrink: 0;
        opacity: 0.7;
        transition: opacity 0.18s;
    }
    .sb-item:hover svg { opacity: 1; }

    /* ── Active state ── */
    .sb-item.active {
        background: rgba(234,179,8,0.14);
        color: #EAB308;
    }
    .sb-item.active svg { opacity: 1; color: #EAB308; }

    /* ── Badges ── */
    .sb-badge {
        font-size: 9px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 20px;
        min-width: 18px;
        text-align: center;
        margin-left: auto;
    }
    .sb-badge-amber { background: rgba(234,179,8,0.18); color: #EAB308; }
    .sb-badge-blue  { background: rgba(59,130,246,0.18); color: #60A5FA; }
    .sb-badge-green { background: rgba(34,197,94,0.18);  color: #4ADE80; }
    .sb-badge-red   { background: rgba(239,68,68,0.18);  color: #F87171; }

    /* ── Divider ── */
    .sb-divider {
        height: 1px;
        background: rgba(255,255,255,0.06);
        margin: 6px 16px;
    }

    /* ── Footer user card ── */
    .sb-footer {
        padding: 14px;
        border-top: 1px solid rgba(255,255,255,0.07);
    }
    .sb-user-card {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 10px;
    }
    .sb-avatar {
        width: 34px; height: 34px;
        background: linear-gradient(135deg, #EAB308, #D97706);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 700; color: #1E1E2E;
        flex-shrink: 0;
    }
    .sb-user-name  { font-size: 12.5px; font-weight: 600; color: #fff; line-height: 1.3; }
    .sb-user-role  { font-size: 10.5px; color: rgba(168,168,192,0.6); }
    .sb-logout-btn {
        margin-left: auto;
        width: 30px; height: 30px;
        background: transparent; border: none; cursor: pointer;
        color: rgba(168,168,192,0.5);
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        transition: background 0.18s, color 0.18s;
    }
    .sb-logout-btn:hover { background: rgba(239,68,68,0.12); color: #F87171; }

    /* ── Brand header ── */
    .sb-brand {
        display: flex; align-items: center; gap: 12px;
        padding: 18px 16px 14px;
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    .sb-brand-icon {
        width: 38px; height: 38px;
        background: linear-gradient(135deg, #EAB308, #D97706);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 0 16px rgba(234,179,8,0.25);
        flex-shrink: 0;
    }
    .sb-brand-name { font-size: 15px; font-weight: 800; color: #fff; letter-spacing: -0.3px; }
    .sb-brand-tag  { font-size: 10px; color: rgba(234,179,8,0.7); font-weight: 500; }

    /* ── Scrollbar ── */
    #admin-sidebar nav::-webkit-scrollbar,
    #admin-sidebar-mobile nav::-webkit-scrollbar { width: 3px; }
    #admin-sidebar nav::-webkit-scrollbar-thumb,
    #admin-sidebar-mobile nav::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.1); border-radius: 3px;
    }
</style>

{{-- ── DESKTOP SIDEBAR ─────────────────────────────────────────── --}}
<div id="admin-sidebar"
     class="fixed left-0 top-0 bottom-0 w-64 z-50 hidden lg:flex flex-col h-screen overflow-hidden shadow-xl">

    {{-- Brand --}}
    <div class="sb-brand">
        <div class="sb-brand-icon">
            <svg width="20" height="20" fill="none" stroke="#1E3A8A" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13
                         C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                         m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                         v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div>
            <div class="sb-brand-name">ScholarHub</div>
            <div class="sb-brand-tag">Admin Portal</div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-3" style="scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.1) transparent;">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="sb-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2
                         m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2
                         a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Overview
        </a>

        <div class="sb-divider"></div>

        {{-- User Management --}}
        <div class="sb-label">User Management</div>

        <a href="{{ route('admin.students.index') }}"
           class="sb-item {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1
                         a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            Students
        </a>

        <a href="{{ route('admin.donators.index') }}"
           class="sb-item {{ request()->routeIs('admin.donators.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857
                         M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857
                         m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Donors
        </a>

        <a href="{{ route('admin.accounts.index') }}"
           class="sb-item {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944
                         a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9
                         c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622
                         0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            Admin Accounts
        </a>

        <div class="sb-divider"></div>

        {{-- Scholarship Management --}}
        <div class="sb-label">Scholarship Management</div>

        <a href="{{ route('admin.scholarships.index') }}"
           class="sb-item {{ request()->routeIs('admin.scholarships.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253
                         v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                         m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                         v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            Scholarships
        </a>

        <a href="{{ route('admin.donations.index') }}"
           class="sb-item {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2
                         m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1
                         m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Funds &amp; Donations
        </a>

        <div class="sb-divider"></div>

        {{-- Application Management --}}
        <div class="sb-label">Application Management</div>

        <a href="{{ route('admin.applications.pending') }}"
           class="sb-item {{ request()->routeIs('admin.applications.pending') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pending
            @php $appCounts ??= \App\Models\Application::selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total','status'); @endphp
            <span class="sb-badge sb-badge-amber">{{ $appCounts['pending'] ?? '' ?: '' }}</span>
        </a>

        <a href="{{ route('admin.applications.review') }}"
           class="sb-item {{ request()->routeIs('admin.applications.review') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7
                         a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2
                         M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            Under Review
            <span class="sb-badge sb-badge-blue">{{ $appCounts['review'] ?? '' ?: '' }}</span>
        </a>

        <a href="{{ route('admin.applications.shortlist') }}"
           class="sb-item {{ request()->routeIs('admin.applications.shortlist') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69
                         h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118
                         l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888
                         a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118
                         l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888
                         c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
            Shortlisted
        </a>

        <a href="{{ route('admin.applications.screened') }}"
           class="sb-item {{ request()->routeIs('admin.applications.screened') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707
                         l-6.414 6.414a1 1 0 00-.293.707V17l-1.293 1.293
                         a1 1 0 01-.707.293H7a1 1 0 01-1-1v-2.586
                         a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Screened
        </a>

        <a href="{{ route('admin.applications.completed') }}"
           class="sb-item {{ request()->routeIs('admin.applications.completed') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Completed
            <span class="sb-badge sb-badge-green">{{ $appCounts['completed'] ?? '' ?: '' }}</span>
        </a>

        <a href="{{ route('admin.applications.rejected') }}"
           class="sb-item {{ request()->routeIs('admin.applications.rejected') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2
                         m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Rejected
            <span class="sb-badge sb-badge-red">{{ $appCounts['rejected'] ?? '' ?: '' }}</span>
        </a>

        <div class="sb-divider"></div>

        {{-- Verification & Compliance --}}
        <div class="sb-label">Verification &amp; Compliance</div>

        <a href="{{ route('admin.documents.verify') }}"
           class="sb-item {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586
                         a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Document Verification
        </a>

        <a href="{{ route('admin.rules.index') }}"
           class="sb-item {{ request()->routeIs('admin.rules.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0
                         a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37
                         a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35
                         a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31-2.37 2.37
                         a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0
                         a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37
                         a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35
                         a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37
                         .996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            AI Automation Rules
        </a>

        <div class="sb-divider"></div>

        {{-- Reports & Analytics --}}
        <div class="sb-label">Reports &amp; Analytics</div>

        <a href="{{ route('admin.reports.index') }}"
           class="sb-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2
                         zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2
                         a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14
                         a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Reports
        </a>

        <div class="sb-divider"></div>

        {{-- System Settings --}}
        <div class="sb-label">System Settings</div>

        <a href="{{ route('admin.settings') }}"
           class="sb-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0
                         a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37
                         a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35
                         a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31-2.37 2.37
                         a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0
                         a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37
                         a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35
                         a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37
                         .996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            General Settings
        </a>

        <a href="{{ route('admin.courses.index') }}"
           class="sb-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253
                         v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                         m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                         v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            Courses
        </a>

        <a href="{{ route('admin.announcements.index') }}"
           class="sb-item {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15
                         M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832
                         c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7
                         a3.988 3.988 0 01-1.564-.317z"/>
            </svg>
            Announcements
        </a>

        <a href="{{ route('admin.cookies.index') }}"
           class="sb-item {{ request()->routeIs('admin.cookies.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6
                         a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            Cookie Settings
        </a>

        <a href="{{ route('system.flow') }}"
           class="sb-item {{ request()->routeIs('system.flow') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5
                         a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6
                         a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2
                         a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
            </svg>
            System Flow
        </a>

        <a href="{{ route('admin.maintenance') }}"
           class="sb-item {{ request()->routeIs('admin.maintenance*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0
                         a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37
                         a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35
                         a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31-2.37 2.37
                         a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0
                         a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37
                         a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35
                         a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37
                         .996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Maintenance
        </a>

        <a href="{{ route('admin.activity') }}"
           class="sb-item {{ request()->routeIs('admin.activity*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Activity Monitoring
        </a>

    </nav>

    {{-- User Footer --}}
    <div class="sb-footer">
        <div class="sb-user-card">
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div style="flex:1;min-width:0;">
                <div class="sb-user-name truncate">{{ auth()->user()->name ?? 'Administrator' }}</div>
                <div class="sb-user-role">Admin</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sb-logout-btn" title="Log out">
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


{{-- ── MOBILE OVERLAY ───────────────────────────────────────────── --}}
<div id="admin-sidebar-overlay"
     class="fixed inset-0 bg-black bg-opacity-60 z-40 lg:hidden hidden opacity-0 transition-opacity duration-300 backdrop-blur-sm"
     onclick="closeAdminSidebar()"></div>


{{-- ── MOBILE SIDEBAR ───────────────────────────────────────────── --}}
<div id="admin-sidebar-mobile"
     class="fixed inset-y-0 left-0 z-50 w-64 shadow-2xl transition-transform duration-300 ease-in-out -translate-x-full lg:hidden flex flex-col h-screen overflow-hidden">

    {{-- Mobile Brand Header --}}
    <div class="sb-brand" style="padding-right:8px;">
        <div class="sb-brand-icon">
            <svg width="20" height="20" fill="none" stroke="#1E3A8A" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253
                         v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                         m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                         v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div style="flex:1;">
            <div class="sb-brand-name">ScholarHub</div>
            <div class="sb-brand-tag">Admin Portal</div>
        </div>
        <button onclick="closeAdminSidebar()"
                style="width:30px;height:30px;background:rgba(255,255,255,0.08);border:none;
                       border-radius:7px;cursor:pointer;color:#A8A8C0;
                       display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Nav (mirrors desktop) --}}
    <nav class="flex-1 overflow-y-auto py-3" style="scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.1) transparent;">

        <a href="{{ route('admin.dashboard') }}"
           class="sb-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2
                         m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2
                         a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Overview
        </a>

        <div class="sb-divider"></div>
        <div class="sb-label">User Management</div>

        <a href="{{ route('admin.students.index') }}"
           class="sb-item {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1
                         zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            Students
        </a>

        <a href="{{ route('admin.donators.index') }}"
           class="sb-item {{ request()->routeIs('admin.donators.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2
                         c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857
                         M7 20v-2c0-.656.126-1.283.356-1.857
                         m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Donors
        </a>

        <a href="{{ route('admin.accounts.index') }}"
           class="sb-item {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944
                         a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9
                         c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622
                         0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            Admin Accounts
        </a>

        <div class="sb-divider"></div>
        <div class="sb-label">Scholarship Management</div>

        <a href="{{ route('admin.scholarships.index') }}"
           class="sb-item {{ request()->routeIs('admin.scholarships.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253
                         v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                         m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                         v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            Scholarships
        </a>

        <a href="{{ route('admin.donations.index') }}"
           class="sb-item {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2
                         m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1
                         m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Funds &amp; Donations
        </a>

        <div class="sb-divider"></div>
        <div class="sb-label">Applications</div>

        <a href="{{ route('admin.applications.pending') }}"
           class="sb-item {{ request()->routeIs('admin.applications.pending') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pending
        </a>

        <a href="{{ route('admin.applications.review') }}"
           class="sb-item {{ request()->routeIs('admin.applications.review') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7
                         a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2
                         M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            Under Review
        </a>

        <a href="{{ route('admin.applications.shortlist') }}"
           class="sb-item {{ request()->routeIs('admin.applications.shortlist') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674
                         a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81
                         l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674
                         c.3.922-.755 1.688-1.538 1.118l-3.976-2.888
                         a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118
                         l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888
                         c-.784-.57-.38-1.81.588-1.81h4.914
                         a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
            Shortlisted
        </a>

        <a href="{{ route('admin.applications.screened') }}"
           class="sb-item {{ request()->routeIs('admin.applications.screened') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707
                         l-6.414 6.414a1 1 0 00-.293.707V17l-1.293 1.293
                         a1 1 0 01-.707.293H7a1 1 0 01-1-1v-2.586
                         a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Screened
        </a>

        <a href="{{ route('admin.applications.completed') }}"
           class="sb-item {{ request()->routeIs('admin.applications.completed') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Completed
        </a>

        <a href="{{ route('admin.applications.rejected') }}"
           class="sb-item {{ request()->routeIs('admin.applications.rejected') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2
                         m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Rejected
        </a>

        <div class="sb-divider"></div>
        <div class="sb-label">Verification &amp; Compliance</div>

        <a href="{{ route('admin.documents.verify') }}"
           class="sb-item {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586
                         a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19
                         a2 2 0 01-2 2z"/>
            </svg>
            Document Verification
        </a>

        <a href="{{ route('admin.rules.index') }}"
           class="sb-item {{ request()->routeIs('admin.rules.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0
                         a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37
                         a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35
                         a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31-2.37 2.37
                         a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0
                         a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37
                         a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35
                         a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37
                         .996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            AI Automation Rules
        </a>

        <div class="sb-divider"></div>
        <div class="sb-label">Reports &amp; Analytics</div>

        <a href="{{ route('admin.reports.index') }}"
           class="sb-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2
                         a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10
                         m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2
                         a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Reports
        </a>

        <div class="sb-divider"></div>
        <div class="sb-label">System Settings</div>

        <a href="{{ route('admin.settings') }}"
           class="sb-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0
                         a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37
                         a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35
                         a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31-2.37 2.37
                         a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0
                         a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37
                         a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35
                         a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37
                         .996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            General Settings
        </a>

        <a href="{{ route('admin.courses.index') }}"
           class="sb-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253
                         v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                         m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                         v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            Courses
        </a>

        <a href="{{ route('admin.announcements.index') }}"
           class="sb-item {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15
                         M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832
                         c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7
                         a3.988 3.988 0 01-1.564-.317z"/>
            </svg>
            Announcements
        </a>

        <a href="{{ route('admin.cookies.index') }}"
           class="sb-item {{ request()->routeIs('admin.cookies.*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6
                         a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            Cookie Settings
        </a>

        <a href="{{ route('system.flow') }}"
           class="sb-item {{ request()->routeIs('system.flow') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5
                         a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6
                         a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2
                         a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
            </svg>
            System Flow
        </a>

        <a href="{{ route('admin.maintenance') }}"
           class="sb-item {{ request()->routeIs('admin.maintenance*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0
                         a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37
                         a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35
                         a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31-2.37 2.37
                         a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0
                         a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37
                         a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35
                         a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37
                         .996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Maintenance
        </a>

        <a href="{{ route('admin.activity') }}"
           class="sb-item {{ request()->routeIs('admin.activity*') ? 'active' : '' }}">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Activity Monitoring
        </a>

    </nav>

    {{-- Mobile User Footer --}}
    <div class="sb-footer">
        <div class="sb-user-card">
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div style="flex:1;min-width:0;">
                <div class="sb-user-name truncate">{{ auth()->user()->name ?? 'Administrator' }}</div>
                <div class="sb-user-role">Admin</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sb-logout-btn" title="Log out">
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


{{-- ── JavaScript ───────────────────────────────────────────────── --}}
<script>
function toggleAdminSidebar() {
    const sidebar = document.getElementById('admin-sidebar-mobile');
    const overlay = document.getElementById('admin-sidebar-overlay');
    const isClosed = sidebar.classList.contains('-translate-x-full');
    if (isClosed) {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        requestAnimationFrame(() => overlay.classList.remove('opacity-0'));
    } else {
        closeAdminSidebar();
    }
}

function closeAdminSidebar() {
    const sidebar = document.getElementById('admin-sidebar-mobile');
    const overlay = document.getElementById('admin-sidebar-overlay');
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('opacity-0');
    setTimeout(() => overlay.classList.add('hidden'), 300);
}
</script>