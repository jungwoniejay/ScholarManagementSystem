<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Announcements</h2>
    </x-slot>
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold" style="color:#e2e8f0;">Announcements</h1>
                <p class="text-sm" style="color:#8b949e;">Manage announcements for landing page and student dashboard.</p>
            </div>
            <a href="{{ route('admin.announcements.create') }}" class="px-4 py-2 text-sm font-semibold rounded-lg"
               style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">+ New Announcement</a>
        </div>

        {{-- Filters --}}
        <div class="rounded-xl p-5" style="background:#0F2044;border:1px solid #1E3A8A;">
            @php $is = 'background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;padding:8px 12px;border-radius:8px;font-size:13px;'; @endphp
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-xs font-semibold mb-1" style="color:#8b949e;">Status</label>
                    <select name="active" style="{{ $is }}">
                        <option value="">All</option>
                        <option value="1" {{ request('active')=='1'?'selected':'' }}>Active</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1" style="color:#8b949e;">Show on Landing</label>
                    <select name="landing" style="{{ $is }}">
                        <option value="">Any</option>
                        <option value="1" {{ request('landing')=='1'?'selected':'' }}>Yes</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1" style="color:#8b949e;">Student Dashboard</label>
                    <select name="dashboard" style="{{ $is }}">
                        <option value="">Any</option>
                        <option value="1" {{ request('dashboard')=='1'?'selected':'' }}>Yes</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-lg"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Filter</button>
                    @if(request()->hasAny(['active','landing','dashboard']))
                        <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Clear</a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Locations</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($announcements as $ann)
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold" style="color:#e2e8f0;">{{ $ann->title }}</p>
                                <p class="text-xs mt-1" style="color:#8b949e;">{{ Str::limit($ann->body, 80) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @php $tc = ['info'=>'rgba(96,165,250,0.15);color:#60a5fa;','warning'=>'rgba(251,191,36,0.15);color:#fbbf24;','success'=>'rgba(34,197,94,0.15);color:#4ade80;','danger'=>'rgba(248,113,113,0.15);color:#f87171;']; @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background:{{ $tc[$ann->type] ?? 'rgba(139,148,158,0.15);color:#8b949e;' }}">
                                    {{ ucfirst($ann->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @if($ann->show_on_landing)
                                        <span class="px-2 py-0.5 text-xs font-semibold rounded" style="background:rgba(96,165,250,0.15);color:#60a5fa;">Landing</span>
                                    @endif
                                    @if($ann->show_on_student_dashboard)
                                        <span class="px-2 py-0.5 text-xs font-semibold rounded" style="background:rgba(34,197,94,0.15);color:#4ade80;">Dashboard</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full"
                                    style="{{ $ann->is_active ? 'background:rgba(34,197,94,0.15);color:#4ade80;' : 'background:rgba(139,148,158,0.15);color:#8b949e;' }}">
                                    {{ $ann->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.announcements.edit', $ann) }}" class="px-3 py-1 text-xs font-semibold rounded"
                                       style="background:rgba(251,191,36,0.15);color:#fbbf24;">Edit</a>
                                    <form method="POST" action="{{ route('admin.announcements.destroy', $ann) }}" class="inline"
                                          onsubmit="return confirm('Delete this announcement?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs font-semibold rounded"
                                                style="background:rgba(248,113,113,0.15);color:#f87171;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-sm" style="color:#8b949e;">No announcements found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">{{ $announcements->appends(request()->query())->links() }}</div>
        </div>
    </div>
</x-app-layout>
