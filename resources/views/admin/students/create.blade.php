@extends('layouts.app')

@section('content')
<div class="flex h-screen">
        @include('layouts.sidebar') <!-- your sidebar -->

        <div class="flex-1 p-6 bg-gray-50 overflow-auto">
            <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
                <h1 class="text-2xl font-semibold mb-6">Add Student</h1>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.students.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <select name="gender" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Enrollment Year</label>
                        <input type="number" name="enrollment_year" value="{{ old('enrollment_year') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Course</label>
                        <input type="text" name="course" value="{{ old('course') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">GPA</label>
                        <input type="number" step="0.01" name="gpa" value="{{ old('gpa') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <input type="text" name="status" value="{{ old('status') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="px-6 py-2 bg-cyan-600 text-white rounded shadow hover:bg-cyan-700 transition">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
