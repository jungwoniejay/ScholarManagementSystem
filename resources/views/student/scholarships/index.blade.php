<x-student-layout>
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold" style="color:#FFD700;">Available Scholarships</h1>
            <p class="text-sm mt-1" style="color:rgba(255,255,255,0.4);">Explore and apply for scholarships that match your profile</p>
        </div>
        <span class="text-sm font-semibold px-3 py-1 rounded-full" style="background:rgba(255,215,0,0.1);color:#FFD700;border:1px solid rgba(255,215,0,0.2);">
            {{ $scholarships->total() }} available
        </span>
    </div>

    @if(session('success'))
        <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#22C55E;border:1px solid rgba(34,197,94,0.3);">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(248,113,113,0.15);color:#F87171;border:1px solid rgba(248,113,113,0.3);">
            {{ session('error') }}
        </div>
    @endif

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('student.scholarships.index') }}"
          class="flex flex-col sm:flex-row gap-3 p-4 rounded-xl"
          style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
        <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search scholarships..."
                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.6rem 0.85rem 0.6rem 2.25rem;color:#fff;font-size:0.875rem;outline:none;"
                   onfocus="this.style.borderColor='rgba(255,215,0,0.5)'"
                   onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
        </div>
        <select name="sort"
                style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.6rem 0.85rem;color:#fff;font-size:0.875rem;outline:none;min-width:150px;">
            <option value="" style="background:#0F2044;" {{ ($sort ?? '') === '' ? 'selected' : '' }}>Latest</option>
            <option value="amount-high" style="background:#0F2044;" {{ ($sort ?? '') === 'amount-high' ? 'selected' : '' }}>Highest Amount</option>
            <option value="amount-low" style="background:#0F2044;" {{ ($sort ?? '') === 'amount-low' ? 'selected' : '' }}>Lowest Amount</option>
            <option value="deadline" style="background:#0F2044;" {{ ($sort ?? '') === 'deadline' ? 'selected' : '' }}>Deadline</option>
        </select>
        <button type="submit"
                style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;font-weight:700;border:none;border-radius:8px;padding:0.6rem 1.25rem;font-size:0.875rem;cursor:pointer;white-space:nowrap;">
            Search
        </button>
    </form>

    {{-- Grid --}}
    @if($scholarships->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($scholarships as $scholarship)
            <div class="rounded-xl overflow-hidden flex flex-col transition-all duration-300"
                 style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);"
                 onmouseover="this.style.borderColor='rgba(255,215,0,0.3)';this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 40px rgba(0,0,0,0.4)'"
                 onmouseout="this.style.borderColor='rgba(255,215,0,0.1)';this.style.transform='translateY(0)';this.style.boxShadow='none'">

                <div class="p-5 flex-1">
                    {{-- Top row --}}
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center font-bold text-lg flex-shrink-0"
                             style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                            {{ strtoupper(substr($scholarship->name, 0, 1)) }}
                        </div>
                        @if($scholarship->isAcceptingApplications())
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold" style="background:rgba(34,197,94,0.15);color:#22C55E;">
                                Accepting
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold" style="background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.4);">
                                Closed
                            </span>
                        @endif
                    </div>

                    <h3 class="font-bold text-white mb-1 truncate">{{ $scholarship->name }}</h3>
                    <p class="text-xs mb-3" style="color:rgba(255,215,0,0.6);">{{ $scholarship->academic_year }}</p>
                    <p class="text-sm mb-4 line-clamp-2" style="color:rgba(255,255,255,0.45);line-height:1.6;">
                        {{ $scholarship->description ?? 'No description available.' }}
                    </p>

                    {{-- Details --}}
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span style="color:rgba(255,255,255,0.4);">Amount</span>
                            <span class="font-bold" style="color:#FFD700;">₱{{ number_format($scholarship->amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span style="color:rgba(255,255,255,0.4);">Recipients</span>
                            <span class="font-semibold text-white">{{ $scholarship->max_recipients }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span style="color:rgba(255,255,255,0.4);">Deadline</span>
                            <span class="font-semibold text-white">
                                {{ $scholarship->application_deadline ? $scholarship->application_deadline->format('M d, Y') : 'No deadline' }}
                            </span>
                        </div>
                    </div>

                    {{-- Funding progress --}}
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span style="color:rgba(255,255,255,0.35);">Funding Progress</span>
                            <span class="font-semibold" style="color:#FFD700;">{{ number_format($scholarship->funding_progress, 1) }}%</span>
                        </div>
                        <div class="w-full rounded-full h-1.5" style="background:rgba(255,255,255,0.08);">
                            <div class="h-1.5 rounded-full" style="width:{{ min($scholarship->funding_progress, 100) }}%;background:linear-gradient(90deg,#FFD700,#B8860B);"></div>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="px-5 py-3" style="border-top:1px solid rgba(255,255,255,0.06);">
                    <a href="{{ route('student.scholarships.show', $scholarship) }}"
                       class="block w-full text-center py-2 rounded-lg text-sm font-bold transition"
                       style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;"
                       onmouseover="this.style.boxShadow='0 6px 20px rgba(255,215,0,0.4)'"
                       onmouseout="this.style.boxShadow='none'">
                        {{ $scholarship->isAcceptingApplications() ? 'Apply Now →' : 'View Details →' }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $scholarships->links() }}
        </div>

    @else
        <div class="rounded-xl p-12 text-center" style="background:#0F2044;border:1px solid rgba(255,255,255,0.07);">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(255,215,0,0.08);">
                <svg class="w-8 h-8" fill="none" stroke="rgba(255,215,0,0.4)" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">No Scholarships Available</h3>
            <p class="text-sm mb-6" style="color:rgba(255,255,255,0.4);">
                {{ $search ? 'No scholarships match your search. Try different keywords.' : 'There are currently no scholarships available. Check back later!' }}
            </p>
            @if($search)
                <a href="{{ route('student.scholarships.index') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold" style="color:rgba(255,215,0,0.7);">
                    ← Clear search
                </a>
            @else
                <a href="{{ route('student.dashboard') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold" style="color:rgba(255,215,0,0.7);">
                    ← Back to Dashboard
                </a>
            @endif
        </div>
    @endif

</div>
</x-student-layout>
