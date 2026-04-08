<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">AI Automation Rules</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold" style="color:#e2e8f0;">AI Automation Rules</h1>
                <p class="text-sm" style="color:#8b949e;">Manage key-value rules used by the AI automation system</p>
            </div>
            <a href="{{ route('admin.rules.create') }}"
               class="px-4 py-2 text-sm font-semibold rounded-lg transition"
               style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                + Add Rule
            </a>
        </div>

        @if(session('success'))
            <div class="px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Key</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Value</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rules as $rule)
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <td class="px-6 py-4 text-sm font-mono font-semibold" style="color:#FFD700;">{{ $rule->key }}</td>
                            <td class="px-6 py-4 text-sm max-w-md truncate" style="color:#8b949e;">{{ $rule->value }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.rules.edit', $rule->id) }}"
                                       class="px-3 py-1 text-xs font-semibold rounded"
                                       style="background:rgba(251,191,36,0.15);color:#fbbf24;">Edit</a>
                                    <form action="{{ route('admin.rules.destroy', $rule->id) }}" method="POST"
                                          onsubmit="return confirm('Delete this rule?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs font-semibold rounded"
                                                style="background:rgba(248,113,113,0.15);color:#f87171;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-sm" style="color:#8b949e;">No rules found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">{{ $rules->links() }}</div>
        </div>
    </div>
</x-app-layout>
