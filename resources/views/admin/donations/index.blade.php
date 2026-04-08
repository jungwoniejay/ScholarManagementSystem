<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Manage Donations</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['label'=>'Total Donations','value'=>number_format($totalDonations),'color'=>'#60a5fa'],
                ['label'=>'Total Amount','value'=>'₱'.number_format($totalAmount,2),'color'=>'#4ade80'],
                ['label'=>'Active Donors','value'=>$donators->where('account_status','active')->count(),'color'=>'#a78bfa'],
                ['label'=>'Available Funds','value'=>'₱'.number_format($donators->sum('available_fund'),2),'color'=>'#fbbf24'],
            ] as $stat)
            <div class="p-5 rounded-xl" style="background:#0F2044;border:1px solid #1E3A8A;">
                <p class="text-xs font-semibold mb-1" style="color:#8b949e;">{{ $stat['label'] }}</p>
                <p class="text-2xl font-bold" style="color:{{ $stat['color'] }};">{{ $stat['value'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Filters --}}
        <div class="rounded-xl p-5" style="background:#0F2044;border:1px solid #1E3A8A;">
            <form method="GET" action="{{ route('admin.donations.index') }}" class="flex flex-wrap gap-4 items-end">
                @php $is = 'background:#0A1628;border:1px solid #1E3A8A;color:#e2e8f0;padding:8px 12px;border-radius:8px;font-size:13px;'; @endphp
                <div>
                    <label class="block text-xs font-semibold mb-1" style="color:#8b949e;">Donator</label>
                    <select name="donator_id" style="{{ $is }}">
                        <option value="">All Donators</option>
                        @foreach($donators as $donator)
                            <option value="{{ $donator->donator_id }}" {{ request('donator_id')==$donator->donator_id?'selected':'' }}>
                                {{ $donator->organization_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1" style="color:#8b949e;">Method</label>
                    <select name="method" style="{{ $is }}">
                        <option value="">All Methods</option>
                        <option value="Cash" {{ request('method')=='Cash'?'selected':'' }}>Cash</option>
                        <option value="GCash" {{ request('method')=='GCash'?'selected':'' }}>GCash</option>
                        <option value="Bank Transfer" {{ request('method')=='Bank Transfer'?'selected':'' }}>Bank Transfer</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1" style="color:#8b949e;">Start Date</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" style="{{ $is }}">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1" style="color:#8b949e;">End Date</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" style="{{ $is }}">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-lg"
                            style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Filter</button>
                    <a href="{{ route('admin.donations.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg"
                       style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Reset</a>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="flex justify-between items-center px-6 py-4" style="border-bottom:1px solid #1E3A8A;">
                <h3 class="text-sm font-bold" style="color:#e2e8f0;">Donations List</h3>
                <a href="{{ route('admin.donations.export', request()->query()) }}"
                   class="px-4 py-2 text-xs font-semibold rounded-lg"
                   style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">
                    Export CSV
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Donator</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Donor Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        @php
                            $statusStyle = match($donation->approval_status ?? 'pending') {
                                'approved' => 'background:rgba(34,197,94,0.15);color:#4ade80;',
                                'rejected' => 'background:rgba(248,113,113,0.15);color:#f87171;',
                                default    => 'background:rgba(251,191,36,0.15);color:#fbbf24;',
                            };
                        @endphp
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $donation->id }}</td>
                            <td class="px-6 py-4 text-sm font-medium" style="color:#60a5fa;">
                                {{ $donation->donator->organization_name ?? 'Guest' }}
                            </td>
                            <td class="px-6 py-4 text-sm" style="color:#e2e8f0;">{{ $donation->donor_name }}</td>
                            <td class="px-6 py-4 text-sm font-semibold" style="color:#4ade80;">₱{{ number_format($donation->amount, 2) }}</td>
                            <td class="px-6 py-4">
                                @if($donation->method)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full"
                                          style="background:rgba(96,165,250,0.15);color:#60a5fa;">{{ $donation->method }}</span>
                                @else
                                    <span style="color:#8b949e;">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $donation->donation_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" style="{{ $statusStyle }}">
                                    {{ ucfirst($donation->approval_status ?? 'pending') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.donations.show', $donation->id) }}"
                                       class="px-3 py-1 text-xs font-semibold rounded"
                                       style="background:rgba(96,165,250,0.15);color:#60a5fa;">View</a>
                                    @if(($donation->approval_status ?? 'pending') === 'pending')
                                        <form action="{{ route('admin.donations.approve', $donation->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" onclick="return confirm('Approve this donation and credit funds to donor?')"
                                                    class="px-3 py-1 text-xs font-semibold rounded"
                                                    style="background:rgba(34,197,94,0.15);color:#4ade80;">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.donations.reject', $donation->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" onclick="return confirm('Reject this donation?')"
                                                    class="px-3 py-1 text-xs font-semibold rounded"
                                                    style="background:rgba(248,113,113,0.15);color:#f87171;">Reject</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-sm" style="color:#8b949e;">No donations found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4" style="border-top:1px solid #1E3A8A;">{{ $donations->links() }}</div>
        </div>

        {{-- By Method --}}
        @if($totalByMethod->count() > 0)
        <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h3 class="text-sm font-bold mb-4" style="color:#e2e8f0;">Donations by Method</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach($totalByMethod as $method)
                <div class="p-4 rounded-xl" style="background:#0A1628;border:1px solid #1E3A8A;">
                    <p class="text-xs font-semibold mb-1" style="color:#8b949e;">{{ $method->method ?? 'Unknown' }}</p>
                    <p class="text-lg font-bold" style="color:#e2e8f0;">{{ $method->count }} donations</p>
                    <p class="text-sm font-semibold" style="color:#4ade80;">₱{{ number_format($method->total, 2) }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
