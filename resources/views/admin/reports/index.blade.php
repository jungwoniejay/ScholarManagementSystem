<x-app-layout>
    <div class="px-8 py-10 max-w-7xl mx-auto">

        <!-- Back to Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center gap-2 mb-6 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Dashboard
        </a>

        <h1 class="text-3xl font-bold text-gray-900 mb-6">
            System Logs & Reports
        </h1>

        <div class="bg-white rounded-2xl shadow border overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Log Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Related ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">User ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Date</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($logs as $log)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $log->id }}</td>
                            <td class="px-6 py-4">{{ $log->log_type }}</td>
                            <td class="px-6 py-4">{{ $log->related_id ?? '—' }}</td>
                            <td class="px-6 py-4">{{ $log->user_id ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $log->description ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $log->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-400">
                                No system logs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $logs->links() }}
        </div>

    </div>
</x-app-layout>
