<x-app-layout>
    <div class="px-8 py-10 max-w-3xl mx-auto">

        <h1 class="text-3xl font-bold text-gray-900 mb-6">
            Donation Details
        </h1>

        <div class="bg-white shadow rounded-2xl p-6 space-y-4">

            <div class="flex justify-between">
                <span class="font-semibold text-gray-700">Donation ID:</span>
                <span class="text-gray-900">{{ $donation->id }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold text-gray-700">Donor Name:</span>
                <span class="text-gray-900">{{ $donation->donor_name }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold text-gray-700">Email:</span>
                <span class="text-gray-900">{{ $donation->email ?? '-' }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold text-gray-700">Amount:</span>
                <span class="text-gray-900">${{ number_format($donation->amount, 2) }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold text-gray-700">Method:</span>
                <span class="text-gray-900">{{ $donation->method ?? '-' }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold text-gray-700">Donation Date:</span>
                <span class="text-gray-900">{{ $donation->donation_date }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold text-gray-700">Message:</span>
                <span class="text-gray-900">{{ $donation->message ?? '-' }}</span>
            </div>

            <div class="pt-4 text-right">
                <a href="{{ route('donators') }}" 
                   class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                   Back to Donations
                </a>
            </div>

        </div>

    </div>
</x-app-layout>
