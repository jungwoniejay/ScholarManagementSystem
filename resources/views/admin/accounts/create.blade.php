@extends('layouts.app')
@section('content')
<div class="p-6 max-w-xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.accounts.index') }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Accounts
        </a>
        <h1 class="text-2xl font-bold text-slate-900">Create Admin Account</h1>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <form method="POST" action="{{ route('admin.accounts.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
                    Create Account
                </button>
                <a href="{{ route('admin.accounts.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
