<x-student-layout>
<div class="px-6 py-8 max-w-6xl mx-auto">

    {{-- Back --}}
    <a href="{{ route('student.scholarships.index') }}" class="inline-flex items-center gap-1 text-sm mb-6" style="color:#8b949e;">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Back to Scholarships
    </a>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="mb-4 px-4 py-3 rounded-lg text-sm" style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Main --}}
        <div class="lg:col-span-2 space-y-4">

            {{-- Header Card --}}
            <div class="rounded-xl border p-6" style="background:#0F2044;border-color:#1E3A8A;">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center font-bold text-lg flex-shrink-0"
                             style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                            {{ substr($scholarship->name, 0, 1) }}
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">{{ $scholarship->name }}</h1>
                            <p class="text-sm" style="color:#8b949e;">{{ $scholarship->academic_year }}</p>
                        </div>
                    </div>
                    @if($scholarship->status === 'active')
                        <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background:rgba(34,197,94,0.15);color:#4ade80;">Active</span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background:rgba(139,148,158,0.15);color:#8b949e;">Inactive</span>
                    @endif
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-4" style="border-top:1px solid #1E3A8A;border-bottom:1px solid #1E3A8A;">
                    @foreach([
                        ['label'=>'Amount',   'value'=>'₱'.number_format($scholarship->amount,2), 'color'=>'#FFD700'],
                        ['label'=>'Recipients','value'=>$scholarship->max_recipients,              'color'=>'#60A5FA'],
                        ['label'=>'Deadline', 'value'=>$scholarship->application_deadline?$scholarship->application_deadline->format('M d, Y'):'N/A', 'color'=>'#e2e8f0'],
                        ['label'=>'Funding',  'value'=>number_format($scholarship->funding_progress,1).'%', 'color'=>'#4ade80'],
                    ] as $f)
                    <div>
                        <p class="text-xs uppercase tracking-wide mb-1" style="color:#8b949e;">{{ $f['label'] }}</p>
                        <p class="text-sm font-bold" style="color:{{ $f['color'] }};">{{ $f['value'] }}</p>
                    </div>
                    @endforeach
                </div>

                {{-- Progress bar --}}
                <div class="mt-4">
                    <div class="w-full rounded-full h-2" style="background:#1E3A8A;">
                        <div class="h-2 rounded-full" style="width:{{ $scholarship->funding_progress }}%;background:linear-gradient(90deg,#FFD700,#B8860B);"></div>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            @if($scholarship->description)
            <div class="rounded-xl border p-6" style="background:#0F2044;border-color:#1E3A8A;">
                <h2 class="text-sm font-bold uppercase tracking-wide mb-3" style="color:#FFD700;">Description</h2>
                <p class="text-sm leading-relaxed" style="color:#e2e8f0;">{!! nl2br(e($scholarship->description)) !!}</p>
            </div>
            @endif

            {{-- Eligibility --}}
            @if($scholarship->eligibility_criteria)
            <div class="rounded-xl border p-6" style="background:#0F2044;border-color:#1E3A8A;">
                <h2 class="text-sm font-bold uppercase tracking-wide mb-3" style="color:#FFD700;">Eligibility Criteria</h2>
                <p class="text-sm leading-relaxed" style="color:#e2e8f0;">{!! nl2br(e($scholarship->eligibility_criteria)) !!}</p>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            <div class="rounded-xl border p-6 sticky top-6" style="background:#0F2044;border-color:#1E3A8A;">

                @if($existingApplication)
                    {{-- Already applied --}}
                    <div class="text-center py-4">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-3"
                             style="background:rgba(34,197,94,0.15);">
                            <svg class="w-7 h-7" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-white mb-2">Application Submitted</h3>
                        <p class="text-sm mb-4" style="color:#8b949e;">You have already applied for this scholarship.</p>
                        <div class="p-3 rounded-lg mb-4" style="background:#0A1628;">
                            <p class="text-xs mb-1" style="color:#8b949e;">Current Status</p>
                            <p class="text-sm font-semibold text-white capitalize">{{ $existingApplication->status }}</p>
                        </div>
                        <a href="{{ route('student.scholarships.status') }}"
                           class="block w-full py-2 rounded-xl text-sm font-medium text-center"
                           style="background:rgba(255,255,255,0.05);color:#8b949e;border:1px solid #1E3A8A;">
                            View All Applications
                        </a>
                    </div>

                @elseif($scholarship->isAcceptingApplications())
                    {{-- Apply form --}}
                    <h3 class="text-base font-semibold text-white mb-4">Apply for this Scholarship</h3>

                    <form action="{{ route('student.applications.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="scholarship_id" value="{{ $scholarship->id }}">

                        <div class="mb-4">
                            <label class="block text-xs font-medium mb-1" style="color:#8b949e;">
                                Personal Statement <span style="color:#f87171;">*</span>
                            </label>
                            <textarea name="personal_statement" rows="5" required
                                      class="w-full rounded-lg px-3 py-2 text-sm border focus:outline-none"
                                      style="background:#0A1628;border-color:#1E3A8A;color:#e2e8f0;"
                                      placeholder="Tell us why you deserve this scholarship...">{{ old('personal_statement') }}</textarea>
                        </div>

                        <div class="mb-5">
                            <label class="block text-xs font-medium mb-2" style="color:#8b949e;">Documents (Optional)</label>
                            <div class="p-3 rounded-lg mb-2 text-xs" style="background:#0A1628;color:#60A5FA;border:1px solid rgba(96,165,250,0.2);">
                                📄 Submit Grade 12 Report Card, Certificate of Indigency, and Proof of Income for a higher AI score.
                            </div>

                            {{-- Drop zone --}}
                            <div id="drop-zone"
                                 onclick="document.getElementById('doc-input').click()"
                                 ondragover="event.preventDefault();this.style.borderColor='#FFD700';this.style.background='rgba(255,215,0,0.05)'"
                                 ondragleave="this.style.borderColor='#1E3A8A';this.style.background='#0A1628'"
                                 ondrop="handleDrop(event)"
                                 class="w-full rounded-lg p-4 text-center cursor-pointer transition-all"
                                 style="background:#0A1628;border:2px dashed #1E3A8A;">
                                <svg class="mx-auto mb-1" width="22" height="22" fill="none" stroke="rgba(255,215,0,0.5)" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                <p class="text-xs" style="color:#8b949e;">Click or drag &amp; drop files here</p>
                                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.25);">PDF, JPG, PNG — max 10MB each</p>
                            </div>
                            <input id="doc-input" type="file" name="documents[]" multiple accept=".pdf,.jpg,.jpeg,.png" class="hidden" onchange="updateFileList(this.files)">

                            {{-- File list --}}
                            <ul id="file-list" class="mt-2 space-y-1"></ul>
                        </div>

                        <script>
                        function updateFileList(files) {
                            const list = document.getElementById('file-list');
                            list.innerHTML = '';
                            Array.from(files).forEach((f, i) => {
                                const li = document.createElement('li');
                                li.style.cssText = 'display:flex;align-items:center;justify-content:space-between;padding:6px 10px;border-radius:8px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);font-size:11px;color:#e2e8f0;';
                                li.innerHTML = `<span style="truncate;max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">📄 ${f.name}</span><span style="color:rgba(255,255,255,0.35);flex-shrink:0;margin-left:8px;">${(f.size/1024/1024).toFixed(1)} MB</span>`;
                                list.appendChild(li);
                            });
                        }

                        function handleDrop(e) {
                            e.preventDefault();
                            const zone = document.getElementById('drop-zone');
                            zone.style.borderColor = '#1E3A8A';
                            zone.style.background = '#0A1628';
                            const input = document.getElementById('doc-input');
                            input.files = e.dataTransfer.files;
                            updateFileList(input.files);
                        }
                        </script>

                        <button type="submit"
                                class="w-full py-3 rounded-xl font-bold text-sm"
                                style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                            Submit Application
                        </button>
                    </form>

                @else
                    {{-- Closed --}}
                    <div class="text-center py-4">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-3"
                             style="background:rgba(139,148,158,0.15);">
                            <svg class="w-7 h-7" fill="none" stroke="#8b949e" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-white mb-2">Applications Closed</h3>
                        <p class="text-sm" style="color:#8b949e;">
                            @if($scholarship->approval_status !== 'approved')
                                This scholarship is pending approval.
                            @elseif($scholarship->status !== 'active')
                                This scholarship is currently inactive.
                            @elseif($scholarship->application_deadline && $scholarship->application_deadline->isPast())
                                The application deadline has passed.
                            @else
                                This scholarship is no longer accepting applications.
                            @endif
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
</x-student-layout>
