<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Students</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold" style="color:#e2e8f0;">Students</h1>
                <p class="text-sm" style="color:#8b949e;">Manage all registered students</p>
            </div>
            <a href="{{ route('admin.students.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition"
               style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                + Add Student
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
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr style="border-bottom:1px solid #1E3A8A;">
                                <td class="px-6 py-4 font-semibold text-sm" style="color:#e2e8f0;">
                                    {{ $student->first_name }} {{ $student->last_name }}
                                </td>
                                <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $student->email }}</td>
                                <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $student->phone ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $student->course ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold"
                                        style="{{ $student->status === 'active' ? 'background:rgba(34,197,94,0.15);color:#4ade80;' : 'background:rgba(139,148,158,0.15);color:#8b949e;' }}">
                                        {{ ucfirst($student->status ?? 'N/A') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.students.show', $student) }}"
                                           class="px-3 py-1 text-xs font-semibold rounded transition"
                                           style="background:rgba(96,165,250,0.15);color:#60a5fa;">View</a>
                                        <a href="{{ route('admin.students.edit', $student) }}"
                                           class="px-3 py-1 text-xs font-semibold rounded transition"
                                           style="background:rgba(251,191,36,0.15);color:#fbbf24;">Edit</a>
                                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST"
                                              onsubmit="return confirm('Delete this student?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-3 py-1 text-xs font-semibold rounded transition"
                                                    style="background:rgba(248,113,113,0.15);color:#f87171;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-sm" style="color:#8b949e;">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
