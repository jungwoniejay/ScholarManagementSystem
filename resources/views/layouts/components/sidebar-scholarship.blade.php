<div class="px-3 pt-5 pb-2">
    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Scholarship Management</p>
</div>

<a href="{{ route('admin.scholarships.index') }}" 
   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.scholarships.*') ? 'bg-gradient-to-r from-amber-50 to-amber-100 text-amber-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-[18px] h-[18px] {{ request()->routeIs('admin.scholarships.*') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
    </svg>
    <span class="text-sm font-medium">Scholarships</span>
</a>

<a href="{{ route('admin.donations.index') }}" 
   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.donations.*') ? 'bg-gradient-to-r from-amber-50 to-amber-100 text-amber-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-[18px] h-[18px] {{ request()->routeIs('admin.donations.*') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="text-sm font-medium">Donations</span>
</a>
