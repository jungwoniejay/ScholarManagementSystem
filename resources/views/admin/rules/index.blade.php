<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#FFD700;">AI Automation Rules</h2>
    </x-slot>

    @php
    $descriptions = [
        // Weights
        'weight_gpa'                => ['GPA Weight (%)', 'How much GPA contributes to the AI score. Default: 40'],
        'weight_financial_need'     => ['Financial Need Weight (%)', 'How much financial need contributes. Default: 30'],
        'weight_personal_statement' => ['Statement Weight (%)', 'How much the personal statement contributes. Default: 20'],
        'weight_enrollment_year'    => ['Enrollment Year Weight (%)', 'How much year level contributes. Default: 10'],
        // GPA
        'min_gpa'                   => ['Minimum GPA', 'Applications below this GPA are auto-rejected. Default: 2.00'],
        'auto_reject_below_gpa'     => ['Hard Reject GPA', 'Absolute floor — instantly rejected below this. Default: 1.50'],
        'gpa_excellent_threshold'   => ['Excellent GPA', 'GPA at or above this gets full GPA score. Default: 3.50'],
        'gpa_good_threshold'        => ['Good GPA', 'GPA at or above this gets 75% GPA score. Default: 2.75'],
        // Auto-actions
        'auto_shortlist_score'      => ['Auto-Shortlist Score', 'AI score at or above this → auto shortlisted. Default: 80'],
        'auto_reject_score'         => ['Auto-Reject Score', 'AI score at or below this → auto rejected. Default: 30'],
        'auto_review_score'         => ['Auto-Review Score', 'AI score at or above this → sent to review. Default: 50'],
        // Enrollment
        'preferred_enrollment_year' => ['Preferred Year Levels', 'Comma-separated year levels that get full year score. e.g. 1,2'],
        'max_enrollment_year'       => ['Max Year Level', 'Students above this year level are rejected. Default: 4'],
        // Course
        'allowed_courses'           => ['Allowed Courses', 'Comma-separated courses allowed. Use "all" to allow everyone.'],
        // Statement
        'min_statement_words'       => ['Min Statement Words', 'Personal statement must have at least this many words. Default: 50'],
        // Documents
        'require_documents'         => ['Require Documents', 'Set to "true" to require at least one document. Default: true'],
        'min_documents'             => ['Min Documents', 'Minimum number of documents required. Default: 1'],
        // Labels
        'score_label_high'          => ['High Score Label', 'Score at or above this is shown as "High". Default: 75'],
        'score_label_medium'        => ['Medium Score Label', 'Score at or above this is shown as "Medium". Default: 50'],
    ];
    @endphp

    <div class="max-w-7xl mx-auto space-y-6">

        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold" style="color:#fff;">AI Automation Rules</h1>
                <p class="text-sm mt-1" style="color:#8b949e;">These rules control how applications are automatically scored and screened</p>
            </div>
            <div class="flex gap-3">
                <form method="POST" action="{{ route('admin.rules.store') }}" class="inline">
                    @csrf
                    <input type="hidden" name="_seed" value="1">
                </form>
                <a href="{{ route('admin.rules.create') }}"
                   class="px-4 py-2 text-sm font-semibold rounded-lg"
                   style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                    + Add Rule
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">
                {{ session('success') }}
            </div>
        @endif

        {{-- How it works banner --}}
        <div class="rounded-xl p-5" style="background:rgba(255,215,0,0.06);border:1px solid rgba(255,215,0,0.2);">
            <div class="flex items-start gap-3">
                <svg width="20" height="20" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24" class="flex-shrink-0 mt-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm font-bold mb-1" style="color:#FFD700;">How AI Screening Works</p>
                    <p class="text-sm" style="color:rgba(255,255,255,0.6);">
                        When a student submits an application, the AI automatically scores it from <strong style="color:#fff;">0–100</strong> based on the weights and thresholds below.
                        Applications scoring ≥ <strong style="color:#fff;">auto_shortlist_score</strong> are shortlisted, ≥ <strong style="color:#fff;">auto_review_score</strong> go to review, and ≤ <strong style="color:#fff;">auto_reject_score</strong> are rejected.
                        Weights for GPA, financial need, personal statement, and enrollment year must ideally add up to <strong style="color:#fff;">100</strong>.
                    </p>
                </div>
            </div>
        </div>

        {{-- Rules Table --}}
        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Key</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Description</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Current Value</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rules as $rule)
                        @php [$label, $desc] = $descriptions[$rule->key] ?? [$rule->key, 'Custom rule']; @endphp
                        <tr style="border-bottom:1px solid rgba(30,58,138,0.4);"
                            onmouseover="this.style.background='rgba(255,215,0,0.02)'"
                            onmouseout="this.style.background='transparent'">
                            <td class="px-5 py-4">
                                <code class="text-xs font-mono font-bold px-2 py-1 rounded"
                                      style="background:rgba(255,215,0,0.1);color:#FFD700;">{{ $rule->key }}</code>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-sm font-semibold text-white">{{ $label }}</p>
                                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.4);">{{ $desc }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <span class="text-sm font-semibold" style="color:#60A5FA;">{{ $rule->value }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.rules.edit', $rule->id) }}"
                                       class="px-3 py-1 text-xs font-semibold rounded"
                                       style="background:rgba(251,191,36,0.15);color:#fbbf24;">Edit</a>
                                    <form action="{{ route('admin.rules.destroy', $rule->id) }}" method="POST"
                                          onsubmit="return confirm('Delete this rule?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs font-semibold rounded"
                                                style="background:rgba(248,113,113,0.15);color:#f87171;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-sm" style="color:#8b949e;">
                                No rules found. <a href="{{ route('admin.rules.create') }}" style="color:#FFD700;">Add your first rule →</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-4" style="border-top:1px solid #1E3A8A;">{{ $rules->links() }}</div>
        </div>

        {{-- Quick Reference --}}
        <div class="rounded-xl p-5" style="background:#0F2044;border:1px solid rgba(255,255,255,0.07);">
            <h3 class="text-sm font-bold text-white mb-4">Quick Reference — All Available Keys</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach($descriptions as $key => [$label, $desc])
                <div class="p-3 rounded-lg" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);">
                    <code class="text-xs font-mono" style="color:#FFD700;">{{ $key }}</code>
                    <p class="text-xs mt-1 font-semibold text-white">{{ $label }}</p>
                    <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.35);">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
