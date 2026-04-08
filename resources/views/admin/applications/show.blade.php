<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Application Details</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">

        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back
        </a>

        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded-lg text-sm" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 px-4 py-3 rounded-lg text-sm" style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Header Card --}}
                <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold flex-shrink-0"
                                 style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                                {{ substr($application->scholarship->name ?? 'A', 0, 1) }}
                            </div>
                            <div>
                                <h1 class="text-xl font-bold" style="color:#e2e8f0;">{{ $application->scholarship->name ?? 'N/A' }}</h1>
                                <p class="text-xs" style="color:#8b949e;">Application ID: #{{ $application->id }}</p>
                            </div>
                        </div>
                        @php
                            $sc = ['pending'=>'rgba(251,191,36,0.15);color:#fbbf24;','review'=>'rgba(96,165,250,0.15);color:#60a5fa;','shortlisted'=>'rgba(167,139,250,0.15);color:#a78bfa;','approved'=>'rgba(34,197,94,0.15);color:#4ade80;','rejected'=>'rgba(248,113,113,0.15);color:#f87171;','completed'=>'rgba(34,197,94,0.15);color:#4ade80;','declined'=>'rgba(139,148,158,0.15);color:#8b949e;'];
                            $ss = $sc[$application->status] ?? 'rgba(139,148,158,0.15);color:#8b949e;';
                        @endphp
                        <span class="px-3 py-1 text-xs font-semibold rounded-full" style="background:{{ $ss }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4" style="border-top:1px solid #1E3A8A;">
                        @foreach([
                            ['label'=>'Student','value'=>$application->student->user->name ?? 'N/A'],
                            ['label'=>'Applied On','value'=>$application->applied_at->format('M d, Y')],
                            ['label'=>'AI Score','value'=>$application->ai_score ?? 'N/A'],
                            ['label'=>'AI Rank','value'=>$application->ai_rank ?? 'N/A'],
                        ] as $f)
                        <div>
                            <p class="text-xs font-semibold uppercase mb-1" style="color:#8b949e;">{{ $f['label'] }}</p>
                            <p class="text-sm font-semibold" style="color:#e2e8f0;">{{ $f['value'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Student Info --}}
                <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <h2 class="text-sm font-bold uppercase tracking-wide mb-4" style="color:#FFD700;">Student Information</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach([
                            ['label'=>'Full Name','value'=>$application->student->user->name ?? 'N/A'],
                            ['label'=>'Email','value'=>$application->student->user->email ?? 'N/A'],
                            ['label'=>'Student ID','value'=>'#'.($application->student->id ?? 'N/A')],
                            ['label'=>'GPA','value'=>$application->student->gpa ?? 'N/A'],
                            ['label'=>'Course','value'=>$application->student->course ?? 'N/A'],
                            ['label'=>'Enrollment Year','value'=>$application->student->enrollment_year ?? 'N/A'],
                        ] as $f)
                        <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                            <p class="text-xs font-semibold mb-1" style="color:#8b949e;">{{ $f['label'] }}</p>
                            <p class="text-sm" style="color:#e2e8f0;">{{ $f['value'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Personal Statement --}}
                @if($application->personal_statement)
                <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <h2 class="text-sm font-bold uppercase tracking-wide mb-3" style="color:#FFD700;">Personal Statement</h2>
                    <p class="text-sm leading-relaxed" style="color:#e2e8f0;">{!! nl2br(e($application->personal_statement)) !!}</p>
                </div>
                @endif

                {{-- Documents --}}
                @if($application->documents && $application->documents->count() > 0)
                <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <h2 class="text-sm font-bold uppercase tracking-wide mb-4" style="color:#FFD700;">Submitted Documents</h2>
                    <div class="space-y-3">
                        @foreach($application->documents as $doc)
                        <div class="flex items-center justify-between p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#8b949e;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium" style="color:#e2e8f0;">{{ $doc->document_name ?? 'Document' }}</p>
                                    <p class="text-xs" style="color:#8b949e;">{{ $doc->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <a href="{{ $doc->file_path ?? '#' }}" class="text-xs font-semibold" style="color:#60a5fa;">View</a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Donor Review --}}
                <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <h2 class="text-sm font-bold uppercase tracking-wide mb-4" style="color:#FFD700;">Donor Review Status</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                            <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Donor Status</p>
                            @php $ds = ['approved'=>'rgba(34,197,94,0.15);color:#4ade80;','rejected'=>'rgba(248,113,113,0.15);color:#f87171;']; $dss = $ds[$application->donor_status] ?? 'rgba(139,148,158,0.15);color:#8b949e;'; @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background:{{ $dss }}">{{ ucfirst($application->donor_status ?? 'Pending') }}</span>
                        </div>
                        <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                            <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Awarded Amount</p>
                            <p class="text-sm font-bold" style="color:#4ade80;">₱{{ number_format($application->awarded_amount ?? 0, 2) }}</p>
                        </div>
                        <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                            <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Donor</p>
                            <p class="text-sm" style="color:#e2e8f0;">{{ $application->donator->organization_name ?? 'N/A' }}</p>
                        </div>
                        <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                            <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Donor Reviewed</p>
                            <p class="text-sm" style="color:#e2e8f0;">{{ $application->donor_reviewed_at ? $application->donor_reviewed_at->format('M d, Y') : 'Not yet' }}</p>
                        </div>
                    </div>
                    @if($application->donor_remarks)
                    <div class="mt-3 p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Donor Remarks</p>
                        <p class="text-sm" style="color:#e2e8f0;">{{ $application->donor_remarks }}</p>
                    </div>
                    @endif
                </div>

                {{-- Student Response --}}
                <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <h2 class="text-sm font-bold uppercase tracking-wide mb-4" style="color:#FFD700;">Student Response</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                            <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Response</p>
                            @if($application->student_response === 'accept')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background:rgba(34,197,94,0.15);color:#4ade80;">Accepted</span>
                            @elseif($application->student_response === 'decline')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background:rgba(248,113,113,0.15);color:#f87171;">Declined</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background:rgba(139,148,158,0.15);color:#8b949e;">Pending</span>
                            @endif
                        </div>
                        <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                            <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Responded On</p>
                            <p class="text-sm" style="color:#e2e8f0;">{{ $application->student_responded_at ? $application->student_responded_at->format('M d, Y') : 'Not yet' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar Actions --}}
            <div class="lg:col-span-1">
                <div class="rounded-xl p-6 sticky top-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <h3 class="text-sm font-bold uppercase tracking-wide mb-4" style="color:#FFD700;">Admin Actions</h3>

                    <form action="{{ route('admin.applications.update', $application->id) }}" method="POST" class="space-y-4">
                        @csrf @method('PATCH')

                        <div>
                            <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Update Status</label>
                            <select name="status" id="status" onchange="toggleDonorDropdown()"
                                    class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                    style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">
                                @foreach(['pending'=>'Pending','review'=>'Under Review','shortlisted'=>'Shortlisted','approved'=>'Approved','rejected'=>'Rejected'] as $val => $label)
                                <option value="{{ $val }}" {{ $application->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="donor_dropdown" style="display:none;">
                            <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Assign to Donor</label>
                            <select name="donator_id"
                                    class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                    style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">
                                <option value="">-- Select Donor --</option>
                                @foreach($donators as $donor)
                                <option value="{{ $donor->donator_id }}" {{ $application->donator_id == $donor->donator_id ? 'selected' : '' }}>
                                    {{ $donor->organization_name ?? 'Donor #'.$donor->donator_id }}
                                </option>
                                @endforeach
                            </select>
                            <p class="text-xs mt-1" style="color:#8b949e;">Donors who fund the <strong style="color:#FFD700;">{{ $application->scholarship->name ?? 'this' }}</strong> scholarship.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Admin Remarks</label>
                            <textarea name="admin_remarks" rows="3"
                                      class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                      style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;"
                                      placeholder="Add notes...">{{ $application->remarks ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-2.5 text-sm font-semibold rounded-xl transition"
                                style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                            Update Status
                        </button>
                    </form>

                    <div class="mt-4 pt-4 space-y-2" style="border-top:1px solid #1E3A8A;">
                        <a href="{{ route('admin.students.show', $application->student->id ?? '#') }}"
                           class="block w-full text-center py-2 text-sm font-medium rounded-xl transition"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">
                            View Student Profile
                        </a>
                        <a href="{{ route('admin.scholarships.show', $application->scholarship->id ?? '#') }}"
                           class="block w-full text-center py-2 text-sm font-medium rounded-xl transition"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">
                            View Scholarship Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDonorDropdown() {
            document.getElementById('donor_dropdown').style.display =
                document.getElementById('status').value === 'shortlisted' ? 'block' : 'none';
        }
        document.addEventListener('DOMContentLoaded', toggleDonorDropdown);
    </script>
</x-app-layout>
