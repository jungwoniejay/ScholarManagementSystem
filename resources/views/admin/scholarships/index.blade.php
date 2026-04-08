<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Scholarships</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold" style="color:#e2e8f0;">Scholarships</h1>
                <p class="text-sm" style="color:#8b949e;">Manage available scholarships and their application status</p>
            </div>
            <a href="{{ route('admin.scholarships.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition"
               style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                + Add Scholarship
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
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Deadline</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Approval</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($scholarships as $scholarship)
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <td class="px-6 py-4 text-sm font-semibold" style="color:#e2e8f0;">{{ $scholarship->name }}</td>
                            <td class="px-6 py-4 text-sm font-semibold" style="color:#4ade80;">{{ $scholarship->formattedAmount }}</td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $scholarship->application_deadline->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full"
                                    style="{{ $scholarship->status === 'active' ? 'background:rgba(34,197,94,0.15);color:#4ade80;' : 'background:rgba(248,113,113,0.15);color:#f87171;' }}">
                                    {{ ucfirst($scholarship->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $approvalStyle = match($scholarship->approval_status ?? 'pending') {
                                        'approved' => 'background:rgba(34,197,94,0.15);color:#4ade80;',
                                        'rejected' => 'background:rgba(248,113,113,0.15);color:#f87171;',
                                        default    => 'background:rgba(251,191,36,0.15);color:#fbbf24;',
                                    };
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" style="{{ $approvalStyle }}">
                                    {{ ucfirst($scholarship->approval_status ?? 'pending') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.scholarships.show', $scholarship->id) }}"
                                       class="px-3 py-1 text-xs font-semibold rounded"
                                       style="background:rgba(96,165,250,0.15);color:#60a5fa;">View</a>
                                    <a href="{{ route('admin.scholarships.edit', $scholarship->id) }}"
                                       class="px-3 py-1 text-xs font-semibold rounded"
                                       style="background:rgba(251,191,36,0.15);color:#fbbf24;">Edit</a>
                                    @if(($scholarship->approval_status ?? 'pending') !== 'approved')
                                        <form action="{{ route('admin.scholarships.approve', $scholarship->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-3 py-1 text-xs font-semibold rounded"
                                                    style="background:rgba(34,197,94,0.15);color:#4ade80;">Approve</button>
                                        </form>
                                    @endif
                                    @if(($scholarship->approval_status ?? 'pending') !== 'rejected')
                                        <form action="{{ route('admin.scholarships.reject', $scholarship->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-3 py-1 text-xs font-semibold rounded"
                                                    style="background:rgba(248,113,113,0.15);color:#f87171;">Reject</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.scholarships.destroy', $scholarship->id) }}" method="POST"
                                          onsubmit="return confirm('Delete this scholarship?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs font-semibold rounded"
                                                style="background:rgba(248,113,113,0.15);color:#f87171;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm" style="color:#8b949e;">No scholarships found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">
                {{ $scholarships->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
