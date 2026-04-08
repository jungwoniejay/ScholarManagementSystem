<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Donator Details</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold" style="color:#FFD700;">{{ $donator->organization_name }}</h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.donators.edit', $donator) }}"
                   class="px-4 py-2 text-sm font-semibold rounded-lg"
                   style="background:rgba(251,191,36,0.15);color:#fbbf24;border:1px solid rgba(251,191,36,0.3);">Edit</a>
                <a href="{{ route('admin.donators.index') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg"
                   style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Back to List</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Donator Info --}}
            <div class="rounded-xl p-6 space-y-4" style="background:#0F2044;border:1px solid #1E3A8A;">
                <h4 class="text-sm font-bold uppercase tracking-wide" style="color:#FFD700;">Donator Information</h4>
                @foreach([
                    ['label'=>'Organization Name','value'=>$donator->organization_name],
                    ['label'=>'Contact Person','value'=>$donator->contact_person],
                    ['label'=>'Email','value'=>$donator->email],
                    ['label'=>'Contact Number','value'=>$donator->contact_number],
                    ['label'=>'Created At','value'=>$donator->created_at->format('M d, Y')],
                ] as $field)
                <div>
                    <p class="text-xs font-semibold mb-1" style="color:#8b949e;">{{ $field['label'] }}</p>
                    <p class="text-sm" style="color:#e2e8f0;">{{ $field['value'] }}</p>
                </div>
                @endforeach
                <div>
                    <p class="text-xs font-semibold mb-1" style="color:#8b949e;">Account Status</p>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full"
                        style="{{ $donator->account_status == 'active' ? 'background:rgba(34,197,94,0.15);color:#4ade80;' : 'background:rgba(248,113,113,0.15);color:#f87171;' }}">
                        {{ ucfirst($donator->account_status) }}
                    </span>
                </div>
            </div>

            {{-- Fund Info --}}
            <div class="rounded-xl p-6 space-y-4" style="background:#0F2044;border:1px solid #1E3A8A;">
                <h4 class="text-sm font-bold uppercase tracking-wide" style="color:#FFD700;">Fund Information</h4>
                <div class="grid grid-cols-3 gap-4">
                    <div class="p-3 rounded-lg text-center" style="background:#0A1628;">
                        <p class="text-xs mb-1" style="color:#8b949e;">Total Fund</p>
                        <p class="text-lg font-bold" style="color:#4ade80;">₱{{ number_format($donator->total_fund, 2) }}</p>
                    </div>
                    <div class="p-3 rounded-lg text-center" style="background:#0A1628;">
                        <p class="text-xs mb-1" style="color:#8b949e;">Available</p>
                        <p class="text-lg font-bold" style="color:#60a5fa;">₱{{ number_format($donator->available_fund, 2) }}</p>
                    </div>
                    <div class="p-3 rounded-lg text-center" style="background:#0A1628;">
                        <p class="text-xs mb-1" style="color:#8b949e;">Used</p>
                        <p class="text-lg font-bold" style="color:#fbbf24;">₱{{ number_format($donator->total_fund - $donator->available_fund, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Assigned Scholarships --}}
        <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h4 class="text-sm font-bold uppercase tracking-wide mb-4" style="color:#FFD700;">Assigned Scholarships</h4>
            @if($donator->scholarships->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($donator->scholarships as $scholarship)
                    <div class="p-4 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                        <h5 class="font-semibold text-sm" style="color:#e2e8f0;">{{ $scholarship->name }}</h5>
                        <p class="text-xs mt-1" style="color:#8b949e;">{{ Str::limit($scholarship->description, 80) }}</p>
                        <p class="text-xs mt-2 font-semibold" style="color:#4ade80;">₱{{ number_format($scholarship->amount, 2) }}</p>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm" style="color:#8b949e;">No scholarships assigned.</p>
            @endif
        </div>

        {{-- Donation History --}}
        <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h4 class="text-sm font-bold uppercase tracking-wide mb-4" style="color:#FFD700;">Donation History</h4>
            @php $donations = $donator->donations()->orderBy('donation_date','desc')->get(); @endphp
            @if($donations->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr style="border-bottom:1px solid #1E3A8A;">
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Method</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donations as $donation)
                            <tr style="border-bottom:1px solid #1E3A8A;">
                                <td class="px-4 py-3 text-sm" style="color:#8b949e;">{{ $donation->id }}</td>
                                <td class="px-4 py-3 text-sm font-semibold" style="color:#4ade80;">₱{{ number_format($donation->amount, 2) }}</td>
                                <td class="px-4 py-3">
                                    @if($donation->method)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background:rgba(96,165,250,0.15);color:#60a5fa;">{{ $donation->method }}</span>
                                    @else
                                        <span style="color:#8b949e;">—</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm" style="color:#e2e8f0;">{{ $donation->donation_date->format('M d, Y') }}</td>
                                <td class="px-4 py-3 text-sm" style="color:#8b949e;">{{ $donation->message ?? '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 p-3 rounded-lg text-sm" style="background:#0A1628;color:#60a5fa;">
                    <strong>Total Donations:</strong> {{ $donations->count() }} &nbsp;|&nbsp;
                    <strong>Total Amount:</strong> ₱{{ number_format($donations->sum('amount'), 2) }}
                </div>
            @else
                <p class="text-sm" style="color:#8b949e;">No donations recorded yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
