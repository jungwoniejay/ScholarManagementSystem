<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Landing Page Settings
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.landing.update') }}">
                @csrf
                @method('PUT')

                {{-- Hero Section --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Hero Section</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Badge Text</label>
                            <input type="text" name="hero_badge" value="{{ old('hero_badge', $page->hero_badge) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                            @error('hero_badge') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Title</label>
                            <input type="text" name="hero_title" value="{{ old('hero_title', $page->hero_title) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                            @error('hero_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Subtitle</label>
                            <textarea name="hero_subtitle" rows="3"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">{{ old('hero_subtitle', $page->hero_subtitle) }}</textarea>
                            @error('hero_subtitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Stats</h3>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach([1,2,3] as $i)
                        <div class="space-y-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Stat {{ $i }} Number</label>
                                <input type="text" name="stat{{ $i }}_number" value="{{ old("stat{$i}_number", $page->{"stat{$i}_number"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Stat {{ $i }} Label</label>
                                <input type="text" name="stat{{ $i }}_label" value="{{ old("stat{$i}_label", $page->{"stat{$i}_label"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Features Card --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Features Card</h3>
                    <div class="space-y-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Card Title</label>
                            <input type="text" name="card_title" value="{{ old('card_title', $page->card_title) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Card Subtitle</label>
                            <input type="text" name="card_subtitle" value="{{ old('card_subtitle', $page->card_subtitle) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                    </div>

                    @foreach([1,2,3] as $i)
                    <div class="border rounded-lg p-4 mb-3">
                        <p class="text-sm font-semibold text-gray-500 mb-3">Feature {{ $i }}</p>
                        <div class="grid grid-cols-4 gap-3">
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Icon (emoji)</label>
                                <input type="text" name="feature{{ $i }}_icon" value="{{ old("feature{$i}_icon", $page->{"feature{$i}_icon"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Title</label>
                                <input type="text" name="feature{{ $i }}_title" value="{{ old("feature{$i}_title", $page->{"feature{$i}_title"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs text-gray-500 mb-1">Description</label>
                                <input type="text" name="feature{{ $i }}_desc" value="{{ old("feature{$i}_desc", $page->{"feature{$i}_desc"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- CTA Card --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Call-to-Action Card</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Title</label>
                            <input type="text" name="cta_title" value="{{ old('cta_title', $page->cta_title) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                            <textarea name="cta_desc" rows="2"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">{{ old('cta_desc', $page->cta_desc) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Footer</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Site Name</label>
                            <input type="text" name="footer_site_name" value="{{ old('footer_site_name', $page->footer_site_name) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Copyright Text</label>
                            <input type="text" name="footer_copyright" value="{{ old('footer_copyright', $page->footer_copyright) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Tagline</label>
                            <input type="text" name="footer_tagline" value="{{ old('footer_tagline', $page->footer_tagline) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                    </div>
                    <p class="text-xs font-semibold text-gray-500 mt-4 mb-3">Social Links (leave as # to hide)</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Facebook URL</label>
                            <input type="text" name="footer_facebook" value="{{ old('footer_facebook', $page->footer_facebook) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Twitter URL</label>
                            <input type="text" name="footer_twitter" value="{{ old('footer_twitter', $page->footer_twitter) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">LinkedIn URL</label>
                            <input type="text" name="footer_linkedin" value="{{ old('footer_linkedin', $page->footer_linkedin) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Instagram URL</label>
                            <input type="text" name="footer_instagram" value="{{ old('footer_instagram', $page->footer_instagram) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 rounded-lg border text-gray-600 hover:bg-gray-50 text-sm">Cancel</a>
                    <button type="submit" class="px-5 py-2 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700 text-sm">
                        Save Changes
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
