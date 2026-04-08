<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Create AI Rule</h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <a href="{{ route('admin.rules.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Rules
        </a>

        <div class="rounded-2xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-xl font-bold mb-4" style="color:#e2e8f0;">Create AI Rule</h1>
            <form method="POST" action="{{ route('admin.rules.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Key</label>
                    <input type="text" name="key" value="{{ old('key') }}" required
                           class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">
                    @error('key')<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Value</label>
                    <textarea name="value" rows="4" required
                              class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                              style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">{{ old('value') }}</textarea>
                    @error('value')<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Create Rule</button>
                    <a href="{{ route('admin.rules.index') }}" class="px-5 py-2.5 text-sm font-medium rounded-xl transition"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
