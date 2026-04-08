@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center gap-4 mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Cookie Settings</h1>
        <p class="text-slate-500">Configure cookie consent banner, privacy policy, and terms of service.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.cookies.update', 1) }}" class="space-y-8">
        @csrf
        @method('PUT')
        
        {{-- Cookie Banner Settings Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Cookie Banner
            </h2>
            
            <div class="space-y-6">
                {{-- Enabled --}}
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="enabled" value="1" {{ old('enabled', $settings->enabled ?? true) ? 'checked' : '' }}
                               class="w-5 h-5 text-emerald-600 bg-slate-100 border-slate-300 rounded focus:ring-emerald-500">
                        <span class="ml-3 text-sm font-semibold text-slate-700">Enable Cookie Banner</span>
                    </label>
                    <p class="text-xs text-slate-500 ml-8">Show cookie consent banner to visitors</p>
                </div>

                {{-- Banner Content --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Banner Title</label>
                    <input type="text" name="banner_title" value="{{ old('banner_title', $settings->banner_title ?? 'We use cookies') }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('banner_title') border-red-500 ring-red-200 @enderror"
                           required>
                    @error('banner_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Banner Message</label>
                    <textarea name="banner_message" rows="3"
                              class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-vertical @error('banner_message') border-red-500 ring-red-200 @enderror"
                              placeholder="Explain what cookies are used for...">{{ old('banner_message', $settings->banner_message ?? 'We use cookies to improve your experience on our site.') }}</textarea>
                    @error('banner_message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Button Labels --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Accept Button Label</label>
                        <input type="text" name="accept_label" value="{{ old('accept_label', $settings->accept_label ?? 'Accept All') }}"
                               class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('accept_label') border-red-500 ring-red-200 @enderror"
                               maxlength="20" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Decline Button Label</label>
                        <input type="text" name="decline_label" value="{{ old('decline_label', $settings->decline_label ?? 'Reject Non-Essential') }}"
                               class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('decline_label') border-red-500 ring-red-200 @enderror"
                               maxlength="30" required>
                    </div>
                </div>

                {{-- Additional Options --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Cookie Expiry (days)</label>
                        <input type="number" name="expiry_days" value="{{ old('expiry_days', $settings->expiry_days ?? 365) }}"
                               min="1" max="3650" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('expiry_days') border-red-500 ring-red-200 @enderror">
                        @error('expiry_days')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Visibility Locations --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="show_on_landing" value="1" {{ old('show_on_landing', $settings->show_on_landing ?? true) ? 'checked' : '' }}
                                   class="w-5 h-5 text-blue-600 bg-slate-100 border-slate-300 rounded focus:ring-blue-500">
                            <span class="ml-3 text-sm font-semibold text-slate-700">Show Banner on Landing Page</span>
                        </label>
                    </div>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="show_on_student_dashboard" value="1" {{ old('show_on_student_dashboard', $settings->show_on_student_dashboard ?? false) ? 'checked' : '' }}
                                   class="w-5 h-5 text-emerald-600 bg-slate-100 border-slate-300 rounded focus:ring-emerald-500">
                            <span class="ml-3 text-sm font-semibold text-slate-700">Show on Student Dashboard</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Privacy Policy & Terms Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Privacy Policy & Terms of Service
            </h2>
            
            <div class="space-y-6">
                {{-- Privacy Policy URL --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Privacy Policy URL</label>
                    <input type="text" name="privacy_url" value="{{ old('privacy_url', $settings->privacy_url ?? '/privacy-policy') }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-mono text-sm"
                           placeholder="/privacy-policy">
                    <p class="mt-1 text-xs text-slate-500">The URL path where your privacy policy page is accessible (e.g., /privacy-policy)</p>
                </div>

                {{-- Privacy Policy Content --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Privacy Policy Content</label>
                    <textarea name="privacy_content" rows="8"
                              class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-vertical font-sans"
                              placeholder="Enter your privacy policy content here...">{{ old('privacy_content', $settings->privacy_content ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-slate-500">This content will be displayed on the privacy policy page.</p>
                </div>

                <hr class="border-slate-200">

                {{-- Terms URL --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Terms and Conditions URL</label>
                    <input type="text" name="terms_url" value="{{ old('terms_url', $settings->terms_url ?? '/terms-and-conditions') }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-mono text-sm"
                           placeholder="/terms-and-conditions">
                    <p class="mt-1 text-xs text-slate-500">The URL path where your terms and conditions page is accessible (e.g., /terms-and-conditions)</p>
                </div>

                {{-- Terms Content --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Terms and Conditions Content</label>
                    <textarea name="terms_content" rows="8"
                              class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-vertical font-sans"
                              placeholder="Enter your terms and conditions content here...">{{ old('terms_content', $settings->terms_content ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-slate-500">This content will be displayed on the terms and conditions page.</p>
                </div>
            </div>
        </div>

        {{-- Save Button --}}
        <div class="flex justify-end">
            <button type="submit" 
                    class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-700 text-white py-4 px-10 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 text-lg flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save All Settings
            </button>
        </div>
    </form>
</div>
@endsection