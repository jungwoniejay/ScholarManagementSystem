<x-app-layout>
<div class="p-4 sm:p-6 lg:p-8 max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="rounded-2xl p-6 mb-6 relative overflow-hidden"
         style="background:linear-gradient(135deg,#052e16 0%,#064E3B 60%,#B8860B 100%);">
        <div class="absolute -top-8 -right-8 w-40 h-40 rounded-full opacity-10" style="background:#FFD700;filter:blur(30px);"></div>
        <div class="relative flex items-center gap-4">
            <a href="{{ route('student.wallet.index') }}"
               class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
               style="background:rgba(255,255,255,0.15);">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-white">Withdraw Funds</h2>
                <p class="text-sm" style="color:rgba(255,255,255,.7);">Available: <span class="font-bold text-yellow-300">₱{{ number_format($wallet->balance, 2) }}</span></p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-2xl shadow-sm border p-6" style="border-color:#E5E7EB;">

        @if($wallet->balance <= 0)
        <div class="text-center py-8" style="color:#6B7280;">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
            <p class="text-sm font-medium">No available balance to withdraw.</p>
            <a href="{{ route('student.wallet.index') }}" class="text-sm font-semibold mt-2 inline-block" style="color:#064E3B;">← Back to Wallet</a>
        </div>
        @else

        <form action="{{ route('student.wallet.withdraw') }}" method="POST" id="withdrawForm">
            @csrf

            {{-- Amount --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-1.5" style="color:#1F2937;">Amount to Withdraw</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 font-bold" style="color:#6B7280;">₱</span>
                    <input type="number" name="amount" id="amount" step="0.01" min="1" max="{{ $wallet->balance }}"
                           value="{{ old('amount') }}"
                           class="w-full pl-8 pr-4 py-3 rounded-xl border text-sm focus:outline-none focus:ring-2"
                           style="border-color:#E5E7EB;focus:ring-color:#064E3B;"
                           placeholder="0.00" required>
                </div>
                <p class="text-xs mt-1" style="color:#6B7280;">Max: ₱{{ number_format($wallet->balance, 2) }}</p>
                @error('amount')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Method --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-2" style="color:#1F2937;">Withdrawal Method</label>
                <div class="grid grid-cols-3 gap-3">
                    @foreach([
                        ['value'=>'gcash', 'label'=>'GCash',  'color'=>'#0066CC', 'emoji'=>'💙'],
                        ['value'=>'maya',  'label'=>'Maya',   'color'=>'#00B050', 'emoji'=>'💚'],
                        ['value'=>'bank',  'label'=>'Bank',   'color'=>'#1F2937', 'emoji'=>'🏦'],
                    ] as $m)
                    <label class="method-card cursor-pointer rounded-xl border-2 p-3 text-center transition-all"
                           style="border-color:#E5E7EB;"
                           data-method="{{ $m['value'] }}">
                        <input type="radio" name="method" value="{{ $m['value'] }}" class="hidden" {{ old('method') === $m['value'] ? 'checked' : '' }}>
                        <div class="text-2xl mb-1">{{ $m['emoji'] }}</div>
                        <div class="text-xs font-bold" style="color:{{ $m['color'] }};">{{ $m['label'] }}</div>
                    </label>
                    @endforeach
                </div>
                @error('method')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Account Details --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-1.5" style="color:#1F2937;">Account Name</label>
                <input type="text" name="account_name" value="{{ old('account_name') }}"
                       class="w-full px-4 py-3 rounded-xl border text-sm focus:outline-none focus:ring-2"
                       style="border-color:#E5E7EB;"
                       placeholder="Full name on account" required>
                @error('account_name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold mb-1.5" style="color:#1F2937;" id="accountNumberLabel">
                    GCash / Maya Number
                </label>
                <input type="text" name="account_number" value="{{ old('account_number') }}"
                       class="w-full px-4 py-3 rounded-xl border text-sm focus:outline-none focus:ring-2"
                       style="border-color:#E5E7EB;"
                       placeholder="09XXXXXXXXX" required>
                @error('account_number')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Bank Name (only for bank) --}}
            <div class="mb-6 hidden" id="bankNameField">
                <label class="block text-sm font-semibold mb-1.5" style="color:#1F2937;">Bank Name</label>
                <input type="text" name="bank_name" value="{{ old('bank_name') }}"
                       class="w-full px-4 py-3 rounded-xl border text-sm focus:outline-none focus:ring-2"
                       style="border-color:#E5E7EB;"
                       placeholder="e.g. BDO, BPI, Metrobank">
                @error('bank_name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Info box --}}
            <div class="rounded-xl p-4 mb-6" style="background:#ECFDF5;border:1px solid #D1FAE5;">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="#064E3B" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-xs" style="color:#064E3B;">
                        <p class="font-semibold mb-1">Processing Time</p>
                        <p>GCash & Maya: within <strong>24 hours</strong></p>
                        <p>Bank Transfer: <strong>1–3 business days</strong></p>
                    </div>
                </div>
            </div>

            <button type="submit"
                    class="w-full py-3 rounded-xl font-bold text-sm transition-all"
                    style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#052e16;">
                Submit Withdrawal Request
            </button>
        </form>

        @endif
    </div>
</div>

<script>
    const cards = document.querySelectorAll('.method-card');
    const bankField = document.getElementById('bankNameField');
    const accountLabel = document.getElementById('accountNumberLabel');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            cards.forEach(c => { c.style.borderColor = '#E5E7EB'; c.style.background = ''; });
            card.style.borderColor = '#B8860B';
            card.style.background = '#FEFCE8';
            card.querySelector('input[type=radio]').checked = true;

            const method = card.dataset.method;
            bankField.classList.toggle('hidden', method !== 'bank');
            accountLabel.textContent = method === 'bank' ? 'Account Number' : (method === 'gcash' ? 'GCash Number' : 'Maya Number');
        });
    });

    // Restore selection on page load
    document.querySelectorAll('input[type=radio][name=method]').forEach(r => {
        if (r.checked) r.closest('.method-card').click();
    });
</script>
</x-app-layout>
