<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Donator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.donators.update', $donator) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Organization Name -->
                            <div>
                                <x-input-label for="organization_name" :value="__('Organization Name')" />
                                <x-text-input id="organization_name" class="block mt-1 w-full" type="text" name="organization_name" :value="old('organization_name', $donator->organization_name)" required autofocus autocomplete="organization_name" />
                                <x-input-error :messages="$errors->get('organization_name')" class="mt-2" />
                            </div>

                            <!-- Contact Person -->
                            <div>
                                <x-input-label for="contact_person" :value="__('Contact Person')" />
                                <x-text-input id="contact_person" class="block mt-1 w-full" type="text" name="contact_person" :value="old('contact_person', $donator->contact_person)" required autocomplete="contact_person" />
                                <x-input-error :messages="$errors->get('contact_person')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $donator->email)" required autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Contact Number -->
                            <div>
                                <x-input-label for="contact_number" :value="__('Contact Number')" />
                                <x-text-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" :value="old('contact_number', $donator->contact_number)" required autocomplete="contact_number" />
                                <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                            </div>

                            <!-- Total Fund -->
                            <div>
                                <x-input-label for="total_fund" :value="__('Total Fund')" />
                                <x-text-input id="total_fund" class="block mt-1 w-full" type="number" step="0.01" name="total_fund" :value="old('total_fund', $donator->total_fund)" required />
                                <x-input-error :messages="$errors->get('total_fund')" class="mt-2" />
                            </div>

                            <!-- Available Fund -->
                            <div>
                                <x-input-label for="available_fund" :value="__('Available Fund')" />
                                <x-text-input id="available_fund" class="block mt-1 w-full" type="number" step="0.01" name="available_fund" :value="old('available_fund', $donator->available_fund)" required />
                                <x-input-error :messages="$errors->get('available_fund')" class="mt-2" />
                            </div>

                            <!-- Account Status -->
                            <div>
                                <x-input-label for="account_status" :value="__('Account Status')" />
                                <select id="account_status" name="account_status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="active" {{ old('account_status', $donator->account_status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('account_status', $donator->account_status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('account_status')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Scholarships -->
                        <div class="mt-6">
                            <x-input-label :value="__('Assign to Scholarships')" />
                            <div class="mt-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($scholarships as $scholarship)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="scholarship_ids[]" value="{{ $scholarship->id }}" {{ in_array($scholarship->id, old('scholarship_ids', $donator->scholarships->pluck('id')->toArray())) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-600">{{ $scholarship->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('scholarship_ids')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.donators.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">Cancel</a>
                            <x-primary-button>
                                {{ __('Update Donator') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
