@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Announcements</h1>
            <p class="text-slate-500 mt-1">Manage system announcements for landing page and student dashboard.</p>
        </div>
        <a href="{{ route('admin.announcements.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200">
            <svg class="w-5 h-5 inline-block mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            New Announcement
        </a>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Status</label>
                <select name="active" class="w-full sm:w-40 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All</option>
                    <option value="1" {{ request('active') == '1' ? 'selected' : '' }}>Active</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Show on Landing</label>
                <select name="landing" class="w-full sm:w-44 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Any</option>
                    <option value="1" {{ request('landing') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Student Dashboard</label>
                <select name="dashboard" class="w-full sm:w-48 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Any</option>
                    <option value="1" {{ request('dashboard') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200">
                Filter
            </button>
            @if(request()->hasAny(['active', 'landing', 'dashboard']))
                <a href="{{ route('admin.announcements.index') }}" class="text-slate-500 hover:text-slate-700 text-sm font-medium underline">Clear</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Locations</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($announcements as $announcement)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-5">
                            <div class="font-semibold text-slate-900 max-w-md truncate">{{ $announcement->title }}</div>
                            <div class="text-sm text-slate-500 mt-1 line-clamp-2">{{ Str::limit($announcement->body, 120) }}</div>
                        </td>
                        <td class="px-6 py-5">
                            @php $typeColors = ['info' => 'blue', 'warning' => 'amber', 'success' => 'emerald', 'danger' => 'red']; @endphp
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-{{ $typeColors[$announcement->type] }}-100 text-{{ $typeColors[$announcement->type] }}-800">
                                {{ ucfirst($announcement->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-wrap gap-1">
                                @if($announcement->show_on_landing)
                                    <span class="inline-flex px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-md font-medium">Landing</span>
                                @endif
                                @if($announcement->show_on_student_dashboard)
                                    <span class="inline-flex px-2 py-1 bg-emerald-100 text-emerald-800 text-xs rounded-md font-medium">Dashboard</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $announcement->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-800' }}">
                                {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right space-x-2">
                            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm" 
                                        onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            <svg class="w-16 h-16 mx-auto mb-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <p class="text-lg font-medium">No announcements found</p>
                            <p class="mt-1">Create your first announcement to get started.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
            {{ $announcements->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection

