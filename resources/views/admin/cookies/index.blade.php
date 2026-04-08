<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Cookie Settings</h2>
    </x-slot>
    <div class="max-w-4xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-bold" style="color:#e2e8f0;">Cookie Settings</h1>
            <p class="text-sm" style="color:#8b949e;">Configure cookie consent banner, privacy policy, and terms of service.</p>
        </div>

        @if(session('success'))
            <div class="px-4 py-3 rounded-lg text-sm" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">{{ session('success') }}</div>
        @endif

        @php $is = 'background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;'; $ls = 'color:#8b949e;'; @endphp

        <form method="POST" action="{{ route('admin.cookies.update', 1) }}" class="space-y-6">
            @csrf @method('PUT')

            {{-- Banner Settings --}}
            <div class="rounded-2xl p-6 space-y-5" style="background:#0F2044;border:1px solid #1E3A8A;">
                <h2 class="text-sm font-bold uppercase tracking-wide" style="color:#FFD700;">Cookie Banner</h2>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="enabled" value="1" {{ old('enabled', $settings->enabled ?? true) ? 'checked' : '' }} style="accent-color:#FFD700;">
                    <span class="text-sm font-semibold" style="{{ $ls }}">Enable Cookie Banner</span>
                </label>

                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Banner Title</label>
                    <input type="text" name="banner_title" value="{{ old('banner_title', $settings->banner_title ?? 'We use cookies') }}" required
                           class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Banner Message</label>
                    <textarea name="banner_message" rows="3" class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">{{ old('banner_message', $settings->banner_message ?? '') }}</textarea>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Accept Button Label</label>
                        <input type="text" name="accept_label" value="{{ old('accept_label', $settings->accept_label ?? 'Accept All') }}" required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Decline Button Label</label>
                        <input type="text" name="decline_label" value="{{ old('decline_label', $settings->decline_label ?? 'Reject Non-Essential') }}" required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Cookie Expiry (days)</label>
                        <input type="number" name="expiry_days" value="{{ old('expiry_days', $settings->expiry_days ?? 365) }}" min="1" max="3650"
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="flex items-center gap-2 cursor-pointer p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <input type="checkbox" name="show_on_landing" value="1" {{ old('show_on_landing', $settings->show_on_landing ?? true) ? 'checked' : '' }} style="accent-color:#FFD700;">
                        <span class="text-sm" style="{{ $ls }}">Show on Landing Page</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <input type="checkbox" name="show_on_student_dashboard" value="1" {{ old('show_on_student_dashboard', $settings->show_on_student_dashboard ?? false) ? 'checked' : '' }} style="accent-color:#FFD700;">
                        <span class="text-sm" style="{{ $ls }}">Show on Student Dashboard</span>
                    </label>
                </div>
            </div>

            {{-- Privacy & Terms --}}
            <div class="rounded-2xl p-6 space-y-5" style="background:#0F2044;border:1px solid #1E3A8A;">
                <h2 class="text-sm font-bold uppercase tracking-wide" style="color:#FFD700;">Privacy Policy & Terms of Service</h2>

                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Privacy Policy URL</label>
                    <input type="text" name="privacy_url" value="{{ old('privacy_url', $settings->privacy_url ?? '/privacy-policy') }}"
                           class="w-full px-3 py-2.5 text-sm rounded-xl font-mono focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Privacy Policy Content</label>
                    <textarea name="privacy_content" rows="6" class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">{{ old('privacy_content', $settings->privacy_content ?? '') }}</textarea>
                </div>
                <div style="border-top:1px solid #1E3A8A;padding-top:1.25rem;">
                    <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Terms and Conditions URL</label>
                    <input type="text" name="terms_url" value="{{ old('terms_url', $settings->terms_url ?? '/terms-and-conditions') }}"
                           class="w-full px-3 py-2.5 text-sm rounded-xl font-mono focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Terms and Conditions Content</label>
                    <textarea name="terms_content" rows="6" class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">{{ old('terms_content', $settings->terms_content ?? '') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-8 py-3 text-sm font-semibold rounded-xl"
                        style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Save All Settings</button>
            </div>
        </form>
    </div>
</x-app-layout>
