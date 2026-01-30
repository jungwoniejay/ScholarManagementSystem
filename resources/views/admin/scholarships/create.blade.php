<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Scholarship</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

    <!-- Page Container -->
    <div class="px-8 py-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-900 mb-6">Add Scholarship</h1>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.scholarships.store') }}" method="POST"
              class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Amount</label>
                <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" required
                       class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Eligibility Criteria</label>
                <textarea name="eligibility_criteria" rows="3"
                          class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('eligibility_criteria') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Application Deadline</label>
                <input type="date" name="application_deadline" value="{{ old('application_deadline') }}" required
                       class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Status</label>
                <select name="status" required
                        class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Max Recipients</label>
                <input type="number" name="max_recipients" min="1"
                       value="{{ old('max_recipients', 1) }}" required
                       class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Academic Year</label>
                <input type="text" name="academic_year" value="{{ old('academic_year') }}" required
                       class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <a href="{{ route('admin.scholarships.index') }}"
                   class="px-4 py-2 bg-slate-200 rounded-lg hover:bg-slate-300 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Save
                </button>
            </div>
        </form>
    </div>

</body>
</html>
