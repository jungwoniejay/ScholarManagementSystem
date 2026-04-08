@extends('layouts.app')
@section('content')
<div class="px-6 py-8 max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('donator.donations.index') }}" class="flex items-center gap-1 text-sm" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Donations
        </a>
        <h1 class="text-2xl font-bold text-white">Donation Details</h1>
    </div>

    <div class="rounded-xl border p-6 space-y-4" style="background:#0F2044;border-color:#1E3A8A;">
        @foreach([
            ['label' => 'Donation ID',   'value' => '#' . $donation->id],
            ['label' => 'Donor Name',    'value' => $donation->donor_name],
            ['label' => 'Email',         'value' => $donation->email ?? '-'],
            ['label' => 'Method',        'value' => $donation->method ?? '-'],
            ['label' => 'Donation Date', 'value' => $donation->donation_date],
            ['label' => 'Message',       'value' => $donation->message ?? '-'],
        ] as $field)
        <div class="flex justify-between items-center py-2" style="border-bottom:1px solid rgba(30,58,138,0.4);">
            <span class="text-sm" style="color:#8b949e;">{{ $field['label'] }}</span>
            <span class="text-sm font-medium text-white">{{ $field['value'] }}</span>
        </div>
        @endforeach

        <div class="flex justify-between items-center py-2">
            <span class="text-sm" style="color:#8b949e;">Amount</span>
            <span class="text-lg font-bold" style="color:#FFD700;">₱{{ number_format($donation->amount, 2) }}</span>
        </div>

        <div class="flex gap-3 pt-4">
            <a href="{{ route('donator.donations.edit', $donation->id) }}"
               class="px-5 py-2 rounded-xl text-sm font-bold"
               style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                Edit
            </a>
            <a href="{{ route('donator.donations.index') }}"
               class="px-5 py-2 rounded-xl text-sm font-medium"
               style="background:rgba(255,255,255,0.05);color:#8b949e;border:1px solid #1E3A8A;">
                Back
            </a>
        </div>
    </div>
</div>
@endsection
