@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-slate-100">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main --}}
    <div class="flex-1 p-6 lg:p-8 overflow-auto">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Students</h1>
                    <p class="text-sm text-slate-500">Manage all registered students</p>
                </div>

                <a href="{{ route('admin.students.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-cyan-700 transition">
                    + Add Student
                </a>
            </div>

            {{-- Table Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Phone
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Course
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse($students as $student)
                                <tr class="hover:bg-slate-50 transition">

                                    {{-- Name --}}
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-slate-800">
                                            {{ $student->first_name }} {{ $student->last_name }}
                                        </div>
                                    </td>

                                    {{-- Email --}}
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        {{ $student->email }}
                                    </td>

                                    {{-- Phone --}}
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        {{ $student->phone ?? '—' }}
                                    </td>

                                    {{-- Course --}}
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        {{ $student->course ?? '—' }}
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $student->status === 'active'
                                                ? 'bg-emerald-100 text-emerald-700'
                                                : 'bg-slate-100 text-slate-600' }}">
                                            {{ ucfirst($student->status ?? 'N/A') }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">

                                            <a href="{{ route('admin.students.show', $student) }}"
                                               class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition">
                                                View
                                            </a>

                                            <a href="{{ route('admin.students.edit', $student) }}"
                                               class="px-3 py-1 text-xs font-semibold bg-amber-100 text-amber-700 rounded hover:bg-amber-200 transition">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.students.destroy', $student) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this student?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded hover:bg-red-200 transition">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-slate-400">
                                        No students found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
