<div class="px-3 pt-4 pb-2">
    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">User Management</p>
</div>

<a href="{{ route('admin.students.index') }}" 
   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.students.*') ? 'bg-gradient-to-r from-amber-50 to-amber-100 text-amber-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-[18px] h-[18px] {{ request()->routeIs('admin.students.*') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
    </svg>
    <span class="text-sm font-medium">Students</span>
</a>

<a href="{{ route('admin.donators.index') }}" 
   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.donators.*') ? 'bg-gradient-to-r from-amber-50 to-amber-100 text-amber-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-[18px] h-[18px] {{ request()->routeIs('admin.donators.*') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
    </svg>
    <span class="text-sm font-medium">Donors</span>
</a>

<a href="{{ route('admin.accounts.index') }}" 
   class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.accounts.*') ? 'bg-gradient-to-r from-amber-50 to-amber-100 text-amber-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-[18px] h-[18px] {{ request()->routeIs('admin.accounts.*') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
    </svg>
    <span class="text-sm font-medium">Admin Accounts</span>
</a>
