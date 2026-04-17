<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Landing Page Editor</h2>
            <a href="/" target="_blank" class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Preview Landing Page
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg flex items-center gap-2">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.landing.update') }}">
                @csrf
                @method('PUT')

                {{-- Hero Section --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold">1</span>
                        Hero Section
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Badge Text</label>
                            <input type="text" name="hero_badge" value="{{ old('hero_badge', $page->hero_badge) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            @error('hero_badge') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Title</label>
                            <input type="text" name="hero_title" value="{{ old('hero_title', $page->hero_title) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            @error('hero_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Subtitle</label>
                            <textarea name="hero_subtitle" rows="3"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('hero_subtitle', $page->hero_subtitle) }}</textarea>
                            @error('hero_subtitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold">2</span>
                        Stats Bar
                    </h3>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach([1,2,3] as $i)
                        <div class="space-y-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Stat {{ $i }} Number</label>
                                <input type="text" name="stat{{ $i }}_number" value="{{ old("stat{$i}_number", $page->{"stat{$i}_number"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Stat {{ $i }} Label</label>
                                <input type="text" name="stat{{ $i }}_label" value="{{ old("stat{$i}_label", $page->{"stat{$i}_label"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Features --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold">3</span>
                        Features Section
                    </h3>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Section Title</label>
                            <input type="text" name="card_title" value="{{ old('card_title', $page->card_title) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Section Subtitle</label>
                            <input type="text" name="card_subtitle" value="{{ old('card_subtitle', $page->card_subtitle) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                    </div>
                    @foreach([1,2,3] as $i)
                    <div class="border rounded-lg p-4 mb-3 bg-gray-50">
                        <p class="text-sm font-semibold text-gray-500 mb-3">Feature {{ $i }}</p>
                        <div class="grid grid-cols-4 gap-3">
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Icon (emoji)</label>
                                <input type="text" name="feature{{ $i }}_icon" value="{{ old("feature{$i}_icon", $page->{"feature{$i}_icon"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Title</label>
                                <input type="text" name="feature{{ $i }}_title" value="{{ old("feature{$i}_title", $page->{"feature{$i}_title"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs text-gray-500 mb-1">Description</label>
                                <input type="text" name="feature{{ $i }}_desc" value="{{ old("feature{$i}_desc", $page->{"feature{$i}_desc"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- How It Works --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold">4</span>
                        How It Works (3 Steps)
                    </h3>
                    @foreach([1,2,3] as $i)
                    <div class="border rounded-lg p-4 mb-3 bg-gray-50">
                        <p class="text-sm font-semibold text-gray-500 mb-3">Step {{ $i }}</p>
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Title</label>
                                <input type="text" name="step{{ $i }}_title" value="{{ old("step{$i}_title", $page->{"step{$i}_title"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs text-gray-500 mb-1">Description</label>
                                <input type="text" name="step{{ $i }}_desc" value="{{ old("step{$i}_desc", $page->{"step{$i}_desc"}) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Testimonials --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold">5</span>
                        Testimonials
                    </h3>
                    @foreach([1,2,3] as $i)
                    <div class="border rounded-lg p-4 mb-3 bg-gray-50">
                        <p class="text-sm font-semibold text-gray-500 mb-3">Testimonial {{ $i }}</p>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Quote Text</label>
                                <textarea name="testimonial{{ $i }}_text" rows="2"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old("testimonial{$i}_text", $page->{"testimonial{$i}_text"}) }}</textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Name</label>
                                    <input type="text" name="testimonial{{ $i }}_name" value="{{ old("testimonial{$i}_name", $page->{"testimonial{$i}_name"}) }}"
                                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Role / School</label>
                                    <input type="text" name="testimonial{{ $i }}_role" value="{{ old("testimonial{$i}_role", $page->{"testimonial{$i}_role"}) }}"
                                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- CTA Band --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold">6</span>
                        Call-to-Action Band
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Title</label>
                            <input type="text" name="cta_title" value="{{ old('cta_title', $page->cta_title) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                            <textarea name="cta_desc" rows="2"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('cta_desc', $page->cta_desc) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded text-xs flex items-center justify-center font-bold">7</span>
                        Footer
                    </h3>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Site Name</label>
                            <input type="text" name="footer_site_name" value="{{ old('footer_site_name', $page->footer_site_name) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Copyright Text</label>
                            <input type="text" name="footer_copyright" value="{{ old('footer_copyright', $page->footer_copyright) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Tagline</label>
                            <input type="text" name="footer_tagline" value="{{ old('footer_tagline', $page->footer_tagline) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                    </div>
                    <p class="text-xs font-semibold text-gray-500 mb-3">Social Links <span class="font-normal text-gray-400">(use # to hide)</span></p>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['facebook','twitter','linkedin','instagram'] as $social)
                        <div>
                            <label class="block text-xs text-gray-500 mb-1 capitalize">{{ $social }} URL</label>
                            <input type="text" name="footer_{{ $social }}" value="{{ old("footer_{$social}", $page->{"footer_{$social}"}) }}"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-3 pb-6">
                    <a href="/" target="_blank" class="px-5 py-2 rounded-lg border text-gray-600 hover:bg-gray-50 text-sm">Preview</a>
                    <button type="submit" class="px-5 py-2 rounded-lg text-white font-semibold text-sm"
                        style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                        Save Changes
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
