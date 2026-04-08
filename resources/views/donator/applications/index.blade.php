@extends('layouts.app')
@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Applications for Review</h1>
            <p class="text-sm mt-1" style="color:#8b949e;">Review shortlisted applications and make funding decisions</p>
        </div>
        <a href="{{ route('donator.dashboard') }}" class="flex items-center gap-1 text-sm" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Dashboard
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach([
            ['label'=>'Pending Review',      'value'=>$stats['pending'],  'color'=>'#FBBF24'],
            ['label'=>'Approved',            'value'=>$stats['approved'], 'color'=>'#22C55E'],
            ['label'=>'Rejected',            'value'=>$stats['rejected'], 'color'=>'#F87171'],
            ['label'=>'Total Applications',  'value'=>$stats['total'],    'color'=>'#FFD700'],
        ] as $s)
        <div class="rounded-xl p-4 border" style="background:#0F2044;border-color:#1E3A8A;">
            <div class="text-xs mb-1" style="color:#8b949e;">{{ $s['label'] }}</div>
            <div class="text-2xl font-bold" style="color:{{ $s['color'] }};">{{ $s['value'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Tabs + Table --}}
    <div class="rounded-xl border overflow-hidden" style="background:#0F2044;border-color:#1E3A8A;">

        {{-- Tabs --}}
        <div class="flex" style="border-bottom:1px solid #1E3A8A;">
            @php
                $tabs = [
                    ['id'=>'pending',  'label'=>'Pending Review',    'count'=>$stats['pending']],
                    ['id'=>'approved', 'label'=>'Approved',          'count'=>$stats['approved']],
                    ['id'=>'rejected', 'label'=>'Rejected',          'count'=>$stats['rejected']],
                    ['id'=>'all',      'label'=>'All Applications',  'count'=>$stats['total']],
                ];
            @endphp
            @foreach($tabs as $tab)
                <a href="{{ route('donator.applications.index', ['status' => $tab['id']]) }}"
                   class="flex-1 px-4 py-3 text-center text-sm font-medium transition-colors"
                   style="{{ $status === $tab['id'] ? 'color:#FFD700;border-bottom:2px solid #FFD700;background:rgba(255,215,0,0.05);' : 'color:#8b949e;' }}">
                    {{ $tab['label'] }}
                    <span class="ml-1 px-2 py-0.5 rounded-full text-xs"
                          style="{{ $status === $tab['id'] ? 'background:rgba(255,215,0,0.15);color:#FFD700;' : 'background:rgba(255,255,255,0.05);color:#8b949e;' }}">
                        {{ $tab['count'] }}
                    </span>
                </a>
            @endforeach
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr style="border-bottom:1px solid #1E3A8A;">
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Scholarship</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">AI Score</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Admin Remarks</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Documents</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr style="border-bottom:1px solid rgba(30,58,138,0.4);" onmouseover="this.style.background='rgba(255,215,0,0.03)'" onmouseout="this.style.background='transparent'">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0"
                                         style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                                        {{ strtoupper(substr($application->student->user->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-white text-sm">{{ $application->student->user->name ?? 'Student' }}</div>
                                        <div class="text-xs" style="color:#8b949e;">{{ $application->student->user->email ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-white text-sm">{{ $application->scholarship->name ?? 'N/A' }}</div>
                                <div class="text-xs" style="color:#8b949e;">₱{{ number_format($application->scholarship->amount ?? 0, 2) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($application->ai_score)
                                    <span class="font-bold text-white">{{ $application->ai_score }}</span>
                                    @if($application->ai_score >= 80)
                                        <span class="ml-1 px-2 py-0.5 rounded-full text-xs" style="background:rgba(34,197,94,0.15);color:#22C55E;">Excellent</span>
                                    @elseif($application->ai_score >= 60)
                                        <span class="ml-1 px-2 py-0.5 rounded-full text-xs" style="background:rgba(251,191,36,0.15);color:#FBBF24;">Good</span>
                                    @else
                                        <span class="ml-1 px-2 py-0.5 rounded-full text-xs" style="background:rgba(139,148,158,0.15);color:#8b949e;">Fair</span>
                                    @endif
                                @else
                                    <span style="color:#8b949e;">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs truncate text-sm" style="color:#8b949e;" title="{{ $application->remarks }}">
                                    {{ $application->remarks ?? 'No remarks' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium" style="background:rgba(96,165,250,0.15);color:#60A5FA;">
                                    {{ $application->documents->count() }} doc(s)
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('donator.applications.show', $application) }}"
                                   class="text-sm font-semibold" style="color:#FFD700;">
                                    Review →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center" style="color:#8b949e;">
                                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p>No applications found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
            <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
