<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#FFD700;">Withdrawal Requests</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        @if(session('success'))
            <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(74,222,128,0.12);color:#4ADE80;border:1px solid rgba(74,222,128,0.25);">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(248,113,113,0.12);color:#F87171;border:1px solid rgba(248,113,113,0.25);">{{ session('error') }}</div>
        @endif

        {{-- Pending --}}
        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
            <div class="px-5 py-4" style="border-bottom:1px solid rgba(255,255,255,0.07);">
                <h3 class="font-bold text-white text-sm flex items-center gap-2">
                    <span style="width:26px;height:26px;background:linear-gradient(135deg,#FFD700,#B8860B);border-radius:7px;display:inline-flex;align-items:center;justify-content:center;">
                        <svg width="13" height="13" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    Pending Withdrawal Requests
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.07);">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Student</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Amount</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Method</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Account</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Requested</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pending as $tx)
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.05);"
                            onmouseover="this.style.background='rgba(255,215,0,0.03)'"
                            onmouseout="this.style.background='transparent'">
                            <td class="px-5 py-4">
                                <p class="text-sm font-semibold text-white">{{ $tx->wallet->student->user->name ?? 'N/A' }}</p>
                                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.35);">{{ $tx->wallet->student->user->email ?? '' }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <span class="text-sm font-bold" style="color:#FFD700;">₱{{ number_format($tx->amount, 2) }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="text-xs font-semibold px-2 py-1 rounded-full" style="background:rgba(96,165,250,0.12);color:#60A5FA;">
                                    {{ strtoupper($tx->method ?? 'N/A') }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-sm text-white">{{ $tx->account_name }}</p>
                                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.4);">
                                    {{ $tx->account_number }}
                                    @if($tx->bank_name) · {{ $tx->bank_name }} @endif
                                </p>
                            </td>
                            <td class="px-5 py-4 text-sm" style="color:rgba(255,255,255,0.5);">
                                {{ $tx->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <form method="POST" action="{{ route('admin.disbursements.withdrawals.approve', $tx->id) }}"
                                          onsubmit="return confirm('Approve withdrawal of ₱{{ number_format($tx->amount,2) }}?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="px-3 py-1 text-xs font-semibold rounded-lg"
                                                style="background:rgba(74,222,128,0.12);color:#4ADE80;border:1px solid rgba(74,222,128,0.2);">
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.disbursements.withdrawals.reject', $tx->id) }}"
                                          class="flex items-center gap-1"
                                          onsubmit="return confirm('Reject this withdrawal? Amount will be refunded.')">
                                        @csrf @method('PATCH')
                                        <input type="text" name="reason" placeholder="Reason (optional)"
                                               class="text-xs px-2 py-1 rounded-lg focus:outline-none"
                                               style="background:#0A1628;border:1px solid rgba(255,255,255,0.1);color:#e2e8f0;width:130px;">
                                        <button type="submit" class="px-3 py-1 text-xs font-semibold rounded-lg"
                                                style="background:rgba(248,113,113,0.12);color:#F87171;border:1px solid rgba(248,113,113,0.2);">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-sm" style="color:rgba(255,255,255,0.3);">No pending withdrawal requests.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($pending->hasPages())
            <div class="px-5 py-4" style="border-top:1px solid rgba(255,255,255,0.07);">{{ $pending->links() }}</div>
            @endif
        </div>

        {{-- Processed --}}
        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
            <div class="px-5 py-4" style="border-bottom:1px solid rgba(255,255,255,0.07);">
                <h3 class="font-bold text-white text-sm">Processed Withdrawals</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.07);">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Student</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Amount</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Method</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Status</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Processed</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($processed as $tx)
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.05);">
                            <td class="px-5 py-4 text-sm font-semibold text-white">{{ $tx->wallet->student->user->name ?? 'N/A' }}</td>
                            <td class="px-5 py-4 text-sm font-bold" style="color:#FFD700;">₱{{ number_format($tx->amount, 2) }}</td>
                            <td class="px-5 py-4 text-xs font-semibold" style="color:rgba(255,255,255,0.5);">{{ strtoupper($tx->method ?? '') }}</td>
                            <td class="px-5 py-4">
                                @if($tx->status === 'completed')
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full" style="background:rgba(74,222,128,0.12);color:#4ADE80;">Approved</span>
                                @else
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full" style="background:rgba(248,113,113,0.12);color:#F87171;">Rejected</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-sm" style="color:rgba(255,255,255,0.5);">{{ $tx->approved_at ? $tx->approved_at->format('M d, Y') : '—' }}</td>
                            <td class="px-5 py-4 text-sm" style="color:rgba(255,255,255,0.4);">{{ $tx->rejection_reason ?? '—' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-sm" style="color:rgba(255,255,255,0.3);">No processed withdrawals yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($processed->hasPages())
            <div class="px-5 py-4" style="border-top:1px solid rgba(255,255,255,0.07);">{{ $processed->links() }}</div>
            @endif
        </div>

    </div>
</x-app-layout>
