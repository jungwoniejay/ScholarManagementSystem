<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Create Admin Account</h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <a href="{{ route('admin.accounts.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Accounts
        </a>

        <div class="rounded-2xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h1 class="text-xl font-bold mb-4" style="color:#e2e8f0;">Create Admin Account</h1>
            <form method="POST" action="{{ route('admin.accounts.store') }}" class="space-y-4">
                @csrf
                @foreach([
                    ['label'=>'Full Name','name'=>'full_name','type'=>'text','required'=>true,'value'=>old('full_name')],
                    ['label'=>'Role','name'=>'role','type'=>'text','required'=>true,'value'=>old('role','admin')],
                    ['label'=>'Email Address','name'=>'email','type'=>'email','required'=>true,'value'=>old('email')],
                    ['label'=>'Contact Number','name'=>'contact_number','type'=>'text','required'=>false,'value'=>old('contact_number')],
                    ['label'=>'Password','name'=>'password','type'=>'password','required'=>true,'value'=>''],
                    ['label'=>'Confirm Password','name'=>'password_confirmation','type'=>'password','required'=>true,'value'=>''],
                ] as $field)
                <div>
                    <label class="block text-xs font-semibold mb-1.5" style="color:#8b949e;">{{ $field['label'] }}</label>
                    <input type="{{ $field['type'] }}" name="{{ $field['name'] }}"
                           value="{{ $field['value'] }}" {{ $field['required'] ? 'required' : '' }}
                           class="w-full px-3 py-2.5 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500"
                           style="background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;">
                    @error($field['name'])<p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>@enderror
                </div>
                @endforeach
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Create Account</button>
                    <a href="{{ route('admin.accounts.index') }}" class="px-5 py-2.5 text-sm font-medium rounded-xl transition"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
