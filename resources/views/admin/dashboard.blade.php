@extends('layouts.app')

@section('content')
<div class="min-h-screen p-4 sm:p-6 lg:p-8" style="background:#0d1117;">
    <div class="max-w-7xl mx-auto space-y-6 sm:space-y-8">

        {{-- Welcome Banner --}}
        <div class="rounded-2xl p-6 sm:p-8 relative overflow-hidden"
             style="background:linear-gradient(135deg,#0a1628 0%,#0f2044 60%,#B8860B 100%);">
            <div class="absolute -top-8 -right-8 w-48 h-48 rounded-full opacity-10" style="background:#FFD700;filter:blur(40px);"></div>
            <div class="relative flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center font-bold text-lg flex-shrink-0"
                         style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0a1628;">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-white">Welcome back, {{ Auth::user()->name ?? 'Administrator' }}</h2>
                        <p class="text-sm" style="color:rgba(255,255,255,.65);">Here's what's happening with your scholarship program today.</p>
                    </div>
                </div>
                <a href="{{ route('admin.scholarships.create') }}"
                   class="px-4 py-2 rounded-xl text-sm font-semibold flex-shrink-0 transition-all"
                   style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0a1628;"
                   onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                    + New Scholarship
                </a>
            </div>
        </div>

        {{-- Quick Stats --}}
        @php
            $totalStudents       = \App\Models\Student::count();
            $activeScholarships  = \App\Models\Scholarship::where('status','active')->count();
            $pendingApplications = \App\Models\Application::where('status','pending')->count();
            $totalFunding        = \App\Models\Scholarship::where('status','active')->sum('amount');
            $totalDonors         = \App\Models\Donator::count();
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 sm:gap-6">
            @foreach([
                ['label'=>'Total Students',       'value'=>number_format($totalStudents),      'badge'=>'Active',    'badge_color'=>'#22C55E', 'icon_bg'=>'linear-gradient(135deg,#FFD700,#B8860B)',   'icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ['label'=>'Active Scholarships',  'value'=>number_format($activeScholarships), 'badge'=>'Available', 'badge_color'=>'#60A5FA', 'icon_bg'=>'linear-gradient(135deg,#1e3a8a,#1e40af)', 'icon'=>'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['label'=>'Pending Applications', 'value'=>number_format($pendingApplications),'badge'=>'Review',    'badge_color'=>'#FBBF24', 'icon_bg'=>'linear-gradient(135deg,#B8860B,#FFD700)',   'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                ['label'=>'Total Funding',        'value'=>'₱'.number_format($totalFunding,0), 'badge'=>'100%',      'badge_color'=>'#A78BFA', 'icon_bg'=>'linear-gradient(135deg,#312e81,#4c1d95)', 'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['label'=>'Total Donors',         'value'=>number_format($totalDonors),        'badge'=>'Donors',    'badge_color'=>'#34D399', 'icon_bg'=>'linear-gradient(135deg,#064E3B,#065F46)', 'icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                ['label'=>'Donor Funds',          'value'=>'₱'.number_format($totalFunding,0), 'badge'=>'Funds',     'badge_color'=>'#F87171', 'icon_bg'=>'linear-gradient(135deg,#7f1d1d,#991b1b)', 'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            ] as $stat)
            <div class="rounded-xl p-4 sm:p-5 border transition-all hover:-translate-y-1"
                 style="background:#161b22;border-color:#21262d;box-shadow:0 4px 20px rgba(0,0,0,0.3);">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background:{{ $stat['icon_bg'] }};">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold px-2 py-1 rounded-full"
                          style="color:{{ $stat['badge_color'] }};background:rgba(255,255,255,0.05);">{{ $stat['badge'] }}</span>
                </div>
                <p class="text-xs font-medium mb-1" style="color:#8b949e;">{{ $stat['label'] }}</p>
                <p class="text-2xl font-bold" style="color:#FFD700;">{{ $stat['value'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Recent Activity + Quick Actions --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

            {{-- Recent Applications --}}
            <div class="lg:col-span-2 rounded-xl p-4 sm:p-6 border" style="background:#161b22;border-color:#21262d;">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                             style="background:linear-gradient(135deg,#FFD700,#B8860B);">
                            <svg class="w-4 h-4" fill="none" stroke="#0a1628" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-white">Recent Applications</h3>
                    </div>
                    <a href="{{ route('admin.applications.review') }}" class="text-sm font-medium" style="color:#FFD700;">View all →</a>
                </div>
                <div class="space-y-3">
                    @forelse(\App\Models\Application::with(['student.user','scholarship'])->latest()->take(5)->get() as $application)
                    <a href="{{ route('admin.applications.show', $application->id) }}"
                       class="flex items-center justify-between p-3 rounded-lg transition-colors"
                       style="background:#0d1117;" onmouseover="this.style.background='#1c2128'" onmouseout="this.style.background='#0d1117'">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm"
                                 style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0a1628;">
                                {{ substr($application->student->user->name ?? 'N', 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-white">{{ $application->student->user->name ?? 'Unknown' }}</p>
                                <p class="text-xs truncate max-w-[200px]" style="color:#8b949e;">{{ $application->scholarship->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @php
                                $sc = ['pending'=>['#FBBF24','rgba(251,191,36,0.1)'],'approved'=>['#34D399','rgba(52,211,153,0.1)'],'rejected'=>['#F87171','rgba(248,113,113,0.1)']];
                                [$tc,$bc] = $sc[$application->status] ?? ['#8b949e','rgba(139,148,158,0.1)'];
                            @endphp
                            <span class="text-xs px-2 py-1 rounded-full font-semibold"
                                  style="color:{{ $tc }};background:{{ $bc }};">{{ ucfirst($application->status) }}</span>
                            <span class="text-xs whitespace-nowrap" style="color:#8b949e;">{{ $application->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-6" style="color:#8b949e;">
                        <svg class="w-12 h-12 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p>No applications yet</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="rounded-xl p-4 sm:p-6 border" style="background:#161b22;border-color:#21262d;">
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                         style="background:linear-gradient(135deg,#FFD700,#B8860B);">
                        <svg class="w-4 h-4" fill="none" stroke="#0a1628" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    Quick Actions
                </h3>
                <div class="space-y-2">
                    @foreach([
                        ['href'=>route('admin.scholarships.create'), 'label'=>'New Scholarship',     'color'=>'#FFD700', 'bg'=>'rgba(255,215,0,0.07)',   'icon'=>'M12 6v6m0 0v6m0-6h6m-6 0H6'],
                        ['href'=>route('admin.applications.review'), 'label'=>'Review Applications', 'color'=>'#60A5FA', 'bg'=>'rgba(96,165,250,0.07)',  'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                        ['href'=>route('admin.reports.index'),       'label'=>'View Reports',        'color'=>'#A78BFA', 'bg'=>'rgba(167,139,250,0.07)', 'icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                        ['href'=>route('admin.students.index'),      'label'=>'Manage Students',     'color'=>'#34D399', 'bg'=>'rgba(52,211,153,0.07)',  'icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                        ['href'=>route('admin.settings'),            'label'=>'System Settings',     'color'=>'#F87171', 'bg'=>'rgba(248,113,113,0.07)', 'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                    ] as $action)
                    <a href="{{ $action['href'] }}" class="flex items-center justify-between p-3 rounded-lg transition-all"
                       style="background:{{ $action['bg'] }};"
                       onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="{{ $action['color'] }}" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}"/>
                            </svg>
                            <span class="text-sm font-medium text-white">{{ $action['label'] }}</span>
                        </div>
                        <svg class="w-4 h-4" fill="none" stroke="{{ $action['color'] }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    @endforeach
                </div>

                {{-- System Status --}}
                <div class="mt-6 pt-4" style="border-top:1px solid #21262d;">
                    <h4 class="text-sm font-semibold text-white mb-3">System Status</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full animate-pulse" style="background:#22C55E;"></div>
                                <span class="text-xs" style="color:#8b949e;">All Systems</span>
                            </div>
                            <span class="text-xs font-semibold" style="color:#22C55E;">Operational</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full" style="background:#60A5FA;"></div>
                                <span class="text-xs" style="color:#8b949e;">Database</span>
                            </div>
                            <span class="text-xs font-semibold" style="color:#60A5FA;">Connected</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full" style="background:#FFD700;"></div>
                                <span class="text-xs" style="color:#8b949e;">Last Backup</span>
                            </div>
                            <span class="text-xs font-semibold" style="color:#FFD700;">2 hours ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="text-center pb-8">
            <p class="text-xs" style="color:#8b949e;">Last updated: {{ now()->format('F d, Y - h:i A') }}</p>
        </div>

    </div>
</div>
@endsection
