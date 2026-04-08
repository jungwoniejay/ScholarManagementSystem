@extends('layouts.app')
@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Awaiting Student Response</h1>
            <p class="text-sm mt-1" style="color:#8b949e;">Scholarships you funded that are waiting for student acceptance</p>
        </div>
        <a href="{{ route('donator.applications.index') }}" class="flex items-center gap-1 text-sm" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Applications
        </a>
    </div>

    @if($applications->count() > 0)
        <div class="rounded-xl border overflow-hidden" style="background:#0F2044;border-color:#1E3A8A;">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Scholarship</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Approved On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
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
                                </td>
                                <td class="px-6 py-4 font-bold text-white text-sm">
                                    ₱{{ number_format($application->awarded_amount, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background:rgba(251,191,36,0.15);color:#FBBF24;">
                                        ⏳ Awaiting Response
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm" style="color:#8b949e;">
                                    {{ $application->donor_reviewed_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($applications->hasPages())
                <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="rounded-xl border p-12 text-center" style="background:#0F2044;border-color:#1E3A8A;">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#FFD700;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-lg font-semibold text-white mb-2">All Students Have Responded</h3>
            <p style="color:#8b949e;">No scholarships are currently awaiting student responses.</p>
        </div>
    @endif
</div>
@endsection
