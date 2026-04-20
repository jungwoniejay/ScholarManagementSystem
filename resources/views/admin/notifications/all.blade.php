<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Notifications</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold" style="color:#e2e8f0;">All Notifications</h1>
                <p class="text-sm mt-1" style="color:#8b949e;">System alerts and activity from the last 30 days</p>
            </div>
            <span class="px-3 py-1.5 text-xs font-semibold rounded-full" style="background:rgba(255,215,0,0.15);color:#FFD700;border:1px solid rgba(255,215,0,0.3);">
                {{ $total }} total
            </span>
        </div>

        {{-- Stats --}}
        @php
            $typeCounts = collect($paginatedNotifications)->groupBy('type');
        @endphp
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['label'=>'New Students',    'type'=>'new_student',     'color'=>'#4ade80',  'bg'=>'rgba(34,197,94,0.12)'],
                ['label'=>'New Applications','type'=>'new_application', 'color'=>'#60a5fa',  'bg'=>'rgba(96,165,250,0.12)'],
                ['label'=>'Pending Reviews', 'type'=>'pending_review',  'color'=>'#fbbf24',  'bg'=>'rgba(251,191,36,0.12)'],
                ['label'=>'Documents',       'type'=>'pending_document','color'=>'#a78bfa',  'bg'=>'rgba(167,139,250,0.12)'],
            ] as $s)
            <div class="p-4 rounded-xl" style="background:#0F2044;border:1px solid #1E3A8A;">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold" style="color:#8b949e;">{{ $s['label'] }}</p>
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center" style="background:{{ $s['bg'] }};"></div>
                </div>
                <p class="text-2xl font-bold mt-2" style="color:{{ $s['color'] }};">
                    {{ collect($paginatedNotifications)->where('type', $s['type'])->count() }}
                </p>
            </div>
            @endforeach
        </div>

        {{-- Notifications List --}}
        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="px-5 py-4 flex items-center justify-between" style="border-bottom:1px solid #1E3A8A;">
                <h3 class="text-sm font-semibold" style="color:#e2e8f0;">Recent Notifications</h3>
                <span class="text-xs" style="color:#8b949e;">Showing {{ count($paginatedNotifications) }} of {{ $total }}</span>
            </div>

            @if(count($paginatedNotifications) > 0)
            <div class="divide-y" style="border-color:#1E3A8A;">
                @foreach($paginatedNotifications as $notif)
                @php
                    $colors = [
                        'new_student'      => ['bg'=>'rgba(34,197,94,0.12)',   'color'=>'#4ade80'],
                        'new_application'  => ['bg'=>'rgba(96,165,250,0.12)',  'color'=>'#60a5fa'],
                        'pending_review'   => ['bg'=>'rgba(251,191,36,0.12)',  'color'=>'#fbbf24'],
                        'pending_document' => ['bg'=>'rgba(167,139,250,0.12)', 'color'=>'#a78bfa'],
                        'approved'         => ['bg'=>'rgba(34,197,94,0.12)',   'color'=>'#4ade80'],
                    ];
                    $c = $colors[$notif['type']] ?? ['bg'=>'rgba(96,165,250,0.12)', 'color'=>'#60a5fa'];
                @endphp
                <a href="{{ $notif['link'] }}" class="flex items-start gap-4 px-5 py-4 transition-colors"
                   style="display:flex;" onmouseover="this.style.background='rgba(255,255,255,0.03)'" onmouseout="this.style.background='transparent'">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5"
                         style="background:{{ $c['bg'] }};">
                        @if($notif['type'] === 'new_student')
                            <svg class="w-4 h-4" fill="none" stroke="{{ $c['color'] }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        @elseif($notif['type'] === 'new_application')
                            <svg class="w-4 h-4" fill="none" stroke="{{ $c['color'] }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        @elseif($notif['type'] === 'pending_review')
                            <svg class="w-4 h-4" fill="none" stroke="{{ $c['color'] }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @elseif($notif['type'] === 'pending_document')
                            <svg class="w-4 h-4" fill="none" stroke="{{ $c['color'] }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @else
                            <svg class="w-4 h-4" fill="none" stroke="{{ $c['color'] }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2">
                            <p class="text-sm font-semibold" style="color:#e2e8f0;">{{ $notif['title'] }}</p>
                            <span class="text-xs flex-shrink-0" style="color:#8b949e;">
                                {{ \Carbon\Carbon::parse($notif['time'])->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-sm mt-0.5" style="color:#8b949e;">{{ $notif['message'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($total > $perPage)
            <div class="px-5 py-4 flex items-center justify-between" style="border-top:1px solid #1E3A8A;">
                <span class="text-xs" style="color:#8b949e;">Page {{ $currentPage }} of {{ ceil($total / $perPage) }}</span>
                <div class="flex gap-2">
                    @if($currentPage > 1)
                    <a href="?page={{ $currentPage - 1 }}" class="px-3 py-1.5 text-xs font-medium rounded-lg"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">← Prev</a>
                    @endif
                    @if($currentPage < ceil($total / $perPage))
                    <a href="?page={{ $currentPage + 1 }}" class="px-3 py-1.5 text-xs font-medium rounded-lg"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Next →</a>
                    @endif
                </div>
            </div>
            @endif

            @else
            <div class="px-5 py-16 text-center">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-20" fill="none" stroke="#8b949e" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <p class="text-sm font-semibold" style="color:#8b949e;">No notifications in the last 30 days</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
