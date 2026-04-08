@extends('layouts.app')
@section('content')
<div class="px-6 py-8 max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('donator.applications.index') }}" class="flex items-center gap-1 text-sm mb-2" style="color:#8b949e;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Applications
            </a>
            <h1 class="text-2xl font-bold text-white">Application Review</h1>
        </div>
        @php
            $statusStyles = [
                'pending'  => 'background:rgba(251,191,36,0.15);color:#FBBF24;',
                'approved' => 'background:rgba(34,197,94,0.15);color:#22C55E;',
                'rejected' => 'background:rgba(248,113,113,0.15);color:#F87171;',
            ];
        @endphp
        <span class="px-4 py-2 rounded-full text-sm font-semibold"
              style="{{ $statusStyles[$application->donor_status ?? 'pending'] ?? $statusStyles['pending'] }}">
            {{ ucfirst($application->donor_status ?? 'Pending') }}
        </span>
    </div>

    @if(session('success'))
        <div class="mb-6 px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#22C55E;border:1px solid rgba(34,197,94,0.3);">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-4">

            {{-- Student Info --}}
            <div class="rounded-xl border p-6" style="background:#0F2044;border-color:#1E3A8A;">
                <h2 class="text-base font-semibold text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="#FFD700" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Student Information
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        ['label'=>'Name',         'value'=>$application->student->user->name ?? 'N/A'],
                        ['label'=>'Email',        'value'=>$application->student->user->email ?? 'N/A'],
                        ['label'=>'Student ID',   'value'=>$application->student->student_id ?? 'N/A'],
                        ['label'=>'Applied Date', 'value'=>$application->applied_at?->format('M d, Y') ?? 'N/A'],
                    ] as $field)
                    <div>
                        <div class="text-xs mb-1" style="color:#8b949e;">{{ $field['label'] }}</div>
                        <div class="text-sm font-medium text-white">{{ $field['value'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Scholarship Info --}}
            <div class="rounded-xl border p-6" style="background:#0F2044;border-color:#1E3A8A;">
                <h2 class="text-base font-semibold text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="#FFD700" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Scholarship Details
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <div class="text-xs mb-1" style="color:#8b949e;">Scholarship Name</div>
                        <div class="text-sm font-medium text-white">{{ $application->scholarship->name ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="text-xs mb-1" style="color:#8b949e;">Amount</div>
                        <div class="text-sm font-bold" style="color:#FFD700;">₱{{ number_format($application->scholarship->amount ?? 0, 2) }}</div>
                    </div>
                    <div>
                        <div class="text-xs mb-1" style="color:#8b949e;">Academic Year</div>
                        <div class="text-sm font-medium text-white">{{ $application->scholarship->academic_year ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            {{-- AI Score & Remarks --}}
            <div class="rounded-xl border p-6" style="background:#0F2044;border-color:#1E3A8A;">
                <h2 class="text-base font-semibold text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="#FFD700" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    AI Evaluation & Admin Review
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs mb-1" style="color:#8b949e;">AI Score</div>
                        <div class="flex items-center gap-2">
                            <span class="text-3xl font-bold" style="color:#FFD700;">{{ $application->ai_score ?? 'N/A' }}</span>
                            @if($application->ai_score)
                                @if($application->ai_score >= 80)
                                    <span class="px-2 py-0.5 rounded-full text-xs" style="background:rgba(34,197,94,0.15);color:#22C55E;">Excellent</span>
                                @elseif($application->ai_score >= 60)
                                    <span class="px-2 py-0.5 rounded-full text-xs" style="background:rgba(251,191,36,0.15);color:#FBBF24;">Good</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs" style="background:rgba(139,148,158,0.15);color:#8b949e;">Fair</span>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="text-xs mb-1" style="color:#8b949e;">AI Rank</div>
                        <div class="text-3xl font-bold text-white">#{{ $application->ai_rank ?? 'N/A' }}</div>
                    </div>
                    <div class="col-span-2">
                        <div class="text-xs mb-1" style="color:#8b949e;">Admin Remarks</div>
                        <div class="p-3 rounded-lg text-sm" style="background:#0A1628;color:#e2e8f0;">
                            {{ $application->remarks ?? 'No remarks provided by admin.' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Documents --}}
            <div class="rounded-xl border p-6" style="background:#0F2044;border-color:#1E3A8A;">
                <h2 class="text-base font-semibold text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="#FFD700" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    Uploaded Documents
                </h2>
                @if($application->documents && $application->documents->count() > 0)
                    <div class="space-y-2">
                        @foreach($application->documents as $document)
                            <div class="flex items-center justify-between p-3 rounded-lg" style="background:#0A1628;">
                                <div class="flex items-center gap-3">
                                    <svg class="w-4 h-4" fill="none" stroke="#8b949e" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="text-sm text-white">{{ $document->name ?? 'Document' }}</span>
                                </div>
                                @if($document->verified)
                                    <span class="px-2 py-0.5 rounded-full text-xs" style="background:rgba(34,197,94,0.15);color:#22C55E;">Verified</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs" style="background:rgba(251,191,36,0.15);color:#FBBF24;">Pending</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-center py-4" style="color:#8b949e;">No documents uploaded.</p>
                @endif
            </div>
        </div>

        {{-- Decision Panel --}}
        <div class="lg:col-span-1">
            @if($application->donor_status === 'pending')
                <form action="{{ route('donator.applications.decision', $application) }}" method="POST"
                      class="rounded-xl border p-6 sticky top-6" style="background:#0F2044;border-color:#1E3A8A;">
                    @csrf

                    <h2 class="text-base font-semibold text-white mb-4">Make Decision</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-medium mb-1" style="color:#8b949e;">Your Decision</label>
                            <select name="decision" id="decision" required
                                    class="w-full rounded-lg px-3 py-2 text-sm text-white border focus:outline-none"
                                    style="background:#0A1628;border-color:#1E3A8A;">
                                <option value="">Select decision...</option>
                                <option value="approved">Approve & Fund</option>
                                <option value="rejected">Reject</option>
                            </select>
                        </div>

                        <div id="awarded_amount_field" class="hidden">
                            <label class="block text-xs font-medium mb-1" style="color:#8b949e;">Awarded Amount (₱)</label>
                            <input type="number" name="awarded_amount" id="awarded_amount" step="0.01" min="0"
                                   value="{{ $application->scholarship->amount ?? 0 }}"
                                   class="w-full rounded-lg px-3 py-2 text-sm text-white border focus:outline-none"
                                   style="background:#0A1628;border-color:#1E3A8A;">
                            <p class="text-xs mt-1" style="color:#8b949e;">Scholarship amount: ₱{{ number_format($application->scholarship->amount ?? 0, 2) }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-medium mb-1" style="color:#8b949e;">Remarks (Optional)</label>
                            <textarea name="remarks" rows="3"
                                      class="w-full rounded-lg px-3 py-2 text-sm text-white border focus:outline-none"
                                      style="background:#0A1628;border-color:#1E3A8A;"
                                      placeholder="Add your remarks for the student..."></textarea>
                        </div>

                        <button type="submit"
                                class="w-full py-3 rounded-xl font-bold text-sm"
                                style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                            Submit Decision
                        </button>

                        <p class="text-xs text-center" style="color:#8b949e;">The student will be notified of your decision.</p>
                    </div>
                </form>
            @else
                <div class="rounded-xl border p-6 sticky top-6" style="background:#0F2044;border-color:#1E3A8A;">
                    <h2 class="text-base font-semibold text-white mb-4">Decision Status</h2>
                    <div class="text-center py-4">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-3"
                             style="{{ $application->donor_status === 'approved' ? 'background:rgba(34,197,94,0.15);' : 'background:rgba(248,113,113,0.15);' }}">
                            <svg class="w-8 h-8" fill="none" stroke="{{ $application->donor_status === 'approved' ? '#22C55E' : '#F87171' }}" viewBox="0 0 24 24">
                                @if($application->donor_status === 'approved')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                @endif
                            </svg>
                        </div>
                        <p class="text-lg font-semibold" style="{{ $application->donor_status === 'approved' ? 'color:#22C55E;' : 'color:#F87171;' }}">
                            {{ ucfirst($application->donor_status) }}
                        </p>
                        <p class="text-xs mt-1" style="color:#8b949e;">
                            Reviewed on {{ $application->donor_reviewed_at?->format('M d, Y') }}
                        </p>
                    </div>

                    @if($application->donor_remarks)
                        <div class="mt-4 p-3 rounded-lg" style="background:#0A1628;">
                            <p class="text-sm" style="color:#e2e8f0;">{{ $application->donor_remarks }}</p>
                        </div>
                    @endif

                    @if($application->donor_status === 'approved')
                        <div class="mt-4 p-3 rounded-lg" style="background:rgba(255,215,0,0.08);border:1px solid rgba(255,215,0,0.2);">
                            <p class="text-xs mb-1" style="color:#8b949e;">Awarded Amount</p>
                            <p class="text-2xl font-bold" style="color:#FFD700;">₱{{ number_format($application->awarded_amount, 2) }}</p>
                        </div>

                        @if($application->student_response)
                            <div class="mt-4 p-3 rounded-lg" style="{{ $application->student_response === 'accept' ? 'background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.2);' : 'background:rgba(139,148,158,0.1);border:1px solid rgba(139,148,158,0.2);' }}">
                                <p class="text-xs mb-1" style="color:#8b949e;">Student Response</p>
                                <p class="text-base font-semibold" style="{{ $application->student_response === 'accept' ? 'color:#22C55E;' : 'color:#8b949e;' }}">
                                    {{ ucfirst($application->student_response) }}
                                </p>
                            </div>
                        @else
                            <div class="mt-4 p-3 rounded-lg" style="background:rgba(251,191,36,0.1);border:1px solid rgba(251,191,36,0.2);">
                                <p class="text-sm" style="color:#FBBF24;">Awaiting student response...</p>
                            </div>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.getElementById('decision')?.addEventListener('change', function () {
        document.getElementById('awarded_amount_field').classList.toggle('hidden', this.value !== 'approved');
    });
</script>
@endsection
