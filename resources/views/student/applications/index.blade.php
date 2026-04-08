<x-student-layout>
    <x-slot name="header">
        My Applications
    </x-slot>

    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
        <div class="flex items-center justify-between mb-4 sm:mb-6">
            <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center space-x-2">
                <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span>My Applications</span>
            </h3>
        </div>

        <div class="space-y-3">
            @forelse($applications as $application)
            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-3 sm:p-4 bg-slate-50 hover:bg-slate-100 rounded-xl transition-colors space-y-2 sm:space-y-0">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                        {{ substr($application->scholarship->name ?? 'S', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-slate-900 text-sm sm:text-base">{{ $application->scholarship->name ?? 'Scholarship' }}</p>
                        <p class="text-xs sm:text-sm text-slate-500">Applied {{ $application->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-xs px-2 sm:px-3 py-1 rounded-full font-semibold
                        {{ $application->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                        {{ $application->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : '' }}
                        {{ $application->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
            </div>
            @empty
            <div class="text-center py-6 sm:py-8 text-slate-400">
                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p>No applications yet</p>
                <p class="text-xs mt-1">Start by browsing available scholarships</p>
            </div>
            @endforelse
        </div>
    </div>
</x-student-layout>
