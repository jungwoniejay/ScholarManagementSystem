<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Courses</h2>
    </x-slot>
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold" style="color:#e2e8f0;">Courses</h1>
                <p class="text-sm" style="color:#8b949e;">Manage academic courses for student enrollment.</p>
            </div>
            <a href="{{ route('admin.courses.create') }}" class="px-4 py-2 text-sm font-semibold rounded-lg"
               style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">+ New Course</a>
        </div>

        @if(session('success'))
            <div class="px-4 py-3 rounded-lg text-sm" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">{{ session('success') }}</div>
        @endif

        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <td class="px-6 py-4 text-sm font-mono font-semibold" style="color:#FFD700;">{{ $course->code }}</td>
                            <td class="px-6 py-4 text-sm font-semibold" style="color:#e2e8f0;">{{ $course->name }}</td>
                            <td class="px-6 py-4 text-sm max-w-xs truncate" style="color:#8b949e;">{{ $course->description ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full"
                                    style="{{ $course->is_active ? 'background:rgba(34,197,94,0.15);color:#4ade80;' : 'background:rgba(139,148,158,0.15);color:#8b949e;' }}">
                                    {{ $course->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="px-3 py-1 text-xs font-semibold rounded"
                                       style="background:rgba(251,191,36,0.15);color:#fbbf24;">Edit</a>
                                    <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="inline"
                                          onsubmit="return confirm('Delete this course?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs font-semibold rounded"
                                                style="background:rgba(248,113,113,0.15);color:#f87171;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-sm" style="color:#8b949e;">No courses found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">{{ $courses->links() }}</div>
        </div>
    </div>
</x-app-layout>
