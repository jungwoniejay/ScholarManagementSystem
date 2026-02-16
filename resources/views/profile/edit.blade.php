<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
        </x-slot>
        <div class="space-y-6">
            <div class="bg-white rounded-2xl p-6 sm:p-6 shadow-sm border border-slate-200/60">
                <div class="flex items-center justify-between mb-4 sm:mb-6">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span>Profile Information</span>
                    </h3>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
                <div class="flex items-center justify-between mb-4 sm:mb-6">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <span>Update Password</span>
                    </h3>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200/60">
                <div class="flex items-center justify-between mb-4 sm:mb-6">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-rose-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <span>Danger Zone</span>
                    </h3>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
</x-app-layout>
