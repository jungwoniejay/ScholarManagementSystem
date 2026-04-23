<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#FFD700;">My Profile</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-5 py-6 px-4 sm:px-6">

        {{-- Profile Information --}}
        <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
            <div class="flex items-center gap-3 mb-5">
                <span style="width:28px;height:28px;background:linear-gradient(135deg,#FFD700,#B8860B);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="14" height="14" fill="none" stroke="#0A1628" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </span>
                <h3 class="font-bold text-white">Profile Information</h3>
            </div>
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Update Password --}}
        <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid rgba(255,215,0,0.1);">
            <div class="flex items-center gap-3 mb-5">
                <span style="width:28px;height:28px;background:rgba(96,165,250,0.15);border:1px solid rgba(96,165,250,0.3);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="14" height="14" fill="none" stroke="#60A5FA" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                <h3 class="font-bold text-white">Update Password</h3>
            </div>
            @include('profile.partials.update-password-form')
        </div>

        {{-- Danger Zone --}}
        <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid rgba(248,113,113,0.2);">
            <div class="flex items-center gap-3 mb-5">
                <span style="width:28px;height:28px;background:rgba(248,113,113,0.15);border:1px solid rgba(248,113,113,0.3);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="14" height="14" fill="none" stroke="#F87171" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </span>
                <h3 class="font-bold" style="color:#F87171;">Danger Zone</h3>
            </div>
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</x-app-layout>
