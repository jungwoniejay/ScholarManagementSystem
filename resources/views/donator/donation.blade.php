    @extends('layouts.app')

    @section('content')
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <div class="px-8 py-10 max-w-7xl mx-auto">

            <h1 class="text-3xl font-bold text-gray-900 mb-6">
                Donators / Donations
            </h1>

            <div class="mb-4">
                <a href="{{ route('donators.create') }}" 
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                + Add Donation
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow border overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Donor Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Amount</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($donations ?? [] as $donation)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $donation->id }}</td>
                                <td class="px-6 py-4">{{ $donation->donor_name }}</td>
                                <td class="px-6 py-4">{{ $donation->email }}</td>
                                <td class="px-6 py-4">${{ number_format($donation->amount, 2) }}</td>
                                <td class="px-6 py-4 space-x-2">
                                    <a href="{{ route('donators.show', $donation->id) }}" 
                                    class="text-blue-600 hover:underline">
                                    View
                                    </a>
                                    <a href="{{ route('donators.edit', $donation->id) }}" 
                                    class="text-yellow-600 hover:underline">
                                    Edit
                                    </a>
                                    <form action="{{ route('donators.destroy', $donation->id) }}" 
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Delete this donation?')" 
                                                class="text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-10 text-center text-gray-400">
                                    No donations found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    @endsection
