@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.courses.index') }}" class="text-slate-500 hover:text-slate-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-slate-900">Create Course</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 max-w-4xl">
        <form method="POST" action="{{ route('admin.courses.store') }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Code --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Course Code</label>
                    <input type="text" name="code" 
                           value="{{ old('code') }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('code') border-red-500 ring-red-200 @enderror"
                           placeholder="e.g., BSIT" required>
                    @error('code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Course Name</label>
                    <input type="text" name="name" 
                           value="{{ old('name') }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('name') border-red-500 ring-red-200 @enderror"
                           placeholder="e.g., Bachelor of Science in Information Technology" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Description (Optional)</label>
                <textarea name="description" rows="4" 
                          class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-vertical @error('description') border-red-500 ring-red-200 @enderror"
                          placeholder="Enter course description">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                           class="w-5 h-5 text-emerald-600 bg-slate-100 border-slate-300 rounded focus:ring-emerald-500">
                    <span class="ml-3 text-sm font-semibold text-slate-700">Active</span>
                </label>
                <p class="text-xs text-slate-500 ml-8">Course will be available for student enrollment</p>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-slate-200">
                <button type="submit" 
                        class="flex-1 sm:flex-none bg-blue-600 hover:bg-blue-700 text-white py-3 px-8 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 text-lg">
                    <svg class="w-5 h-5 inline-block mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Create Course
                </button>
                <a href="{{ route('admin.courses.index') }}" 
                   class="flex-1 sm:w-auto text-center text-slate-700 hover:text-slate-900 font-semibold py-3 px-8 border border-slate-300 rounded-xl hover:bg-slate-50 transition-all duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection