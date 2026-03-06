<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donator Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">{{ $donator->organization_name }}</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.donators.edit', $donator) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <a href="{{ route('admin.donators.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Donator Information -->
                        <div>
                            <h4 class="text-md font-semibold mb-4">Donator Information</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Organization Name</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $donator->organization_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Contact Person</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $donator->contact_person }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $donator->email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $donator->contact_number }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Account Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $donator->account_status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($donator->account_status) }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Created At</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $donator->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Fund Information -->
                        <div>
                            <h4 class="text-md font-semibold mb-4">Fund Information</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Total Fund</label>
                                    <p class="mt-1 text-sm text-gray-900">${{ number_format($donator->total_fund, 2) }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Available Fund</label>
                                    <p class="mt-1 text-sm text-gray-900">${{ number_format($donator->available_fund, 2) }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Used Fund</label>
                                    <p class="mt-1 text-sm text-gray-900">${{ number_format($donator->total_fund - $donator->available_fund, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assigned Scholarships -->
                    <div class="mt-8">
                        <h4 class="text-md font-semibold mb-4">Assigned Scholarships</h4>
                        @if($donator->scholarships->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($donator->scholarships as $scholarship)
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h5 class="font-medium text-gray-900">{{ $scholarship->name }}</h5>
                                        <p class="text-sm text-gray-600 mt-1">{{ $scholarship->description }}</p>
                                        <p class="text-sm text-gray-500 mt-2">Amount: ${{ number_format($scholarship->amount, 2) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No scholarships assigned.</p>
                        @endif
                    </div>

                    <!-- Donations History -->
                    <div class="mt-8">
                        <h4 class="text-md font-semibold mb-4">Donation History</h4>
                        @php
                            $donations = $donator->donations()->orderBy('donation_date', 'desc')->get();
                        @endphp
                        @if($donations->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($donations as $donation)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $donation->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-green-600">₱{{ number_format($donation->amount, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($donation->method)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            {{ $donation->method }}
                                                        </span>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $donation->donation_date->format('M d, Y') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                                    {{ $donation->message ?? '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                <p class="text-sm text-blue-800">
                                    <strong>Total Donations:</strong> {{ $donations->count() }} | 
                                    <strong>Total Amount:</strong> ₱{{ number_format($donations->sum('amount'), 2) }}
                                </p>
                            </div>
                        @else
                            <p class="text-gray-500">No donations recorded yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
