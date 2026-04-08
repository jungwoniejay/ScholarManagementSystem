<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Edit Donator</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.donators.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Donators
        </a>

        <div class="rounded-2xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-xl font-bold mb-6" style="color:#e2e8f0;">Edit Donator</h1>

            @if($errors->any())
                <div class="mb-4 p-4 rounded-lg text-sm" style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.donators.update', $donator) }}" class="space-y-6">
                @csrf @method('PUT')
                @php
                $is = 'background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;';
                $ls = 'color:#8b949e;';
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach([
                        ['label'=>'Organization Name','name'=>'organization_name','type'=>'text','value'=>old('organization_name',$donator->organization_name)],
                        ['label'=>'Contact Person','name'=>'contact_person','type'=>'text','value'=>old('contact_person',$donator->contact_person)],
                        ['label'=>'Email','name'=>'email','type'=>'email','value'=>old('email',$donator->email)],
                        ['label'=>'Contact Number','name'=>'contact_number','type'=>'text','value'=>old('contact_number',$donator->contact_number)],
                        ['label'=>'Total Fund','name'=>'total_fund','type'=>'number','value'=>old('total_fund',$donator->total_fund)],
                        ['label'=>'Available Fund','name'=>'available_fund','type'=>'number','value'=>old('available_fund',$donator->available_fund)],
                    ] as $field)
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" value="{{ $field['value'] }}"
                               {{ in_array($field['name'],['total_fund','available_fund']) ? 'step=0.01' : '' }} required
                               class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               style="{{ $is }}">
                        @error($field['name'])<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                    </div>
                    @endforeach

                    {{-- Account Status --}}
                    <div>
                        <label class="block text-xs font-semibold mb-1.5" style="{{ $ls }}">Account Status</label>
                        <select name="account_status" required
                                class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                style="{{ $is }}">
                            <option value="active" {{ old('account_status',$donator->account_status)=='active'?'selected':'' }}>Active</option>
                            <option value="inactive" {{ old('account_status',$donator->account_status)=='inactive'?'selected':'' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                {{-- Scholarships --}}
                <div>
                    <label class="block text-xs font-semibold mb-3" style="{{ $ls }}">Assign to Scholarships</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($scholarships as $scholarship)
                        <label class="flex items-center gap-2 p-3 rounded-lg cursor-pointer" style="background:#0A1628;border:1px solid #1E3A8A;">
                            <input type="checkbox" name="scholarship_ids[]" value="{{ $scholarship->id }}"
                                   {{ in_array($scholarship->id, old('scholarship_ids', $donator->scholarships->pluck('id')->toArray())) ? 'checked' : '' }}
                                   style="accent-color:#FFD700;">
                            <span class="text-sm" style="color:#e2e8f0;">{{ $scholarship->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 text-sm font-semibold rounded-xl transition"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Update Donator</button>
                    <a href="{{ route('admin.donators.index') }}" class="px-6 py-2.5 text-sm font-medium rounded-xl transition"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
