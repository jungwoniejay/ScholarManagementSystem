@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    @php
        $donator = \App\Models\Donator::where('user_id', auth()->id())->first();
        $totalFund       = $donator->total_fund ?? 0;
        $availableFund   = $donator->available_fund ?? 0;
        $scholarshipsFunded = $donator
            ? \App\Models\Donation::where('donator_id', $donator->donator_id)
                ->where('approval_status', 'approved')
                ->whereNotNull('scholarship_id')
                ->distinct('scholarship_id')
                ->count('scholarship_id')
            : 0;
        $activeScholarships = \App\Models\Scholarship::where('status','active')->count();

        $pendingDonations  = $donator
            ? \App\Models\Donation::with('scholarship')->where('donator_id', $donator->donator_id)->where('approval_status','pending')->latest()->get()
            : collect();
        $approvedDonations = $donator
            ? \App\Models\Donation::with('scholarship')->where('donator_id', $donator->donator_id)->where('approval_status','approved')->latest()->take(5)->get()
            : collect();
        $pendingTotal = $pendingDonations->sum('amount');

        $fundedScholarships = $donator
            ? \App\Models\Donation::with('scholarship')
                ->where('donator_id', $donator->donator_id)
                ->where('approval_status', 'approved')
                ->whereNotNull('scholarship_id')
                ->get()
                ->groupBy('scholarship_id')
            : collect();
    @endphp

    {{-- Welcome Banner --}}
    <div class="rounded-2xl p-6 sm:p-8 relative overflow-hidden" style="background:linear-gradient(135deg,#0F2044 0%,#1E3A8A 60%,#FFD700 100%);">
        <div class="absolute -top-8 -right-8 w-48 h-48 rounded-full opacity-10" style="background:#FFD700;filter:blur(40px);"></div>
        <div class="relative flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center font-bold text-lg flex-shrink-0"
                 style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                {{ substr(Auth::user()->name ?? 'D', 0, 1) }}
            </div>
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-white">Welcome back, {{ Auth::user()->name ?? 'Donor' }}</h2>
                <p class="text-sm" style="color:rgba(255,255,255,.65);">Track your contributions and funded scholarships.</p>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach([
            ['label'=>'Total Fund',           'value'=>'₱'.number_format($totalFund,2),        'badge'=>'Approved',  'color'=>'#FFD700', 'bg'=>'linear-gradient(135deg,#FFD700,#B8860B)',    'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label'=>'Available Fund',        'value'=>'₱'.number_format($availableFund,2),    'badge'=>'Available', 'color'=>'#22C55E', 'bg'=>'linear-gradient(135deg,#064E3B,#065F46)',    'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label'=>'Pending Approval',      'value'=>'₱'.number_format($pendingTotal,2),     'badge'=>'Pending',   'color'=>'#FBBF24', 'bg'=>'linear-gradient(135deg,#B8860B,#92400e)',    'icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label'=>'Scholarships Funded',   'value'=>number_format($scholarshipsFunded),     'badge'=>'Funded',    'color'=>'#60A5FA', 'bg'=>'linear-gradient(135deg,#1E3A8A,#1e40af)',    'icon'=>'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        ] as $stat)
        <div class="rounded-xl p-5 border" style="background:#0F2044;border-color:#1E3A8A;">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background:{{ $stat['bg'] }};">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold px-2 py-1 rounded-full" style="color:{{ $stat['color'] }};background:rgba(255,255,255,0.05);">{{ $stat['badge'] }}</span>
            </div>
            <p class="text-xs font-medium mb-1" style="color:#8b949e;">{{ $stat['label'] }}</p>
            <p class="text-2xl font-bold" style="color:#FFD700;">{{ $stat['value'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Pending Donations (awaiting admin approval) --}}
    @if($pendingDonations->count() > 0)
    <div class="rounded-xl border p-6" style="background:#0F2044;border-color:rgba(251,191,36,0.3);">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(251,191,36,0.15);">
                <svg class="w-4 h-4" fill="none" stroke="#FBBF24" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-base font-bold text-white">Donations Awaiting Admin Approval</h3>
            <span class="px-2 py-0.5 rounded-full text-xs font-bold" style="background:rgba(251,191,36,0.15);color:#FBBF24;">{{ $pendingDonations->count() }} pending</span>
        </div>
        <div class="space-y-3">
            @foreach($pendingDonations as $donation)
            <div class="flex items-center justify-between p-4 rounded-lg" style="background:#0A1628;border:1px solid rgba(251,191,36,0.15);">
                <div>
                    <p class="text-sm font-semibold text-white">₱{{ number_format($donation->amount, 2) }}</p>
                    <p class="text-xs mt-0.5" style="color:#8b949e;">
                        {{ $donation->scholarship->name ?? 'General Fund' }} &middot; {{ $donation->donation_date?->format('M d, Y') }}
                        @if($donation->method) &middot; {{ $donation->method }} @endif
                    </p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background:rgba(251,191,36,0.15);color:#FBBF24;">⏳ Pending</span>
            </div>
            @endforeach
        </div>
        <p class="text-xs mt-3" style="color:#8b949e;">Funds will be credited to your account once the admin approves each donation.</p>
    </div>
    @endif

    {{-- Recent Approved Donations --}}
    @if($approvedDonations->count() > 0)
    <div class="rounded-xl border p-6" style="background:#0F2044;border-color:#1E3A8A;">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(34,197,94,0.15);">
                <svg class="w-4 h-4" fill="none" stroke="#22C55E" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-base font-bold text-white">Recent Approved Donations</h3>
        </div>
        <div class="space-y-3">
            @foreach($approvedDonations as $donation)
            <div class="flex items-center justify-between p-4 rounded-lg" style="background:#0A1628;">
                <div>
                    <p class="text-sm font-semibold text-white">₱{{ number_format($donation->amount, 2) }}</p>
                    <p class="text-xs mt-0.5" style="color:#8b949e;">
                        {{ $donation->scholarship->name ?? 'General Fund' }} &middot; {{ $donation->approved_at?->format('M d, Y') ?? $donation->donation_date->format('M d, Y') }}
                    </p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background:rgba(34,197,94,0.15);color:#22C55E;">✓ Approved</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Funded Scholarships --}}
    <div class="rounded-xl border p-6" style="background:#0F2044;border-color:#1E3A8A;">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#FFD700,#B8860B);">
                <svg class="w-4 h-4" fill="none" stroke="#0a1628" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="text-base font-bold text-white">Your Funded Scholarships</h3>
        </div>
        <div class="space-y-3">
            @forelse($fundedScholarships as $scholarshipId => $donations)
            @php $scholarship = $donations->first()->scholarship; @endphp
            <div class="flex items-center justify-between p-4 rounded-lg" style="background:#0A1628;"
                 onmouseover="this.style.background='#0F2044'" onmouseout="this.style.background='#0A1628'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold"
                         style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                        {{ substr($scholarship->name ?? '?', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-white text-sm">{{ $scholarship->name ?? 'N/A' }}</p>
                        <p class="text-xs" style="color:#8b949e;">
                            ₱{{ number_format($scholarship->amount ?? 0, 2) }} &middot; {{ $scholarship->academic_year ?? '' }}
                            &middot; Total donated: <span style="color:#FFD700;">₱{{ number_format($donations->sum('amount'), 2) }}</span>
                        </p>
                    </div>
                </div>
                <span class="text-xs px-3 py-1 rounded-full font-semibold" style="background:rgba(34,197,94,0.15);color:#22C55E;">Funded</span>
            </div>
            @empty
            <div class="text-center py-8" style="color:#8b949e;">
                <svg class="w-12 h-12 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <p class="font-semibold">No funded scholarships yet</p>
                <p class="text-sm mt-1">Add a donation to start supporting education</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
