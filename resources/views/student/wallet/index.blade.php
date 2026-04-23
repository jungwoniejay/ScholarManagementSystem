<x-student-layout>
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Header Banner --}}
    <div class="rounded-2xl p-6 relative overflow-hidden"
         style="background:linear-gradient(135deg,#0A1628 0%,#0F2044 60%,#1a2d5a 100%);border:1px solid rgba(255,215,0,0.15);">
        <div class="absolute top-0 right-0 w-48 h-48 rounded-full pointer-events-none"
             style="background:radial-gradient(circle,rgba(255,215,0,0.08) 0%,transparent 70%);filter:blur(30px);"></div>
        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:linear-gradient(135deg,#FFD700,#B8860B);box-shadow:0 6px 20px rgba(255,215,0,0.35);">
                    <svg class="w-6 h-6" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">My Wallet</h1>
                    <p class="text-sm" style="color:rgba(255,255,255,0.5);">Manage your scholarship funds</p>
                </div>
            </div>
            <a href="{{ route('student.wallet.withdraw') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold flex-shrink-0 transition"
               style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;"
               onmouseover="this.style.boxShadow='0 6px 20px rgba(255,215,0,0.4)'"
               onmouseout="this.style.boxShadow='none'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Withdraw Funds
            </a>
        </div>
    </div>

    {{-- Balance Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        @foreach([
            ['label'=>'Available Balance','value'=>'₱'.number_format($wallet->balance,2),'color'=>'#FFD700','bg'=>'rgba(255,215,0,0.12)','icon'=>'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
            ['label'=>'Total Received',   'value'=>'₱'.number_format($wallet->total_received,2),'color'=>'#4ADE80','bg'=>'rgba(74,222,128,0.12)','icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label'=>'Total Withdrawn',  'value'=>'₱'.number_format($wallet->total_withdrawn,2),'color'=>'#60A5FA','bg'=>'rgba(96,165,250,0.12)','icon'=>'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'],
        ] as $card)
        <div class="rounded-xl p-5" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:{{ $card['bg'] }};">
                <svg class="w-5 h-5" fill="none" stroke="{{ $card['color'] }}" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/>
                </svg>
            </div>
            <p class="text-2xl font-bold mb-1" style="color:{{ $card['color'] }};">{{ $card['value'] }}</p>
            <p class="text-xs font-medium" style="color:rgba(255,255,255,0.4);">{{ $card['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Transaction History --}}
    <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
        <div class="px-5 py-4" style="border-bottom:1px solid rgba(255,255,255,0.07);">
            <h3 class="font-bold text-white text-sm">Transaction History</h3>
        </div>
        <div>
            @forelse($transactions as $tx)
            <div class="flex items-center justify-between px-5 py-4 gap-4 transition"
                 style="border-bottom:1px solid rgba(255,255,255,0.04);"
                 onmouseover="this.style.background='rgba(255,215,0,0.03)'"
                 onmouseout="this.style.background='transparent'">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background:{{ $tx->type === 'credit' ? 'rgba(74,222,128,0.12)' : 'rgba(255,215,0,0.12)' }};">
                        @if($tx->type === 'credit')
                        <svg class="w-5 h-5" fill="none" stroke="#4ADE80" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        @else
                        <svg class="w-5 h-5" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ $tx->description }}</p>
                        <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.4);">
                            {{ $tx->created_at->format('M d, Y h:i A') }}
                            @if($tx->method) &middot; {{ strtoupper($tx->method) }} @endif
                        </p>
                    </div>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="text-sm font-bold" style="color:{{ $tx->type === 'credit' ? '#4ADE80' : '#FFD700' }};">
                        {{ $tx->type === 'credit' ? '+' : '-' }}₱{{ number_format($tx->amount, 2) }}
                    </p>
                    @php
                        $sc = ['pending'=>['#FBBF24','rgba(251,191,36,0.12)'],'completed'=>['#4ADE80','rgba(74,222,128,0.12)'],'failed'=>['#F87171','rgba(248,113,113,0.12)']];
                        [$tc,$bc] = $sc[$tx->status] ?? ['#8b949e','rgba(139,148,158,0.12)'];
                    @endphp
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full mt-1 inline-block"
                          style="color:{{ $tc }};background:{{ $bc }};">
                        {{ ucfirst($tx->status) }}
                    </span>
                </div>
            </div>
            @empty
            <div class="px-5 py-14 text-center">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3"
                     style="background:rgba(255,215,0,0.08);">
                    <svg width="24" height="24" fill="none" stroke="rgba(255,215,0,0.4)" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <p class="text-sm font-semibold" style="color:rgba(255,255,255,0.4);">No transactions yet</p>
                <p class="text-xs mt-1" style="color:rgba(255,255,255,0.25);">Accept a scholarship award to get started</p>
            </div>
            @endforelse
        </div>
        @if($transactions->hasPages())
        <div class="px-5 py-4" style="border-top:1px solid rgba(255,255,255,0.07);">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>

</div>
</x-student-layout>
