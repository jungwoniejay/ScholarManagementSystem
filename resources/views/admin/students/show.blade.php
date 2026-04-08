<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Student Details</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.students.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Students
        </a>

        <div class="rounded-2xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-xl font-bold mb-6" style="color:#FFD700;">
                {{ $student->first_name }} {{ $student->last_name }}
            </h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach([
                    ['label'=>'First Name','value'=>$student->first_name],
                    ['label'=>'Last Name','value'=>$student->last_name],
                    ['label'=>'Email','value'=>$student->email],
                    ['label'=>'Phone','value'=>$student->phone ?? '—'],
                    ['label'=>'Address','value'=>$student->address ?? '—'],
                    ['label'=>'Date of Birth','value'=>$student->date_of_birth?->format('M d, Y') ?? '—'],
                    ['label'=>'Gender','value'=>ucfirst($student->gender ?? '—')],
                    ['label'=>'Enrollment Year','value'=>$student->enrollment_year ?? '—'],
                    ['label'=>'Course','value'=>$student->course ?? '—'],
                    ['label'=>'GPA','value'=>$student->gpa ?? '—'],
                    ['label'=>'Status','value'=>ucfirst($student->status ?? '—')],
                ] as $field)
                <div class="p-3 rounded-lg" style="background:#0A1628;">
                    <p class="text-xs font-semibold mb-1" style="color:#8b949e;">{{ $field['label'] }}</p>
                    <p class="text-sm" style="color:#e2e8f0;">{{ $field['value'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="flex gap-3 pt-6">
                <a href="{{ route('admin.students.edit', $student) }}"
                   class="px-4 py-2 text-sm font-semibold rounded-lg transition"
                   style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Edit</a>
                <a href="{{ route('admin.students.index') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition"
                   style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Back to List</a>
            </div>
        </div>
    </div>
</x-app-layout>
