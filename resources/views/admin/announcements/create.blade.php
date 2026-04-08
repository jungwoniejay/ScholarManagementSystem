<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Create Announcement</h2>
    </x-slot>
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.announcements.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Announcements
        </a>
        <div class="rounded-2xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-xl font-bold mb-6" style="color:#e2e8f0;">Create Announcement</h1>
            @php $is = 'background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;'; $ls = 'color:#8b949e;'; @endphp
            <form method="POST" action="{{ route('admin.announcements.store') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                        @error('title')<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Type</label>
                        <select name="type" required class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                            <option value="">Select type</option>
                            @foreach(['info','warning','success','danger'] as $t)
                            <option value="{{ $t }}" {{ old('type')===$t?'selected':'' }}>{{ ucfirst($t) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Message</label>
                    <textarea name="body" rows="5" required class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">{{ old('body') }}</textarea>
                    @error('body')<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach([['name'=>'show_on_landing','label'=>'Show on Landing Page'],['name'=>'show_on_student_dashboard','label'=>'Student Dashboard'],['name'=>'is_active','label'=>'Active']] as $cb)
                    <label class="flex items-center gap-2 cursor-pointer p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <input type="checkbox" name="{{ $cb['name'] }}" value="1" {{ old($cb['name'], $cb['name']==='is_active' ? 1 : 0) ? 'checked' : '' }} style="accent-color:#FFD700;">
                        <span class="text-sm" style="{{ $ls }}">{{ $cb['label'] }}</span>
                    </label>
                    @endforeach
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Starts At (Optional)</label>
                        <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}"
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Ends At (Optional)</label>
                        <input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}"
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 text-sm font-semibold rounded-xl"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Create Announcement</button>
                    <a href="{{ route('admin.announcements.index') }}" class="px-6 py-2.5 text-sm font-medium rounded-xl"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
