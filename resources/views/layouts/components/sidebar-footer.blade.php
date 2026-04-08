<div class="p-4 border-t border-gray-200">
    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
        </div>
        <div class="flex-1 min-w-0">
            <p class="font-semibold text-sm truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
            <p class="text-xs text-gray-500">Admin</p>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="shrink-0">
            @csrf
            <button type="submit" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-white rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </button>
        </form>
    </div>
</div>
