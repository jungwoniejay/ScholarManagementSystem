<x-student-layout>
<x-slot name="header">Application Status</x-slot>

<div class="max-w-6xl mx-auto space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold" style="color:#FFD700;">Application Status</h1>
        <p class="text-sm mt-1" style="color:rgba(255,255,255,0.4);">Track the progress of all your scholarship applications</p>
    </div>

    @if(session('success'))
        <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(74,222,128,0.12);color:#4ADE80;border:1px solid rgba(74,222,128,0.25);">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(248,113,113,0.12);color:#F87171;border:1px solid rgba(248,113,113,0.25);">{{ session('error') }}</div>
    @endif

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
        @php
        $stats = [
            ['label'=>'Total',            'value'=>$applications->total(),                          'color'=>'#FFD700'],
            ['label'=>'Pending',          'value'=>$groupedApplications['pending']->count(),         'color'=>'#FBBF24'],
            ['label'=>'Shortlisted',      'value'=>$groupedApplications['shortlisted']->count(),     'color'=>'#60A5FA'],
            ['label'=>'Awaiting Response','value'=>$groupedApplications['awaiting_response']->count(),'color'=>'#4ADE80'],
            ['label'=>'Accepted',         'value'=>$groupedApplications['accepted']->count(),        'color'=>'#A78BFA'],
        ];
        @endphp
        @foreach($stats as $s)
        <div class="rounded-xl p-4" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
            <p class="text-xs mb-1" style="color:rgba(255,255,255,0.4);">{{ $s['label'] }}</p>
            <p class="text-2xl font-bold" style="color:{{ $s['color'] }};">{{ $s['value'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Table --}}
    @if($applications->count() > 0)
    <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
        <div class="px-5 py-4" style="border-bottom:1px solid rgba(255,255,255,0.07);">
            <h3 class="font-bold text-white text-sm flex items-center gap-2">
                <span style="width:26px;height:26px;background:linear-gradient(135deg,#FFD700,#B8860B);border-radius:7px;display:inline-flex;align-items:center;justify-content:center;">
                    <svg width="13" height="13" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </span>
                Application History
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07);">
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:rgba(255,255,255,0.35);">Scholarship</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:rgba(255,255,255,0.35);">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:rgba(255,255,255,0.35);">Applied</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:rgba(255,255,255,0.35);">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:rgba(255,255,255,0.35);">Donor</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:rgba(255,255,255,0.35);">Response</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                    @php
                        $statusMap = [
                            'pending'    => ['#FBBF24','rgba(251,191,36,0.12)','Pending'],
                            'review'     => ['#60A5FA','rgba(96,165,250,0.12)','Under Review'],
                            'shortlisted'=> ['#FFD700','rgba(255,215,0,0.12)','Shortlisted'],
                            'screened'   => ['#A78BFA','rgba(167,139,250,0.12)','Screened'],
                            'completed'  => ['#4ADE80','rgba(74,222,128,0.12)','Completed'],
                            'rejected'   => ['#F87171','rgba(248,113,113,0.12)','Rejected'],
                            'declined'   => ['#F87171','rgba(248,113,113,0.12)','Declined'],
                        ];
                        $donorMap = [
                            'pending'  => ['#8b949e','rgba(139,148,158,0.12)','Pending'],
                            'approved' => ['#4ADE80','rgba(74,222,128,0.12)','Approved'],
                            'rejected' => ['#F87171','rgba(248,113,113,0.12)','Rejected'],
                        ];
                        $responseMap = [
                            'accept'  => ['#4ADE80','rgba(74,222,128,0.12)','Accepted'],
                            'decline' => ['#F87171','rgba(248,113,113,0.12)','Declined'],
                        ];
                        [$stc,$sbc,$slabel] = $statusMap[$application->status] ?? ['#8b949e','rgba(139,148,158,0.12)',ucfirst($application->status)];
                        [$dtc,$dbc,$dlabel] = $donorMap[$application->donor_status] ?? ['#8b949e','rgba(139,148,158,0.12)','N/A'];
                        [$rtc,$rbc,$rlabel] = $responseMap[$application->student_response] ?? ['#8b949e','rgba(139,148,158,0.12)','—'];
                    @endphp
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.05);"
                        onmouseover="this.style.background='rgba(255,215,0,0.03)'"
                        onmouseout="this.style.background='transparent'">
                        <td class="px-5 py-4">
                            <p class="font-semibold text-white text-sm">{{ $application->scholarship->name }}</p>
                            <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.35);">{{ $application->scholarship->academic_year }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-sm font-semibold" style="color:#FFD700;">
                                ₱{{ number_format($application->awarded_amount ?? $application->scholarship->amount, 2) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-sm" style="color:rgba(255,255,255,0.5);">
                            {{ $application->applied_at?->format('M d, Y') ?? '—' }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full"
                                  style="color:{{ $stc }};background:{{ $sbc }};">{{ $slabel }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full"
                                  style="color:{{ $dtc }};background:{{ $dbc }};">{{ $dlabel }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full"
                                  style="color:{{ $rtc }};background:{{ $rbc }};">{{ $rlabel }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <a href="{{ route('student.scholarships.show', $application->scholarship) }}"
                               class="text-xs font-semibold px-3 py-1 rounded-lg transition"
                               style="color:rgba(255,215,0,0.7);border:1px solid rgba(255,215,0,0.2);"
                               onmouseover="this.style.background='rgba(255,215,0,0.08)'"
                               onmouseout="this.style.background='transparent'">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
        <div class="px-5 py-4" style="border-top:1px solid rgba(255,255,255,0.07);">
            {{ $applications->links() }}
        </div>
        @endif
    </div>

    @else
    {{-- Empty State --}}
    <div class="rounded-xl px-5 py-14 text-center" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3"
             style="background:rgba(255,215,0,0.08);">
            <svg width="24" height="24" fill="none" stroke="rgba(255,215,0,0.4)" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <p class="text-sm font-semibold" style="color:rgba(255,255,255,0.4);">No applications yet</p>
        <p class="text-xs mt-1 mb-4" style="color:rgba(255,255,255,0.25);">Browse available scholarships to get started</p>
        <a href="{{ route('student.scholarships.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold"
           style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
            Browse Scholarships
        </a>
    </div>
    @endif

</div>
</x-student-layout>
