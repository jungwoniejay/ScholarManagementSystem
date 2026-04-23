<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Document Verification</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <div>
            <h1 class="text-2xl font-bold" style="color:#e2e8f0;">Pending Documents</h1>
            <p class="text-sm" style="color:#8b949e;">Review and verify submitted student documents</p>
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
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Document</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Uploaded</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">File</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documents as $document)
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <td class="px-6 py-4 text-sm font-semibold" style="color:#e2e8f0;">
                                {{ $document->application->student->user->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $document->name }}</td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $document->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($document->file_path)
                                    <a href="{{ asset(Storage::url($document->file_path)) }}" target="_blank"
                                       class="text-xs font-semibold" style="color:#60a5fa;">View File</a>
                                @else
                                    <span style="color:#8b949e;">No file</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.documents.approve', $document->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                                class="px-3 py-1 text-xs font-semibold rounded transition"
                                                style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.documents.reject', $document->id) }}" method="POST" class="flex items-center gap-1">
                                        @csrf @method('PATCH')
                                        <input type="text" name="remarks" placeholder="Reason (optional)"
                                               class="text-xs px-2 py-1 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500"
                                               style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;width:140px;">
                                        <button type="submit"
                                                class="px-3 py-1 text-xs font-semibold rounded transition"
                                                style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm" style="color:#8b949e;">No pending documents.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">{{ $documents->links() }}</div>
        </div>
    </div>
</x-app-layout>
