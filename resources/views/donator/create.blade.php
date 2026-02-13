<x-app-layout>
    <div class="px-8 py-10 max-w-3xl mx-auto">

        <h1 class="text-3xl font-bold text-gray-900 mb-6">
            Add New Donation
        </h1>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('donators.store') }}" method="POST" class="bg-white shadow rounded-2xl p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Donor Name <span class="text-red-500">*</span></label>
                <input type="text" name="donor_name" 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                       value="{{ old('donor_name') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                       value="{{ old('email') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Amount <span class="text-red-500">*</span></label>
                <input type="number" step="0.01" name="amount" 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                       value="{{ old('amount') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Method</label>
                <select name="method" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Method</option>
                    <option value="Cash" {{ old('method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="GCash" {{ old('method') == 'GCash' ? 'selected' : '' }}>GCash</option>
                    <option value="Bank Transfer" {{ old('method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Donation Date <span class="text-red-500">*</span></label>
                <input type="date" name="donation_date" 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                       value="{{ old('donation_date') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea name="message" rows="3" 
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('message') }}</textarea>
            </div>

            <div class="pt-4">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                    Save Donation
                </button>

                <a href="{{ route('donators') }}" 
                   class="ml-4 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                   Cancel
                </a>
            </div>

        </form>

    </div>
</x-app-layout>
