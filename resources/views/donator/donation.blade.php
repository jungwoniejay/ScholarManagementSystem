@extends('layouts.app')
@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">My Donations</h1>
            <p class="text-sm mt-1" style="color:#8b949e;">Track all your scholarship donations</p>
        </div>
        <a href="{{ route('donator.donations.create') }}"
           class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold"
           style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Donation
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 px-4 py-3 rounded-lg text-sm font-medium" style="background:rgba(34,197,94,0.15);color:#22C55E;border:1px solid rgba(34,197,94,0.3);">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-xl border overflow-hidden" style="background:#0F2044;border-color:#1E3A8A;">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr style="border-bottom:1px solid #1E3A8A;">
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Donor Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Method</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color:#8b949e;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations ?? [] as $donation)
                        <tr style="border-bottom:1px solid rgba(30,58,138,0.4);" onmouseover="this.style.background='rgba(255,215,0,0.03)'" onmouseout="this.style.background='transparent'">
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">#{{ $donation->id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-white">{{ $donation->donor_name }}</td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $donation->email ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-bold" style="color:#FFD700;">₱{{ number_format($donation->amount, 2) }}</td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $donation->method ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $donation->donation_date }}</td>
                            <td class="px-6 py-4 text-sm flex items-center gap-3">
                                <a href="{{ route('donator.donations.show', $donation->id) }}" style="color:#60A5FA;">View</a>
                                <a href="{{ route('donator.donations.edit', $donation->id) }}" style="color:#FBBF24;">Edit</a>
                                <form action="{{ route('donator.donations.destroy', $donation->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this donation?')" style="color:#F87171;background:none;border:none;cursor:pointer;font-size:0.875rem;">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center" style="color:#8b949e;">
                                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p>No donations found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
