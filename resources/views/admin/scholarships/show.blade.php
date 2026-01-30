<x-app-layout>
    <div class="px-8 py-10 max-w-4xl mx-auto">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Scholarship Details</h1>

        <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-200 space-y-6">
            <!-- Scholarship Info -->
            <div class="space-y-3">
                <p><span class="font-semibold text-gray-700">Name:</span> <span class="text-gray-900">{{ $scholarship->name }}</span></p>
                <p><span class="font-semibold text-gray-700">Amount:</span> <span class="text-gray-900">{{ $scholarship->formattedAmount }}</span></p>
                <p><span class="font-semibold text-gray-700">Eligibility:</span> <span class="text-gray-900">{{ $scholarship->eligibility_criteria ?? 'N/A' }}</span></p>
                <p><span class="font-semibold text-gray-700">Application Deadline:</span> <span class="text-gray-900">{{ $scholarship->application_deadline->format('M d, Y') }}</span></p>
            </div>

            <hr class="border-gray-200">

            <!-- Scholarship Status & Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="font-semibold text-gray-700">Status:</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        {{ $scholarship->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($scholarship->status) }}
                    </span>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Max Recipients:</p>
                    <p class="text-gray-900">{{ $scholarship->max_recipients }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Academic Year:</p>
                    <p class="text-gray-900">{{ $scholarship->academic_year }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('admin.scholarships.index') }}"
                   class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition font-medium shadow-sm">Back</a>
                <a href="{{ route('admin.scholarships.edit', $scholarship->id) }}"
                   class="px-6 py-3 bg-yellow-100 text-yellow-800 rounded-xl hover:bg-yellow-200 transition font-medium shadow-sm">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
