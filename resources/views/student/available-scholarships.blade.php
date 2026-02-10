<div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
    <div class="flex items-center justify-between mb-4 sm:mb-6">
        <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center space-x-2">
            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <span>Available Scholarships</span>
        </h3>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($scholarships as $scholarship)
        <div class="bg-gradient-to-br from-slate-50 to-slate-100 p-4 rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-slate-200/60">
            <div class="flex items-start justify-between mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center text-white font-bold">
                    {{ substr($scholarship->name, 0, 1) }}
                </div>
                <span class="text-xs px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full font-semibold">
                    Active
                </span>
            </div>
            <h4 class="font-semibold text-slate-900 mb-2 text-sm">{{ $scholarship->name }}</h4>
            <p class="text-xs text-slate-600 mb-3 line-clamp-2">{{ $scholarship->description ?? 'No description available' }}</p>
            <div class="flex items-center justify-between text-xs">
                <span class="text-slate-500">Deadline: {{ $scholarship->deadline ? $scholarship->deadline->format('M d, Y') : 'N/A' }}</span>
                <a href="{{ route('student.scholarships.show', $scholarship) }}" class="text-purple-600 hover:text-purple-700 font-semibold">
                    View Details →
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-6 sm:py-8 text-slate-400">
            <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <p>No scholarships available</p>
            <p class="text-xs mt-1">Check back later for new opportunities</p>
        </div>
        @endforelse
    </div>
</div>
