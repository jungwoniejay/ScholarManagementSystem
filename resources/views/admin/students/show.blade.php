@extends('layouts.app')

@section('content')
<div class="flex h-screen">
        @include('layouts.sidebar') <!-- your sidebar -->

        <div class="flex-1 p-6 bg-gray-50 overflow-auto">
            <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
                <h1 class="text-2xl font-semibold mb-6">Student Details</h1>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->first_name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->last_name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->email }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->phone }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->address }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->date_of_birth }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->gender }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Enrollment Year</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->enrollment_year }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Course</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->course }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">GPA</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->gpa }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $student->status }}</p>
                    </div>
                </div>

                <div class="pt-4">
                    <a href="{{ route('admin.students.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded shadow hover:bg-gray-700 transition">Back to List</a>
                    <a href="{{ route('admin.students.edit', $student) }}" class="px-4 py-2 bg-cyan-600 text-white rounded shadow hover:bg-cyan-700 transition ml-2">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
