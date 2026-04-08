<x-student-layout>
<div class="p-4 sm:p-6 lg:p-8">

    {{-- Header --}}
    <div class="rounded-2xl p-6 mb-6 relative overflow-hidden"
         style="background:linear-gradient(135deg,#052e16 0%,#064E3B 60%,#B8860B 100%);">
        <div class="absolute -top-8 -right-8 w-40 h-40 rounded-full opacity-10" style="background:#FFD700;filter:blur(30px);"></div>
        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:linear-gradient(135deg,#FFD700,#B8860B);">
                    <svg class="w-6 h-6" fill="none" stroke="#052e16" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">My Wallet</h2>
                    <p class="text-sm" style="color:rgba(255,255,255,.7);">Manage your scholarship funds</p>
                </div>
            </div>
            <a href="{{ route('student.wallet.withdraw') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold flex-shrink-0"
               style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#052e16;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Withdraw Funds
            </a>
        </div>
    </div>

    {{-- Balance Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        @foreach([
            ['label'=>'Available Balance', 'value'=>'₱'.number_format($wallet->balance,2), 'color'=>'#FFD700',  'bg'=>'#FEFCE8', 'icon'=>'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
            ['label'=>'Total Received',    'value'=>'₱'.number_format($wallet->total_received,2),  'color'=>'#22C55E', 'bg'=>'#F0FDF4', 'icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label'=>'Total Withdrawn',   'value'=>'₱'.number_format($wallet->total_withdrawn,2), 'color'=>'#064E3B', 'bg'=>'#ECFDF5', 'icon'=>'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'],
        ] as $card)
        <div class="bg-white rounded-2xl p-5 shadow-sm border" style="border-color:#E5E7EB;">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background:{{ $card['bg'] }};">
                <svg class="w-5 h-5" fill="none" stroke="{{ $card['color'] }}" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/>
                </svg>
            </div>
            <p class="text-2xl font-bold" style="color:#1F2937;">{{ $card['value'] }}</p>
            <p class="text-xs font-medium mt-0.5" style="color:#6B7280;">{{ $card['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Transaction History --}}
    <div class="bg-white rounded-2xl shadow-sm border" style="border-color:#E5E7EB;">
        <div class="px-6 py-4" style="border-bottom:1px solid #F3F4F6;">
            <h3 class="font-bold" style="color:#1F2937;">Transaction History</h3>
        </div>
        <div class="divide-y" style="divide-color:#F9FAFB;">
            @forelse($transactions as $tx)
            <div class="px-6 py-4 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background:{{ $tx->type === 'credit' ? '#F0FDF4' : '#FEFCE8' }};">
                        @if($tx->type === 'credit')
                        <svg class="w-5 h-5" fill="none" stroke="#22C55E" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        @else
                        <svg class="w-5 h-5" fill="none" stroke="#B8860B" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold truncate" style="color:#1F2937;">{{ $tx->description }}</p>
                        <p class="text-xs" style="color:#6B7280;">
                            {{ $tx->created_at->format('M d, Y h:i A') }}
                            @if($tx->method) · {{ strtoupper($tx->method) }} @endif
                        </p>
                    </div>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="text-sm font-bold {{ $tx->type === 'credit' ? 'text-green-600' : 'text-amber-700' }}">
                        {{ $tx->type === 'credit' ? '+' : '-' }}₱{{ number_format($tx->amount, 2) }}
                    </p>
                    @php $sc = ['pending'=>['#F59E0B','#FFFBEB'],'completed'=>['#22C55E','#F0FDF4'],'failed'=>['#EF4444','#FEF2F2']]; [$tc,$bc] = $sc[$tx->status]; @endphp
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full" style="color:{{ $tc }};background:{{ $bc }};">
                        {{ ucfirst($tx->status) }}
                    </span>
                </div>
            </div>
            @empty
            <div class="px-6 py-12 text-center" style="color:#6B7280;">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                <p class="text-sm">No transactions yet. Accept a scholarship to get started!</p>
            </div>
            @endforelse
        </div>
        @if($transactions->hasPages())
        <div class="px-6 py-4">{{ $transactions->links() }}</div>
        @endif
    </div>

</div>
</x-student-layout>
