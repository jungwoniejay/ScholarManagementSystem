<x-student-layout>
@php
    $studentId = auth()->user()->student->id ?? null;
    $userApplications = $studentId ? \App\Models\Application::where('student_id',$studentId)->latest()->take(5)->get() : collect();
    $totalApplications = $studentId ? \App\Models\Application::where('student_id',$studentId)->count() : 0;
    $approvedApplications = $studentId ? \App\Models\Application::where('student_id',$studentId)->where('status','approved')->count() : 0;
    $pendingApplications = $studentId ? \App\Models\Application::where('student_id',$studentId)->where('status','pending')->count() : 0;
    $availableScholarships = \App\Models\Scholarship::where('status','active')->where('approval_status','approved')->count();
    $featuredScholarships = \App\Models\Scholarship::where('status','active')->where('approval_status','approved')->latest()->take(3)->get();
@endphp

<style>
    .dash-card {
        background: linear-gradient(135deg, #0A1628 0%, #0F2044 100%);
        border: 1px solid rgba(255,215,0,0.1);
        border-radius: 16px;
        transition: border-color 0.3s, transform 0.3s, box-shadow 0.3s;
    }
    .dash-card:hover {
        border-color: rgba(255,215,0,0.3);
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.4), 0 0 20px rgba(255,215,0,0.05);
    }
    .stat-card {
        background: linear-gradient(135deg, #0A1628 0%, #0F2044 100%);
        border: 1px solid rgba(255,215,0,0.1);
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(255,215,0,0.4), transparent);
        transform: scaleX(0);
        transition: transform 0.3s;
    }
    .stat-card:hover::before { transform: scaleX(1); }
    .stat-card:hover {
        border-color: rgba(255,215,0,0.25);
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.4);
    }
    .gold-btn {
        background: linear-gradient(135deg, #FFD700, #B8860B);
        color: #0A1628;
        font-weight: 700;
        border-radius: 10px;
        padding: 0.5rem 1.25rem;
        font-size: 0.8rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: box-shadow 0.3s, transform 0.2s;
    }
    .gold-btn:hover {
        box-shadow: 0 6px 20px rgba(255,215,0,0.4);
        transform: translateY(-1px);
    }
    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-icon {
        width: 32px; height: 32px;
        background: linear-gradient(135deg, #FFD700, #B8860B);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 12px rgba(255,215,0,0.3);
        flex-shrink: 0;
    }
    .app-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.85rem 1rem;
        border-radius: 12px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.05);
        transition: background 0.2s, border-color 0.2s;
    }
    .app-row:hover {
        background: rgba(255,215,0,0.05);
        border-color: rgba(255,215,0,0.15);
    }
    .sch-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 14px;
        padding: 1.25rem;
        transition: all 0.3s;
    }
    .sch-card:hover {
        background: rgba(255,215,0,0.04);
        border-color: rgba(255,215,0,0.2);
        transform: translateY(-2px);
    }
</style>

<div class="max-w-7xl mx-auto space-y-6 p-4 sm:p-6">

    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden rounded-2xl p-6 sm:p-8"
         style="background: linear-gradient(135deg, #0A1628 0%, #0F2044 50%, #1a2d5a 100%);
                border: 1px solid rgba(255,215,0,0.15);
                box-shadow: 0 8px 32px rgba(0,0,0,0.4);">

        {{-- Glow blobs --}}
        <div class="absolute top-0 right-0 w-64 h-64 rounded-full pointer-events-none"
             style="background:radial-gradient(circle, rgba(255,215,0,0.08) 0%, transparent 70%); filter:blur(40px);"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full pointer-events-none"
             style="background:radial-gradient(circle, rgba(30,58,138,0.5) 0%, transparent 70%); filter:blur(40px);"></div>

        {{-- Grid lines --}}
        <div class="absolute inset-0 pointer-events-none" style="
            background-image: linear-gradient(rgba(255,215,0,0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,215,0,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            border-radius: 16px;"></div>

        <div class="relative flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                {{-- Avatar --}}
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center font-bold text-xl flex-shrink-0"
                     style="background: linear-gradient(135deg,#FFD700,#B8860B); color:#0A1628;
                            box-shadow: 0 6px 20px rgba(255,215,0,0.4);">
                    {{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}
                </div>
                <div>
                    <div style="font-size:0.7rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,215,0,0.7);margin-bottom:4px;">
                        Student Portal
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-white">
                        Welcome back, <span style="color:#FFD700;">{{ auth()->user()->name ?? 'Student' }}</span>
                    </h2>
                    <p class="text-sm mt-1" style="color:rgba(255,255,255,0.55);">
                        Track your applications and discover new scholarship opportunities.
                    </p>
                </div>
            </div>
            <a href="{{ route('student.scholarships.index') }}" class="gold-btn flex-shrink-0">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                </svg>
                Browse Scholarships
            </a>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach([
            ['label'=>'Total Applications','value'=>$totalApplications,'color'=>'#60A5FA','glow'=>'rgba(96,165,250,0.15)','icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z','bg'=>'rgba(96,165,250,0.12)'],
            ['label'=>'Approved','value'=>$approvedApplications,'color'=>'#4ADE80','glow'=>'rgba(74,222,128,0.15)','icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z','bg'=>'rgba(74,222,128,0.12)'],
            ['label'=>'Pending Review','value'=>$pendingApplications,'color'=>'#FBBF24','glow'=>'rgba(251,191,36,0.15)','icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z','bg'=>'rgba(251,191,36,0.12)'],
            ['label'=>'Available','value'=>$availableScholarships,'color'=>'#FFD700','glow'=>'rgba(255,215,0,0.15)','icon'=>'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253','bg'=>'rgba(255,215,0,0.12)'],
        ] as $stat)
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:{{ $stat['bg'] }};">
                    <svg width="18" height="18" fill="none" stroke="{{ $stat['color'] }}" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/>
                    </svg>
                </div>
                <div class="w-2 h-2 rounded-full" style="background:{{ $stat['color'] }};box-shadow:0 0 6px {{ $stat['color'] }};"></div>
            </div>
            <p class="text-2xl sm:text-3xl font-bold mb-1" style="color:{{ $stat['color'] }};">
                {{ number_format($stat['value']) }}
            </p>
            <p class="text-xs font-medium" style="color:rgba(255,255,255,0.45);">{{ $stat['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Recent Applications --}}
        <div class="lg:col-span-2 dash-card p-5">
            <div class="flex items-center justify-between mb-5">
                <div class="section-title">
                    <div class="section-icon">
                        <svg width="15" height="15" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    Recent Applications
                </div>
                <a href="{{ route('student.applications.index') }}" class="text-xs font-semibold" style="color:rgba(255,215,0,0.7);">
                    View all →
                </a>
            </div>

            <div class="space-y-2">
                @forelse($userApplications as $app)
                @php
                    $sc = [
                        'pending'     => ['#FBBF24','rgba(251,191,36,0.12)'],
                        'approved'    => ['#4ADE80','rgba(74,222,128,0.12)'],
                        'rejected'    => ['#F87171','rgba(248,113,113,0.12)'],
                        'shortlisted' => ['#60A5FA','rgba(96,165,250,0.12)'],
                        'review'      => ['#A78BFA','rgba(167,139,250,0.12)'],
                        'completed'   => ['#4ADE80','rgba(74,222,128,0.12)'],
                    ];
                    [$tc,$bc] = $sc[$app->status] ?? ['#8b949e','rgba(139,148,158,0.12)'];
                @endphp
                <div class="app-row">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center font-bold text-sm flex-shrink-0"
                             style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                            {{ strtoupper(substr($app->scholarship->name ?? 'S', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $app->scholarship->name ?? 'Scholarship' }}</p>
                            <p class="text-xs" style="color:rgba(255,255,255,0.4);">{{ $app->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 rounded-full" style="color:{{ $tc }};background:{{ $bc }};">
                        {{ ucfirst($app->status) }}
                    </span>
                </div>
                @empty
                <div class="text-center py-10">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3" style="background:rgba(255,215,0,0.08);">
                        <svg width="24" height="24" fill="none" stroke="rgba(255,215,0,0.4)" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold" style="color:rgba(255,255,255,0.4);">No applications yet</p>
                    <p class="text-xs mt-1" style="color:rgba(255,255,255,0.25);">Browse scholarships to get started</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="dash-card p-5">
            <div class="section-title mb-5">
                <div class="section-icon">
                    <svg width="15" height="15" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                Quick Actions
            </div>
            <div class="space-y-2">
                @foreach([
                    ['label'=>'Browse Scholarships','sub'=>'Find new opportunities','route'=>'student.scholarships.index','icon'=>'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253','color'=>'#FFD700'],
                    ['label'=>'My Applications','sub'=>'Track your progress','route'=>'student.applications.index','icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z','color'=>'#60A5FA'],
                    ['label'=>'My Documents','sub'=>'Upload & manage files','route'=>'student.documents.index','icon'=>'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z','color'=>'#A78BFA'],
                    ['label'=>'My Wallet','sub'=>'View your balance','route'=>'student.wallet.index','icon'=>'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z','color'=>'#4ADE80'],
                    ['label'=>'Application Status','sub'=>'Check all statuses','route'=>'student.scholarships.status','icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z','color'=>'#FBBF24'],
                ] as $link)
                <a href="{{ route($link['route']) }}"
                   class="flex items-center gap-3 p-3 rounded-xl transition-all"
                   style="border:1px solid rgba(255,255,255,0.05);"
                   onmouseover="this.style.background='rgba(255,215,0,0.05)';this.style.borderColor='rgba(255,215,0,0.15)'"
                   onmouseout="this.style.background='transparent';this.style.borderColor='rgba(255,255,255,0.05)'">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                         style="background:rgba(255,255,255,0.05);">
                        <svg width="14" height="14" fill="none" stroke="{{ $link['color'] }}" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white">{{ $link['label'] }}</p>
                        <p class="text-xs" style="color:rgba(255,255,255,0.35);">{{ $link['sub'] }}</p>
                    </div>
                    <svg width="12" height="12" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Featured Scholarships --}}
    <div class="dash-card p-5">
        <div class="flex items-center justify-between mb-5">
            <div class="section-title">
                <div class="section-icon">
                    <svg width="15" height="15" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                Featured Scholarships
            </div>
            <a href="{{ route('student.scholarships.index') }}" class="text-xs font-semibold" style="color:rgba(255,215,0,0.7);">
                View all →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @forelse($featuredScholarships as $scholarship)
            <div class="sch-card">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm flex-shrink-0"
                         style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                        {{ strtoupper(substr($scholarship->name, 0, 1)) }}
                    </div>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full" style="background:rgba(74,222,128,0.12);color:#4ADE80;">
                        Active
                    </span>
                </div>
                <h4 class="text-sm font-bold text-white mb-1 truncate">{{ $scholarship->name }}</h4>
                <p class="text-xs mb-3 line-clamp-2" style="color:rgba(255,255,255,0.4);">
                    {{ $scholarship->description ?? 'No description available.' }}
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold" style="color:#FFD700;">
                        ₱{{ number_format($scholarship->amount ?? 0) }}
                    </span>
                    <a href="{{ route('student.scholarships.show', $scholarship) }}"
                       class="text-xs font-semibold" style="color:rgba(255,215,0,0.7);">
                        Apply →
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-8">
                <p class="text-sm" style="color:rgba(255,255,255,0.3);">No scholarships available right now.</p>
            </div>
            @endforelse
        </div>
    </div>

</div>
</x-student-layout>
