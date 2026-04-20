<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">General Settings</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">

        <div>
            <h1 class="text-2xl font-bold" style="color:#e2e8f0;">General Settings</h1>
            <p class="text-sm mt-1" style="color:#8b949e;">Manage system configuration and preferences</p>
        </div>

        @if(session('success'))
        <div class="p-4 rounded-xl text-sm font-medium" style="background:rgba(34,197,94,0.12);border:1px solid rgba(34,197,94,0.3);color:#4ade80;">
            ✓ {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf

            {{-- App Settings --}}
            <div class="rounded-xl p-6 mb-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                <h3 class="text-sm font-bold mb-4" style="color:#FFD700;">Application Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Application Name</label>
                        <input type="text" name="app_name" value="{{ config('app.name') }}"
                               class="w-full rounded-lg px-3 py-2.5 text-sm"
                               style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;outline:none;">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Application URL</label>
                        <input type="text" name="app_url" value="{{ config('app.url') }}"
                               class="w-full rounded-lg px-3 py-2.5 text-sm"
                               style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;outline:none;">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Environment</label>
                        <select name="app_env" class="w-full rounded-lg px-3 py-2.5 text-sm"
                                style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;outline:none;">
                            <option value="production" {{ config('app.env') === 'production' ? 'selected' : '' }}>Production</option>
                            <option value="local" {{ config('app.env') === 'local' ? 'selected' : '' }}>Local</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Session Settings --}}
            <div class="rounded-xl p-6 mb-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                <h3 class="text-sm font-bold mb-4" style="color:#FFD700;">Session & Security</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Session Lifetime (minutes)</label>
                        <input type="number" name="session_lifetime" value="{{ config('session.lifetime', 120) }}"
                               min="5" max="1440"
                               class="w-full rounded-lg px-3 py-2.5 text-sm"
                               style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;outline:none;">
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <div>
                            <p class="text-sm font-medium" style="color:#e2e8f0;">Debug Mode</p>
                            <p class="text-xs mt-0.5" style="color:#8b949e;">Show detailed error messages</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="app_debug" value="1" class="sr-only peer"
                                   {{ config('app.debug') ? 'checked' : '' }}>
                            <div class="w-10 h-5 rounded-full peer peer-checked:after:translate-x-5 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all"
                                 style="background:#1E3A8A;" id="debug-toggle"></div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Mail Settings --}}
            <div class="rounded-xl p-6 mb-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                <h3 class="text-sm font-bold mb-4" style="color:#FFD700;">Mail Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Mail From Address</label>
                        <input type="email" name="mail_from_address" value="{{ config('mail.from.address') }}"
                               class="w-full rounded-lg px-3 py-2.5 text-sm"
                               style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;outline:none;">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">Mail From Name</label>
                        <input type="text" name="mail_from_name" value="{{ config('mail.from.name') }}"
                               class="w-full rounded-lg px-3 py-2.5 text-sm"
                               style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;outline:none;">
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold rounded-xl"
                        style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;box-shadow:0 4px 15px rgba(255,215,0,0.3);">
                    Save Settings
                </button>
            </div>
        </form>

        {{-- System Info --}}
        <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h3 class="text-sm font-bold mb-4" style="color:#FFD700;">System Information</h3>
            <div class="grid grid-cols-2 gap-3">
                @foreach([
                    ['label'=>'PHP Version',     'value'=>phpversion()],
                    ['label'=>'Laravel Version', 'value'=>app()->version()],
                    ['label'=>'Environment',     'value'=>config('app.env')],
                    ['label'=>'Cache Driver',    'value'=>config('cache.default')],
                    ['label'=>'Session Driver',  'value'=>config('session.driver')],
                    ['label'=>'DB Connection',   'value'=>config('database.default')],
                ] as $info)
                <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                    <p class="text-xs" style="color:#8b949e;">{{ $info['label'] }}</p>
                    <p class="text-sm font-semibold mt-0.5" style="color:#e2e8f0;">{{ $info['value'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        const toggle = document.querySelector('input[name="app_debug"]');
        const toggleBg = document.getElementById('debug-toggle');
        function updateToggle() {
            toggleBg.style.background = toggle.checked ? '#B8860B' : '#1E3A8A';
        }
        toggle.addEventListener('change', updateToggle);
        updateToggle();
    </script>
</x-app-layout>
