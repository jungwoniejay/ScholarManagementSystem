@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.announcements.index') }}" class="text-slate-500 hover:text-slate-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-slate-900">Edit Announcement</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 max-w-4xl">
        <form method="POST" action="{{ route('admin.announcements.update', $announcement) }}" class="space-y-6">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Title --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                    <input type="text" name="title" value="{{ old('title', $announcement->title) }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('title') border-red-500 ring-red-200 @enderror"
                           placeholder="Enter announcement title" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Type --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Type</label>
                    <select name="type" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('type') border-red-500 ring-red-200 @enderror" required>
                        <option value="">Select type</option>
                        <option value="info" {{ old('type', $announcement->type) == 'info' ? 'selected' : '' }}>Info</option>
                        <option value="warning" {{ old('type', $announcement->type) == 'warning' ? 'selected' : '' }}>Warning</option>
                        <option value="success" {{ old('type', $announcement->type) == 'success' ? 'selected' : '' }}>Success</option>
                        <option value="danger" {{ old('type', $announcement->type) == 'danger' ? 'selected' : '' }}>Danger</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Body --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Message</label>
                <textarea name="body" rows="6" 
                          class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-vertical @error('body') border-red-500 ring-red-200 @enderror"
                          placeholder="Enter announcement message" required>{{ old('body', $announcement->body) }}</textarea>
                @error('body')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Visibility Options --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="show_on_landing" value="1" {{ old('show_on_landing', $announcement->show_on_landing) ? 'checked' : '' }} 
                               class="w-5 h-5 text-blue-600 bg-slate-100 border-slate-300 rounded focus:ring-blue-500">
                        <span class="ml-3 text-sm font-semibold text-slate-700">Show on Landing Page</span>
                    </label>
                    <p class="text-xs text-slate-500 ml-8">Visible to all visitors on homepage</p>
                </div>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="show_on_student_dashboard" value="1" {{ old('show_on_student_dashboard', $announcement->show_on_student_dashboard) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 bg-slate-100 border-slate-300 rounded focus:ring-blue-500">
                        <span class="ml-3 text-sm font-semibold text-slate-700">Student Dashboard</span>
                    </label>
                    <p class="text-xs text-slate-500 ml-8">Visible to logged-in students</p>
                </div>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 text-emerald-600 bg-slate-100 border-slate-300 rounded focus:ring-emerald-500">
                        <span class="ml-3 text-sm font-semibold text-slate-700">Active</span>
                    </label>
                </div>
            </div>

            {{-- Date Range --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Starts At (Optional)</label>
                    <input type="datetime-local" name="starts_at" value="{{ old('starts_at', $announcement->starts_at?->format('Y-m-d\TH:i')) }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Ends At (Optional)</label>
                    <input type="datetime-local" name="ends_at" value="{{ old('ends_at', $announcement->ends_at?->format('Y-m-d\TH:i')) }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-slate-200">
                <button type="submit" 
                        class="flex-1 sm:flex-none bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-8 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 text-lg">
                    <svg class="w-5 h-5 inline-block mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Announcement
                </button>
                <a href="{{ route('admin.announcements.index') }}" 
                   class="flex-1 sm:w-auto text-center text-slate-700 hover:text-slate-900 font-semibold py-3 px-8 border border-slate-300 rounded-xl hover:bg-slate-50 transition-all duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

