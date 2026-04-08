<x-app-layout>
    <div class="px-8 py-10 max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">
            Rejected Applications
        </h1>

        <div class="bg-white rounded-2xl shadow border overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Application ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Student</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Scholarship</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Rejected Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Reason</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($applications ?? [] as $application)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $application->id }}</td>
                            <td class="px-6 py-4">{{ $application->student->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $application->scholarship->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $application->reviewed_at ? $application->reviewed_at->format('M d, Y') : 'N/A' }}</td>
                            <td class="px-6 py-4 max-w-xs truncate" title="{{ $application->remarks ?? 'No reason provided' }}">
                                {{ $application->remarks ?? 'No reason provided' }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.applications.show', $application->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-400">
                                No rejected applications.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $applications->links() }}
        </div>
    </div>
</x-app-layout>