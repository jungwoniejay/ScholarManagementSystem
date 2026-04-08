<x-app-layout>
    <div class="px-8 py-10 max-w-4xl mx-auto">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Donation Details</h1>

        <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-200 space-y-6">
            <!-- Donation Info -->
            <div class="space-y-3">
                <p><span class="font-semibold text-gray-700">Donation ID:</span> <span class="text-gray-900">#{{ $donation->id }}</span></p>
                <p><span class="font-semibold text-gray-700">Amount:</span> <span class="text-xl font-bold text-green-600">₱{{ number_format($donation->amount, 2) }}</span></p>
                <p><span class="font-semibold text-gray-700">Donation Date:</span> <span class="text-gray-900">{{ $donation->donation_date->format('M d, Y') }}</span></p>
            </div>

            <hr class="border-gray-200">

            <!-- Donor Information -->
            <div class="space-y-3">
                <h3 class="font-bold text-lg text-gray-800">Donor Information</h3>
                <p><span class="font-semibold text-gray-700">Donor Name:</span> <span class="text-gray-900">{{ $donation->donor_name ?? 'N/A' }}</span></p>
                <p><span class="font-semibold text-gray-700">Email:</span> <span class="text-gray-900">{{ $donation->email ?? 'N/A' }}</span></p>
                <p><span class="font-semibold text-gray-700">Donator Organization:</span>
                    @if($donation->donator)
                        <span class="text-blue-600 font-medium">{{ $donation->donator->organization_name }}</span>
                    @else
                        <span class="text-gray-400">Guest Donor</span>
                    @endif
                </p>
            </div>

            <hr class="border-gray-200">

            <!-- Donation Details & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="font-semibold text-gray-700">Payment Method:</p>
                    @if($donation->method)
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800 mt-1">
                            {{ $donation->method }}
                        </span>
                    @else
                        <span class="text-gray-400">N/A</span>
                    @endif
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Approval Status:</p>
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'approved' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                        ];
                        $statusClass = $statusColors[$donation->approval_status] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }} mt-1">
                        {{ ucfirst($donation->approval_status ?? 'Pending') }}
                    </span>
                </div>
                @if($donation->approved_at)
                <div>
                    <p class="font-semibold text-gray-700">Approved At:</p>
                    <p class="text-gray-900">{{ $donation->approved_at->format('M d, Y h:i A') }}</p>
                </div>
                @endif
                @if($donation->scholarship_id)
                <div>
                    <p class="font-semibold text-gray-700">Linked Scholarship:</p>
                    <p class="text-gray-900">ID: {{ $donation->scholarship_id }}</p>
                </div>
                @endif
            </div>

            <!-- Message -->
            @if($donation->message)
            <hr class="border-gray-200">
            <div>
                <p class="font-semibold text-gray-700 mb-2">Message:</p>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700 italic">{{ $donation->message }}</p>
                </div>
            </div>
            @endif

            <!-- Admin Remarks -->
            @if($donation->admin_remarks)
            <div>
                <p class="font-semibold text-gray-700 mb-2">Admin Remarks:</p>
                <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                    <p class="text-gray-700">{{ $donation->admin_remarks }}</p>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('admin.donations.index') }}"
                   class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition font-medium shadow-sm">Back to List</a>
            </div>
        </div>
    </div>
</x-app-layout>