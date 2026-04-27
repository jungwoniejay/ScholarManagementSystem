<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#FFD700;">Completed Applications</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        @if(session('success'))
            <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(74,222,128,0.12);color:#4ADE80;border:1px solid rgba(74,222,128,0.25);">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(248,113,113,0.12);color:#F87171;border:1px solid rgba(248,113,113,0.25);">{{ session('error') }}</div>
        @endif

        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
            <div class="px-5 py-4 flex items-center justify-between" style="border-bottom:1px solid rgba(255,255,255,0.07);">
                <h3 class="font-bold text-white text-sm flex items-center gap-2">
                    <span style="width:26px;height:26px;background:linear-gradient(135deg,#FFD700,#B8860B);border-radius:7px;display:inline-flex;align-items:center;justify-content:center;">
                        <svg width="13" height="13" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    Completed Applications
                </h3>
                <a href="{{ route('admin.disbursements.withdrawals') }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold transition"
                   style="background:rgba(255,215,0,0.12);color:#FFD700;border:1px solid rgba(255,215,0,0.25);">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Withdrawal Requests
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.07);">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Student</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Scholarship</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Donor</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Amount</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Accepted</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Disbursement</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:rgba(255,255,255,0.35);">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications ?? [] as $app)
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.05);"
                            onmouseover="this.style.background='rgba(255,215,0,0.03)'"
                            onmouseout="this.style.background='transparent'">
                            <td class="px-5 py-4">
                                <p class="text-sm font-semibold text-white">{{ $app->student->user->name ?? 'N/A' }}</p>
                                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.35);">{{ $app->student->user->email ?? '' }}</p>
                            </td>
                            <td class="px-5 py-4 text-sm" style="color:rgba(255,255,255,0.6);">{{ $app->scholarship->name ?? 'N/A' }}</td>
                            <td class="px-5 py-4 text-sm" style="color:rgba(255,255,255,0.6);">{{ $app->donator->organization_name ?? 'N/A' }}</td>
                            <td class="px-5 py-4">
                                <span class="text-sm font-bold" style="color:#FFD700;">₱{{ number_format($app->awarded_amount ?? $app->scholarship->amount ?? 0, 2) }}</span>
                            </td>
                            <td class="px-5 py-4 text-sm" style="color:rgba(255,255,255,0.5);">
                                {{ $app->student_responded_at ? $app->student_responded_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="px-5 py-4">
                                @if($app->disbursed_at)
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background:rgba(74,222,128,0.12);color:#4ADE80;">
                                        Disbursed {{ $app->disbursed_at->format('M d, Y') }}
                                    </span>
                                @else
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background:rgba(251,191,36,0.12);color:#FBBF24;">
                                        Pending Disbursement
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.applications.show', $app->id) }}"
                                       class="px-3 py-1 text-xs font-semibold rounded-lg transition"
                                       style="background:rgba(96,165,250,0.12);color:#60A5FA;border:1px solid rgba(96,165,250,0.2);">
                                        View
                                    </a>
                                    @if(!$app->disbursed_at)
                                    <form method="POST" action="{{ route('admin.disbursements.disburse', $app->id) }}"
                                          onsubmit="return confirm('Disburse ₱{{ number_format($app->awarded_amount ?? $app->scholarship->amount ?? 0, 2) }} to {{ $app->student->user->name ?? 'this student' }}?')">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-1 text-xs font-semibold rounded-lg transition"
                                                style="background:rgba(74,222,128,0.12);color:#4ADE80;border:1px solid rgba(74,222,128,0.2);">
                                            Disburse
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-sm" style="color:rgba(255,255,255,0.3);">No completed applications.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($applications->hasPages())
            <div class="px-5 py-4" style="border-top:1px solid rgba(255,255,255,0.07);">{{ $applications->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
