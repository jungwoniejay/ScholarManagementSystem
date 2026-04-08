<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Edit Scholarship</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.scholarships.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Scholarships
        </a>

        <div class="rounded-2xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-xl font-bold mb-6" style="color:#e2e8f0;">Edit Scholarship</h1>

            @if($errors->any())
                <div class="mb-4 p-4 rounded-lg text-sm" style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.scholarships.update', $scholarship->id) }}" method="POST" class="space-y-4">
                @csrf @method('PUT')
                @php
                $is = 'background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;';
                $ls = 'color:#8b949e;';
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Name</label>
                        <input type="text" name="name" value="{{ old('name', $scholarship->name) }}" required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               style="{{ $is }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Amount</label>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount', $scholarship->amount) }}" required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               style="{{ $is }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Application Deadline</label>
                        <input type="date" name="application_deadline" value="{{ old('application_deadline', $scholarship->application_deadline->format('Y-m-d')) }}" required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               style="{{ $is }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Status</label>
                        <select name="status" required
                                class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                style="{{ $is }}">
                            <option value="active" {{ old('status', $scholarship->status)==='active'?'selected':'' }}>Active</option>
                            <option value="inactive" {{ old('status', $scholarship->status)==='inactive'?'selected':'' }}>Inactive</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Max Recipients</label>
                        <input type="number" name="max_recipients" value="{{ old('max_recipients', $scholarship->max_recipients) }}" min="1" required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               style="{{ $is }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Academic Year</label>
                        <input type="text" name="academic_year" value="{{ old('academic_year', $scholarship->academic_year) }}" required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               style="{{ $is }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Eligibility Criteria</label>
                        <textarea name="eligibility_criteria" rows="3"
                                  class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                  style="{{ $is }}">{{ old('eligibility_criteria', $scholarship->eligibility_criteria) }}</textarea>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 text-sm font-semibold rounded-xl transition"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Update Scholarship</button>
                    <a href="{{ route('admin.scholarships.index') }}" class="px-6 py-2.5 text-sm font-medium rounded-xl transition"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
