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
            Screened Applications
        </h1>

        <div class="bg-white rounded-2xl shadow border overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Application ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Student ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Verification Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Review Date</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($applications ?? [] as $application)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $application->id }}</td>
                            <td class="px-6 py-4">{{ $application->student_id }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                    Screened
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $application->review_date ?? '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-gray-400">
                                No screened applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
