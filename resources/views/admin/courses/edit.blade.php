<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Edit Course</h2>
    </x-slot>
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Courses
        </a>
        <div class="rounded-2xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-xl font-bold mb-6" style="color:#e2e8f0;">Edit Course</h1>
            @php $is = 'background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;'; $ls = 'color:#8b949e;'; @endphp
            <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="space-y-4">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Course Code</label>
                        <input type="text" name="code" value="{{ old('code', $course->code) }}" required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                        @error('code')<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Course Name</label>
                        <input type="text" name="name" value="{{ old('name', $course->name) }}" required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">
                        @error('name')<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Description (Optional)</label>
                    <textarea name="description" rows="3" class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $is }}">{{ old('description', $course->description) }}</textarea>
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $course->is_active) ? 'checked' : '' }} style="accent-color:#FFD700;">
                    <span class="text-sm font-semibold" style="{{ $ls }}">Active — available for student enrollment</span>
                </label>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 text-sm font-semibold rounded-xl"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Update Course</button>
                    <a href="{{ route('admin.courses.index') }}" class="px-6 py-2.5 text-sm font-medium rounded-xl"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
