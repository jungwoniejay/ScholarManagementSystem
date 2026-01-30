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

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Scholarships</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Manage available scholarships and their application status
                </p>
            </div>

            <a href="{{ route('admin.scholarships.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition shadow-sm font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Add Scholarship
            </a>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl shadow-sm">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto bg-white rounded-3xl shadow-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Name
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Amount
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Deadline
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Status
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($scholarships as $scholarship)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $scholarship->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-800">
                                {{ $scholarship->formattedAmount }}
                            </td>

                            <td class="px-6 py-4 text-gray-800">
                                {{ $scholarship->application_deadline->format('M d, Y') }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $scholarship->status === 'active'
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($scholarship->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.scholarships.show', $scholarship->id) }}"
                                       class="px-4 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition text-sm font-medium">
                                        View
                                    </a>

                                    <a href="{{ route('admin.scholarships.edit', $scholarship->id) }}"
                                       class="px-4 py-1.5 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition text-sm font-medium">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.scholarships.destroy', $scholarship->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this scholarship?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition text-sm font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-14 text-gray-400">
                                No scholarships found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $scholarships->links() }}
        </div>

    </div>
</x-app-layout>
