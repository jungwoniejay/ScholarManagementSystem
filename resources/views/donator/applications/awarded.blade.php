@extends('layouts.app')
@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Funded Scholarships</h1>
            <p class="text-sm mt-1" style="color:#8b949e;">Track your funded scholarships and student responses</p>
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
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Student Response</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Responded On</th>
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
                                    @if($application->student_response === 'accept')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background:rgba(34,197,94,0.15);color:#22C55E;">✓ Accepted</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background:rgba(139,148,158,0.15);color:#8b949e;">✗ Declined</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm" style="color:#8b949e;">
                                    {{ $application->student_responded_at->format('M d, Y') }}
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-lg font-semibold text-white mb-2">No Funded Scholarships Yet</h3>
            <p style="color:#8b949e;">You haven't funded any scholarships that have been responded to by students.</p>
        </div>
    @endif
</div>
@endsection
