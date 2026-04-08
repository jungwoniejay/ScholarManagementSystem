<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Scholarship Details</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.scholarships.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Scholarships
        </a>

        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">{{ session('success') }}</div>
        @endif

        <div class="rounded-2xl p-6 space-y-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-2xl font-bold" style="color:#FFD700;">{{ $scholarship->name }}</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach([
                    ['label'=>'Amount','value'=>$scholarship->formattedAmount,'color'=>'#4ade80'],
                    ['label'=>'Academic Year','value'=>$scholarship->academic_year,'color'=>'#e2e8f0'],
                    ['label'=>'Application Deadline','value'=>$scholarship->application_deadline->format('M d, Y'),'color'=>'#e2e8f0'],
                    ['label'=>'Max Recipients','value'=>$scholarship->max_recipients,'color'=>'#60a5fa'],
                ] as $field)
                <div class="p-4 rounded-xl" style="background:#0A1628;border:1px solid #1E3A8A;">
                    <p class="text-xs font-semibold mb-1" style="color:#8b949e;">{{ $field['label'] }}</p>
                    <p class="text-sm font-semibold" style="color:{{ $field['color'] }};">{{ $field['value'] }}</p>
                </div>
                @endforeach

                <div class="p-4 rounded-xl" style="background:#0A1628;border:1px solid #1E3A8A;">
                    <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Status</p>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full"
                        style="{{ $scholarship->status === 'active' ? 'background:rgba(34,197,94,0.15);color:#4ade80;' : 'background:rgba(248,113,113,0.15);color:#f87171;' }}">
                        {{ ucfirst($scholarship->status) }}
                    </span>
                </div>

                <div class="p-4 rounded-xl" style="background:#0A1628;border:1px solid #1E3A8A;">
                    <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Approval Status</p>
                    @php
                        $approvalStyle = match($scholarship->approval_status ?? 'pending') {
                            'approved' => 'background:rgba(34,197,94,0.15);color:#4ade80;',
                            'rejected' => 'background:rgba(248,113,113,0.15);color:#f87171;',
                            default    => 'background:rgba(251,191,36,0.15);color:#fbbf24;',
                        };
                    @endphp
                    <span class="px-2 py-1 text-xs font-semibold rounded-full" style="{{ $approvalStyle }}">
                        {{ ucfirst($scholarship->approval_status ?? 'pending') }}
                    </span>
                </div>
            </div>

            @if($scholarship->eligibility_criteria)
            <div class="p-4 rounded-xl" style="background:#0A1628;border:1px solid #1E3A8A;">
                <p class="text-xs font-semibold mb-2" style="color:#8b949e;">Eligibility Criteria</p>
                <p class="text-sm" style="color:#e2e8f0;">{{ $scholarship->eligibility_criteria }}</p>
            </div>
            @endif

            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin.scholarships.edit', $scholarship->id) }}"
                   class="px-5 py-2.5 text-sm font-semibold rounded-xl transition"
                   style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Edit</a>
                @if(($scholarship->approval_status ?? 'pending') !== 'approved')
                    <form action="{{ route('admin.scholarships.approve', $scholarship->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="px-5 py-2.5 text-sm font-semibold rounded-xl"
                                style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">✓ Approve</button>
                    </form>
                @endif
                @if(($scholarship->approval_status ?? 'pending') !== 'rejected')
                    <form action="{{ route('admin.scholarships.reject', $scholarship->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="px-5 py-2.5 text-sm font-semibold rounded-xl"
                                style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">✗ Reject</button>
                    </form>
                @endif
                <a href="{{ route('admin.scholarships.index') }}"
                   class="px-5 py-2.5 text-sm font-medium rounded-xl transition"
                   style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>
