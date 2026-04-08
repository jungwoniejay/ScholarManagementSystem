@extends('layouts.app')
@section('content')
<div class="px-6 py-8 max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('donator.donations.index') }}" class="flex items-center gap-1 text-sm" style="color:#8b949e;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
        <h1 class="text-2xl font-bold text-white">Edit Donation</h1>
    </div>

    @if($errors->any())
        <div class="mb-6 px-4 py-3 rounded-lg text-sm" style="background:rgba(248,113,113,0.15);color:#F87171;border:1px solid rgba(248,113,113,0.3);">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('donator.donations.update', $donation->id) }}" method="POST"
          class="rounded-xl border p-6 space-y-5" style="background:#0F2044;border-color:#1E3A8A;">
        @csrf
        @method('PUT')

        @php
            $inputStyle = "background:#0A1628;border-color:#1E3A8A;color:#fff;";
            $labelStyle = "color:#8b949e;";
        @endphp

        <div>
            <label class="block text-xs font-medium mb-1" style="{{ $labelStyle }}">Donor Name <span style="color:#F87171;">*</span></label>
            <input type="text" name="donor_name" value="{{ old('donor_name', $donation->donor_name) }}" required
                   class="w-full rounded-lg px-3 py-2 text-sm border focus:outline-none"
                   style="{{ $inputStyle }}">
        </div>

        <div>
            <label class="block text-xs font-medium mb-1" style="{{ $labelStyle }}">Email</label>
            <input type="email" name="email" value="{{ old('email', $donation->email) }}"
                   class="w-full rounded-lg px-3 py-2 text-sm border focus:outline-none"
                   style="{{ $inputStyle }}">
        </div>

        <div>
            <label class="block text-xs font-medium mb-1" style="{{ $labelStyle }}">Amount <span style="color:#F87171;">*</span></label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount', $donation->amount) }}" required
                   class="w-full rounded-lg px-3 py-2 text-sm border focus:outline-none"
                   style="{{ $inputStyle }}">
        </div>

        <div>
            <label class="block text-xs font-medium mb-1" style="{{ $labelStyle }}">Method</label>
            <select name="method" class="w-full rounded-lg px-3 py-2 text-sm border focus:outline-none" style="{{ $inputStyle }}">
                <option value="">Select Method</option>
                <option value="Cash" {{ old('method', $donation->method) == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="GCash" {{ old('method', $donation->method) == 'GCash' ? 'selected' : '' }}>GCash</option>
                <option value="Bank Transfer" {{ old('method', $donation->method) == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-medium mb-1" style="{{ $labelStyle }}">Donation Date <span style="color:#F87171;">*</span></label>
            <input type="date" name="donation_date" value="{{ old('donation_date', $donation->donation_date) }}" required
                   class="w-full rounded-lg px-3 py-2 text-sm border focus:outline-none"
                   style="{{ $inputStyle }}">
        </div>

        <div>
            <label class="block text-xs font-medium mb-1" style="{{ $labelStyle }}">Message</label>
            <textarea name="message" rows="3"
                      class="w-full rounded-lg px-3 py-2 text-sm border focus:outline-none"
                      style="{{ $inputStyle }}">{{ old('message', $donation->message) }}</textarea>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit"
                    class="px-6 py-2 rounded-xl text-sm font-bold"
                    style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                Update Donation
            </button>
            <a href="{{ route('donator.donations.index') }}"
               class="px-6 py-2 rounded-xl text-sm font-medium"
               style="background:rgba(255,255,255,0.05);color:#8b949e;border:1px solid #1E3A8A;">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
