<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl leading-tight" style="color:#FFD700;">Landing Page Editor</h2>
            <a href="/" target="_blank" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm font-medium transition"
               style="color:rgba(255,215,0,0.7);border:1px solid rgba(255,215,0,0.2);"
               onmouseover="this.style.background='rgba(255,215,0,0.08)'"
               onmouseout="this.style.background='transparent'">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Preview
            </a>
        </div>
    </x-slot>

    <style>
        .ed-card {
            background: #0F2044;
            border: 1px solid rgba(255,215,0,0.1);
            border-radius: 14px;
            padding: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .ed-card-title {
            display: flex; align-items: center; gap: 0.6rem;
            font-size: 0.9rem; font-weight: 700; color: #fff;
            margin-bottom: 1.25rem;
        }
        .ed-num {
            width: 22px; height: 22px; border-radius: 6px; flex-shrink: 0;
            background: linear-gradient(135deg,#FFD700,#B8860B);
            color: #0A1628; font-size: 0.7rem; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
        }
        .ed-label {
            display: block; font-size: 0.75rem; font-weight: 600;
            letter-spacing: 0.05em; text-transform: uppercase;
            color: rgba(255,255,255,0.4); margin-bottom: 0.4rem;
        }
        .ed-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 0.6rem 0.85rem;
            color: #fff;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.2s;
            font-family: inherit;
        }
        .ed-input:focus { border-color: rgba(255,215,0,0.5); }
        .ed-input::placeholder { color: rgba(255,255,255,0.2); }
        .ed-sub {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 0.75rem;
        }
        .ed-sub-title {
            font-size: 0.75rem; font-weight: 700; letter-spacing: 0.08em;
            text-transform: uppercase; color: rgba(255,215,0,0.6);
            margin-bottom: 0.75rem;
        }
        .ed-error { color: #F87171; font-size: 0.75rem; margin-top: 0.25rem; }
        .ed-hint { font-size: 0.75rem; color: rgba(255,255,255,0.3); margin-bottom: 0.75rem; }
    </style>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-5 px-4 py-3 rounded-lg text-sm font-medium flex items-center gap-2"
                     style="background:rgba(34,197,94,0.15);color:#22C55E;border:1px solid rgba(34,197,94,0.3);">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.landing.update') }}">
                @csrf
                @method('PUT')

                {{-- 1. Hero --}}
                <div class="ed-card">
                    <div class="ed-card-title"><span class="ed-num">1</span> Hero Section</div>
                    <div class="space-y-3">
                        <div>
                            <label class="ed-label">Badge Text</label>
                            <input type="text" name="hero_badge" value="{{ old('hero_badge', $page->hero_badge) }}" class="ed-input" placeholder="e.g. Your Path to Excellence">
                            @error('hero_badge')<p class="ed-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="ed-label">Title</label>
                            <input type="text" name="hero_title" value="{{ old('hero_title', $page->hero_title) }}" class="ed-input" placeholder="Main headline">
                            @error('hero_title')<p class="ed-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="ed-label">Subtitle</label>
                            <textarea name="hero_subtitle" rows="3" class="ed-input" placeholder="Supporting description text">{{ old('hero_subtitle', $page->hero_subtitle) }}</textarea>
                            @error('hero_subtitle')<p class="ed-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- 2. Stats --}}
                <div class="ed-card">
                    <div class="ed-card-title"><span class="ed-num">2</span> Stats Bar</div>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach([1,2,3] as $i)
                        <div class="ed-sub">
                            <div class="ed-sub-title">Stat {{ $i }}</div>
                            <div class="space-y-2">
                                <div>
                                    <label class="ed-label">Number</label>
                                    <input type="text" name="stat{{ $i }}_number" value="{{ old("stat{$i}_number", $page->{"stat{$i}_number"}) }}" class="ed-input" placeholder="e.g. 5,000+">
                                </div>
                                <div>
                                    <label class="ed-label">Label</label>
                                    <input type="text" name="stat{{ $i }}_label" value="{{ old("stat{$i}_label", $page->{"stat{$i}_label"}) }}" class="ed-input" placeholder="e.g. Students Funded">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- 3. Features --}}
                <div class="ed-card">
                    <div class="ed-card-title"><span class="ed-num">3</span> Features Section</div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="ed-label">Section Title</label>
                            <input type="text" name="card_title" value="{{ old('card_title', $page->card_title) }}" class="ed-input">
                        </div>
                        <div>
                            <label class="ed-label">Section Subtitle</label>
                            <input type="text" name="card_subtitle" value="{{ old('card_subtitle', $page->card_subtitle) }}" class="ed-input">
                        </div>
                    </div>
                    @foreach([1,2,3] as $i)
                    <div class="ed-sub">
                        <div class="ed-sub-title">Feature {{ $i }}</div>
                        <div class="grid grid-cols-4 gap-3">
                            <div>
                                <label class="ed-label">Icon (emoji)</label>
                                <input type="text" name="feature{{ $i }}_icon" value="{{ old("feature{$i}_icon", $page->{"feature{$i}_icon"}) }}" class="ed-input" placeholder="🎓">
                            </div>
                            <div>
                                <label class="ed-label">Title</label>
                                <input type="text" name="feature{{ $i }}_title" value="{{ old("feature{$i}_title", $page->{"feature{$i}_title"}) }}" class="ed-input">
                            </div>
                            <div class="col-span-2">
                                <label class="ed-label">Description</label>
                                <input type="text" name="feature{{ $i }}_desc" value="{{ old("feature{$i}_desc", $page->{"feature{$i}_desc"}) }}" class="ed-input">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div>
                                <label class="ed-label">Learn More — Button Label</label>
                                <input type="text" name="feature{{ $i }}_link_label" value="{{ old("feature{$i}_link_label", $page->{"feature{$i}_link_label"} ?? 'Learn more') }}" class="ed-input" placeholder="Learn more">
                            </div>
                            <div>
                                <label class="ed-label">Learn More — URL</label>
                                <input type="text" name="feature{{ $i }}_link_url" value="{{ old("feature{$i}_link_url", $page->{"feature{$i}_link_url"} ?? '#') }}" class="ed-input" placeholder="https:// or #section">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- 4. How It Works --}}
                <div class="ed-card">
                    <div class="ed-card-title"><span class="ed-num">4</span> How It Works (3 Steps)</div>
                    @foreach([1,2,3] as $i)
                    <div class="ed-sub">
                        <div class="ed-sub-title">Step {{ $i }}</div>
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <label class="ed-label">Title</label>
                                <input type="text" name="step{{ $i }}_title" value="{{ old("step{$i}_title", $page->{"step{$i}_title"}) }}" class="ed-input">
                            </div>
                            <div class="col-span-2">
                                <label class="ed-label">Description</label>
                                <input type="text" name="step{{ $i }}_desc" value="{{ old("step{$i}_desc", $page->{"step{$i}_desc"}) }}" class="ed-input">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- 5. Testimonials --}}
                <div class="ed-card">
                    <div class="ed-card-title"><span class="ed-num">5</span> Testimonials</div>
                    @foreach([1,2,3] as $i)
                    <div class="ed-sub">
                        <div class="ed-sub-title">Testimonial {{ $i }}</div>
                        <div class="space-y-3">
                            <div>
                                <label class="ed-label">Quote Text</label>
                                <textarea name="testimonial{{ $i }}_text" rows="2" class="ed-input">{{ old("testimonial{$i}_text", $page->{"testimonial{$i}_text"}) }}</textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="ed-label">Name</label>
                                    <input type="text" name="testimonial{{ $i }}_name" value="{{ old("testimonial{$i}_name", $page->{"testimonial{$i}_name"}) }}" class="ed-input">
                                </div>
                                <div>
                                    <label class="ed-label">Role / School</label>
                                    <input type="text" name="testimonial{{ $i }}_role" value="{{ old("testimonial{$i}_role", $page->{"testimonial{$i}_role"}) }}" class="ed-input">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- 6. CTA --}}
                <div class="ed-card">
                    <div class="ed-card-title"><span class="ed-num">6</span> Call-to-Action Band</div>
                    <div class="space-y-3">
                        <div>
                            <label class="ed-label">Title</label>
                            <input type="text" name="cta_title" value="{{ old('cta_title', $page->cta_title) }}" class="ed-input">
                        </div>
                        <div>
                            <label class="ed-label">Description</label>
                            <textarea name="cta_desc" rows="2" class="ed-input">{{ old('cta_desc', $page->cta_desc) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- 7. Footer --}}
                <div class="ed-card">
                    <div class="ed-card-title"><span class="ed-num">7</span> Footer</div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="ed-label">Site Name</label>
                            <input type="text" name="footer_site_name" value="{{ old('footer_site_name', $page->footer_site_name) }}" class="ed-input">
                        </div>
                        <div>
                            <label class="ed-label">Copyright Text</label>
                            <input type="text" name="footer_copyright" value="{{ old('footer_copyright', $page->footer_copyright) }}" class="ed-input">
                        </div>
                        <div class="col-span-2">
                            <label class="ed-label">Tagline</label>
                            <input type="text" name="footer_tagline" value="{{ old('footer_tagline', $page->footer_tagline) }}" class="ed-input">
                        </div>
                    </div>
                    <p class="ed-hint">Social Links — use <code style="color:rgba(255,215,0,0.6);background:rgba(255,215,0,0.08);padding:1px 5px;border-radius:4px;">#</code> to hide a link</p>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['facebook','twitter','linkedin','instagram'] as $social)
                        <div>
                            <label class="ed-label">{{ ucfirst($social) }} URL</label>
                            <input type="text" name="footer_{{ $social }}" value="{{ old("footer_{$social}", $page->{"footer_{$social}"}) }}" class="ed-input" placeholder="#">
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pb-8">
                    <a href="/" target="_blank"
                       class="px-5 py-2 rounded-lg text-sm font-medium transition"
                       style="color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.1);"
                       onmouseover="this.style.background='rgba(255,255,255,0.05)'"
                       onmouseout="this.style.background='transparent'">
                        Preview
                    </a>
                    <button type="submit"
                            class="px-6 py-2 rounded-lg text-sm font-bold transition"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;"
                            onmouseover="this.style.boxShadow='0 6px 20px rgba(255,215,0,0.4)'"
                            onmouseout="this.style.boxShadow='none'">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
