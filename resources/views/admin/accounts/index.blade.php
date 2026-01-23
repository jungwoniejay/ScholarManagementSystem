<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Accounts') }}
        </h2>
    </x-slot>

    <div class="flex h-screen">
        @include('layouts.sidebar') <!-- your sidebar -->

        <div class="flex-1 p-6 bg-gray-50 overflow-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Admin Accounts</h1>
                <a href="{{ route('admin.accounts.create') }}" class="px-4 py-2 bg-cyan-600 text-white rounded shadow hover:bg-cyan-700 transition">
                    + Add Admin
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Admin ID</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Full Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Role</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Contact Number</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($admins as $admin)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $admin->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $admin->full_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $admin->role }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $admin->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $admin->contact_number }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 flex gap-2">
                                <a href="{{ route('admin.accounts.edit', $admin->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('admin.accounts.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
