<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Donation Details</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.donations.index') }}" class="inline-flex items-center gap-1 text-sm mb-4" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Donations
        </a>

        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">{{ session('error') }}</div>
        @endif

        <div class="rounded-2xl p-6 space-y-6" style="background:#0F2044;border:1px solid #1E3A8A;">

            {{-- Amount hero --}}
            <div class="text-center py-4">
                <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Donation #{{ $donation->id }}</p>
                <p class="text-4xl font-bold" style="color:#4ade80;">₱{{ number_format($donation->amount, 2) }}</p>
                <p class="text-sm mt-1" style="color:#8b949e;">{{ $donation->donation_date->format('M d, Y') }}</p>
            </div>

            <div style="border-top:1px solid #1E3A8A;"></div>

            {{-- Donor info --}}
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wide mb-3" style="color:#FFD700;">Donor Information</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach([
                        ['label'=>'Donor Name','value'=>$donation->donor_name ?? 'N/A'],
                        ['label'=>'Email','value'=>$donation->email ?? 'N/A'],
                        ['label'=>'Organization','value'=>$donation->donator->organization_name ?? 'Guest Donor'],
                    ] as $field)
                    <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <p class="text-xs font-semibold mb-1" style="color:#8b949e;">{{ $field['label'] }}</p>
                        <p class="text-sm" style="color:#e2e8f0;">{{ $field['value'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div style="border-top:1px solid #1E3A8A;"></div>

            {{-- Details --}}
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wide mb-3" style="color:#FFD700;">Donation Details</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Payment Method</p>
                        @if($donation->method)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full"
                                  style="background:rgba(96,165,250,0.15);color:#60a5fa;">{{ $donation->method }}</span>
                        @else
                            <p class="text-sm" style="color:#8b949e;">N/A</p>
                        @endif
                    </div>
                    <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Approval Status</p>
                        @php
                            $sc = ['pending'=>'rgba(251,191,36,0.15);color:#fbbf24;','approved'=>'rgba(34,197,94,0.15);color:#4ade80;','rejected'=>'rgba(248,113,113,0.15);color:#f87171;'];
                            $s = $sc[$donation->approval_status] ?? 'rgba(139,148,158,0.15);color:#8b949e;';
                        @endphp
                        <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background:{{ $s }}">
                            {{ ucfirst($donation->approval_status ?? 'Pending') }}
                        </span>
                    </div>
                    @if($donation->approved_at)
                    <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Approved At</p>
                        <p class="text-sm" style="color:#e2e8f0;">{{ $donation->approved_at->format('M d, Y h:i A') }}</p>
                    </div>
                    @endif
                    @if($donation->scholarship_id)
                    <div class="p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Linked Scholarship</p>
                        <p class="text-sm" style="color:#e2e8f0;">ID: {{ $donation->scholarship_id }}</p>
                    </div>
                    @endif
                </div>
            </div>

            @if($donation->message)
            <div class="p-4 rounded-xl" style="background:#0A1628;border:1px solid #1E3A8A;">
                <p class="text-xs font-semibold mb-2" style="color:#8b949e;">Message</p>
                <p class="text-sm italic" style="color:#e2e8f0;">{{ $donation->message }}</p>
            </div>
            @endif

            @if($donation->admin_remarks)
            <div class="p-4 rounded-xl" style="background:rgba(251,191,36,0.05);border:1px solid rgba(251,191,36,0.2);">
                <p class="text-xs font-semibold mb-2" style="color:#fbbf24;">Admin Remarks</p>
                <p class="text-sm" style="color:#e2e8f0;">{{ $donation->admin_remarks }}</p>
            </div>
            @endif

            {{-- Approve / Reject --}}
            @if(($donation->approval_status ?? 'pending') === 'pending')
            <div class="p-4 rounded-xl" style="background:#0A1628;border:1px solid #1E3A8A;">
                <p class="text-xs font-semibold mb-3" style="color:#8b949e;">Admin Action</p>
                <div class="flex gap-3">
                    <form action="{{ route('admin.donations.approve', $donation->id) }}" method="POST" class="flex-1">
                        @csrf @method('PATCH')
                        <div class="mb-3">
                            <input type="text" name="admin_remarks" placeholder="Remarks (optional)"
                                   class="w-full rounded-lg px-3 py-2 text-sm border focus:outline-none"
                                   style="background:#0F2044;border-color:#1E3A8A;color:#e2e8f0;">
                        </div>
                        <button type="submit" onclick="return confirm('Approve and credit funds to donor?')"
                                class="w-full py-2 rounded-lg text-sm font-bold"
                                style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">
                            ✓ Approve & Credit Funds
                        </button>
                    </form>
                    <form action="{{ route('admin.donations.reject', $donation->id) }}" method="POST" class="flex-1">
                        @csrf @method('PATCH')
                        <div class="mb-3">
                            <input type="text" name="admin_remarks" placeholder="Reason for rejection"
                                   class="w-full rounded-lg px-3 py-2 text-sm border focus:outline-none"
                                   style="background:#0F2044;border-color:#1E3A8A;color:#e2e8f0;">
                        </div>
                        <button type="submit" onclick="return confirm('Reject this donation?')"
                                class="w-full py-2 rounded-lg text-sm font-bold"
                                style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">
                            ✗ Reject
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <div class="flex justify-end pt-2">
                <a href="{{ route('admin.donations.index') }}"
                   class="px-5 py-2.5 text-sm font-medium rounded-xl"
                   style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Back to List</a>
            </div>
        </div>
    </div>
</x-app-layout>
