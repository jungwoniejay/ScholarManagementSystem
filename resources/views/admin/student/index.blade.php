@extends('layouts.app')

@section('content')
<div class="flex h-screen">
        @include('layouts.sidebar') <!-- your sidebar -->

        <div class="flex-1 p-6 bg-gray-50 overflow-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Students</h1>
                <a href="{{ route('admin.students.create') }}" class="px-4 py-2 bg-cyan-600 text-white rounded shadow hover:bg-cyan-700 transition">
                    + Add Student
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($students as $student)
                       <tr>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $student->id }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $student->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $student->status }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700 flex gap-2">
                        <a href="{{ route('admin.students.edit', $student) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>

                        @endforeach
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
