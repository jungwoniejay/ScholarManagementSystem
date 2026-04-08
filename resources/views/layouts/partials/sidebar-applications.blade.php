{{-- Application Management --}}
<div class="px-4 mt-6 mb-2">
    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Application Management</p>
</div>

<a href="{{ route('admin.applications.pending') }}" 
   class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg transition-colors {{ request()->routeIs('admin.applications.pending') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="text-sm font-medium">Pending</span>
</a>

<a href="{{ route('admin.applications.review') }}" 
   class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg transition-colors {{ request()->routeIs('admin.applications.review') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
    </svg>
    <span class="text-sm font-medium">Under Review</span>
</a>

<a href="{{ route('admin.applications.shortlist') }}" 
   class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg transition-colors {{ request()->routeIs('admin.applications.shortlist') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 4l-3 3 1.5 1.5"/>
    </svg>
    <span class="text-sm font-medium">Shortlisted</span>
</a>

<a href="{{ route('admin.applications.completed') }}" 
   class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg transition-colors {{ request()->routeIs('admin.applications.completed') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="text-sm font-medium">Completed</span>
</a>

<a href="{{ route('admin.applications.rejected') }}" 
   class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg transition-colors {{ request()->routeIs('admin.applications.rejected') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="text-sm font-medium">Rejected</span>
</a>

<a href="{{ route('admin.applications.screened') }}" 
   class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg transition-colors {{ request()->routeIs('admin.applications.screened') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-1.293 1.293a1 1 0 01-.707.293H7a1 1 0 01-1-1v-2.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
    </svg>
    <span class="text-sm font-medium">Screened</span>
</a>
