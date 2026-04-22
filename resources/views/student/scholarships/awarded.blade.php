<x-student-layout>
<div class="max-w-6xl mx-auto space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold" style="color:#FFD700;">Scholarship Awards</h1>
        <p class="text-sm mt-1" style="color:rgba(255,255,255,0.4);">Review and respond to your scholarship awards</p>
    </div>

    @if(session('success'))
        <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#22C55E;border:1px solid rgba(34,197,94,0.3);">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(248,113,113,0.15);color:#F87171;border:1px solid rgba(248,113,113,0.3);">
            {{ session('error') }}
        </div>
    @endif

    {{-- Awaiting Response --}}
    <div>
        <h2 class="text-base font-bold mb-4 flex items-center gap-2" style="color:#fff;">
            <span style="width:28px;height:28px;background:rgba(251,191,36,0.15);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                <svg width="14" height="14" fill="none" stroke="#FBBF24" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>
            Awaiting Your Response
        </h2>

        @if($awardedApplications->count() > 0)
            <div class="space-y-4">
                @foreach($awardedApplications as $application)
                <div class="rounded-xl p-5" style="background:#0F2044;border:1px solid rgba(255,215,0,0.15);">
                    <div class="flex flex-col sm:flex-row justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <h3 class="text-base font-bold text-white">{{ $application->scholarship->name }}</h3>
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold" style="background:rgba(34,197,94,0.15);color:#22C55E;">
                                    Approved by Donor
                                </span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm mb-3">
                                <div>
                                    <span style="color:rgba(255,255,255,0.4);">Amount:</span>
                                    <span class="font-bold ml-1" style="color:#FFD700;">₱{{ number_format($application->awarded_amount, 2) }}</span>
                                </div>
                                <div>
                                    <span style="color:rgba(255,255,255,0.4);">Donor:</span>
                                    <span class="font-medium text-white ml-1">{{ $application->donator->organization_name ?? 'Anonymous' }}</span>
                                </div>
                                <div>
                                    <span style="color:rgba(255,255,255,0.4);">Approved:</span>
                                    <span class="font-medium text-white ml-1">{{ $application->donor_reviewed_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            @if($application->donor_remarks)
                                <div class="p-3 rounded-lg text-sm" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);">
                                    <span style="color:rgba(255,255,255,0.5);">Donor's Message:</span>
                                    <span class="ml-1" style="color:rgba(255,255,255,0.8);">{{ $application->donor_remarks }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex sm:flex-col gap-2 flex-shrink-0">
                            <form action="{{ route('student.scholarships.respond', $application) }}" method="POST">
                                @csrf
                                <input type="hidden" name="response" value="accept">
                                <button type="submit" class="w-full px-4 py-2 rounded-lg text-sm font-bold transition"
                                        style="background:rgba(34,197,94,0.2);color:#22C55E;border:1px solid rgba(34,197,94,0.3);"
                                        onmouseover="this.style.background='rgba(34,197,94,0.35)'"
                                        onmouseout="this.style.background='rgba(34,197,94,0.2)'">
                                    ✓ Accept
                                </button>
                            </form>
                            <form action="{{ route('student.scholarships.respond', $application) }}" method="POST">
                                @csrf
                                <input type="hidden" name="response" value="decline">
                                <button type="submit" class="w-full px-4 py-2 rounded-lg text-sm font-bold transition"
                                        style="background:rgba(248,113,113,0.15);color:#F87171;border:1px solid rgba(248,113,113,0.3);"
                                        onmouseover="this.style.background='rgba(248,113,113,0.3)'"
                                        onmouseout="this.style.background='rgba(248,113,113,0.15)'">
                                    ✗ Decline
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="rounded-xl p-8 text-center" style="background:#0F2044;border:1px solid rgba(255,255,255,0.07);">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-20" fill="none" stroke="#FFD700" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm" style="color:rgba(255,255,255,0.4);">No scholarship awards awaiting your response.</p>
            </div>
        @endif
    </div>

    {{-- Your Responses --}}
    <div>
        <h2 class="text-base font-bold mb-4 flex items-center gap-2" style="color:#fff;">
            <span style="width:28px;height:28px;background:rgba(96,165,250,0.15);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                <svg width="14" height="14" fill="none" stroke="#60A5FA" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </span>
            Your Responses
        </h2>

        @if($respondedApplications->count() > 0)
            <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid rgba(255,255,255,0.07);">
                <table class="min-w-full">
                    <thead>
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.07);">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:rgba(255,255,255,0.4);">Scholarship</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:rgba(255,255,255,0.4);">Amount</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:rgba(255,255,255,0.4);">Response</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:rgba(255,255,255,0.4);">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($respondedApplications as $application)
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.04);"
                            onmouseover="this.style.background='rgba(255,215,0,0.03)'"
                            onmouseout="this.style.background='transparent'">
                            <td class="px-5 py-4">
                                <div class="font-semibold text-sm text-white">{{ $application->scholarship->name }}</div>
                                <div class="text-xs mt-0.5" style="color:rgba(255,255,255,0.4);">{{ $application->donator->organization_name ?? 'Anonymous' }}</div>
                            </td>
                            <td class="px-5 py-4 text-sm font-bold" style="color:#FFD700;">₱{{ number_format($application->awarded_amount, 2) }}</td>
                            <td class="px-5 py-4">
                                @if($application->student_response === 'accept')
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:rgba(34,197,94,0.15);color:#22C55E;">Accepted</span>
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:rgba(248,113,113,0.15);color:#F87171;">Declined</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-sm" style="color:rgba(255,255,255,0.5);">{{ $application->student_responded_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="rounded-xl p-8 text-center" style="background:#0F2044;border:1px solid rgba(255,255,255,0.07);">
                <p class="text-sm" style="color:rgba(255,255,255,0.4);">No responses recorded yet.</p>
            </div>
        @endif
    </div>

</div>
</x-student-layout>
