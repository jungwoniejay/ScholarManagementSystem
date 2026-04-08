<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Add Student</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.students.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Students
        </a>

        <div class="rounded-2xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-xl font-bold mb-6" style="color:#e2e8f0;">Add Student</h1>

            @if($errors->any())
                <div class="mb-4 p-4 rounded-lg text-sm" style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.students.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @csrf
                @php
                $inputStyle = 'background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;';
                $labelStyle = 'color:#8b949e;';
                @endphp

                @foreach([
                    ['label'=>'First Name','name'=>'first_name','type'=>'text','value'=>old('first_name')],
                    ['label'=>'Last Name','name'=>'last_name','type'=>'text','value'=>old('last_name')],
                    ['label'=>'Email','name'=>'email','type'=>'email','value'=>old('email')],
                    ['label'=>'Phone','name'=>'phone','type'=>'text','value'=>old('phone')],
                    ['label'=>'Address','name'=>'address','type'=>'text','value'=>old('address')],
                    ['label'=>'Date of Birth','name'=>'date_of_birth','type'=>'date','value'=>old('date_of_birth')],
                    ['label'=>'Enrollment Year','name'=>'enrollment_year','type'=>'number','value'=>old('enrollment_year')],
                    ['label'=>'Course','name'=>'course','type'=>'text','value'=>old('course')],
                    ['label'=>'GPA','name'=>'gpa','type'=>'number','value'=>old('gpa')],
                    ['label'=>'Status','name'=>'status','type'=>'text','value'=>old('status')],
                ] as $field)
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="{{ $labelStyle }}">{{ $field['label'] }}</label>
                    <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" value="{{ $field['value'] }}"
                           {{ in_array($field['name'],['gpa']) ? 'step=0.01' : '' }}
                           class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           style="{{ $inputStyle }}">
                </div>
                @endforeach

                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="{{ $labelStyle }}">Gender</label>
                    <select name="gender" class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500" style="{{ $inputStyle }}">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender')=='male'?'selected':'' }}>Male</option>
                        <option value="female" {{ old('gender')=='female'?'selected':'' }}>Female</option>
                        <option value="other" {{ old('gender')=='other'?'selected':'' }}>Other</option>
                    </select>
                </div>

                <div class="sm:col-span-2 flex gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 text-sm font-semibold rounded-xl transition"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Save Student</button>
                    <a href="{{ route('admin.students.index') }}" class="px-6 py-2.5 text-sm font-medium rounded-xl transition"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
