<x-student-layout>
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold" style="color:#FFD700;">My Documents</h1>
        <p class="text-sm mt-1" style="color:rgba(255,255,255,0.4);">Documents submitted with your scholarship applications</p>
    </div>

    {{-- Document List --}}
    <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
        <div class="px-5 py-4" style="border-bottom:1px solid rgba(255,255,255,0.07);">
            <h3 class="font-bold text-white text-sm flex items-center gap-2">
                <span style="width:26px;height:26px;background:linear-gradient(135deg,#FFD700,#B8860B);border-radius:7px;display:inline-flex;align-items:center;justify-content:center;">
                    <svg width="13" height="13" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </span>
                All Documents
            </h3>
        </div>

        <div class="divide-y" style="border-color:rgba(255,255,255,0.05);">
            @forelse($documents as $document)
            <div class="flex flex-col sm:flex-row sm:items-center justify-between px-5 py-4 gap-3 transition"
                 onmouseover="this.style.background='rgba(255,215,0,0.03)'"
                 onmouseout="this.style.background='transparent'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm flex-shrink-0"
                         style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                        {{ strtoupper(substr($document->application->scholarship->name ?? 'D', 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-white text-sm">{{ $document->name ?? 'Document' }}</p>
                        <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.4);">
                            {{ $document->application->scholarship->name ?? 'Scholarship' }}
                            &middot; {{ $document->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3 flex-shrink-0">
                    @php
                        $sc = [
                            'pending'  => ['#FBBF24','rgba(251,191,36,0.12)'],
                            'approved' => ['#22C55E','rgba(34,197,94,0.12)'],
                            'rejected' => ['#F87171','rgba(248,113,113,0.12)'],
                        ];
                        [$tc,$bc] = $sc[$document->status ?? 'pending'] ?? ['#8b949e','rgba(139,148,158,0.12)'];
                    @endphp
                    <span class="text-xs font-semibold px-3 py-1 rounded-full"
                          style="color:{{ $tc }};background:{{ $bc }};">
                        {{ ucfirst($document->status ?? 'pending') }}
                    </span>
                    @if($document->file_path)
                    <a href="{{ Storage::url($document->file_path) }}" target="_blank"
                       class="text-xs font-semibold px-3 py-1 rounded-lg transition"
                       style="color:rgba(255,215,0,0.7);border:1px solid rgba(255,215,0,0.2);"
                       onmouseover="this.style.background='rgba(255,215,0,0.08)'"
                       onmouseout="this.style.background='transparent'">
                        View
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="px-5 py-14 text-center">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3"
                     style="background:rgba(255,215,0,0.08);">
                    <svg width="24" height="24" fill="none" stroke="rgba(255,215,0,0.4)" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-sm font-semibold" style="color:rgba(255,255,255,0.4);">No documents yet</p>
                <p class="text-xs mt-1" style="color:rgba(255,255,255,0.25);">Documents will appear here once you submit applications</p>
            </div>
            @endforelse
        </div>
    </div>

</div>
</x-student-layout>
