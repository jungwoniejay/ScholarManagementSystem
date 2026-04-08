@php
    $messages = [
        'success' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-400', 'text' => 'text-emerald-800', 'icon_color' => 'text-emerald-500', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
        'error'   => ['bg' => 'bg-red-50',     'border' => 'border-red-400',     'text' => 'text-red-800',     'icon_color' => 'text-red-500',     'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
        'warning' => ['bg' => 'bg-amber-50',   'border' => 'border-amber-400',   'text' => 'text-amber-800',   'icon_color' => 'text-amber-500',   'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
        'info'    => ['bg' => 'bg-blue-50',    'border' => 'border-blue-400',    'text' => 'text-blue-800',    'icon_color' => 'text-blue-500',    'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
    ];
@endphp

@foreach(['success','error','warning','info'] as $type)
    @if(session($type))
    @php $cfg = $messages[$type]; @endphp
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 5000)"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="fixed top-4 right-4 z-[99999] max-w-sm w-full {{ $cfg['bg'] }} border {{ $cfg['border'] }} rounded-2xl shadow-xl p-4 flex items-start gap-3"
         role="alert">
        <svg class="w-5 h-5 flex-shrink-0 mt-0.5 {{ $cfg['icon_color'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $cfg['icon'] }}"/>
        </svg>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold {{ $cfg['text'] }}">{{ ucfirst($type) }}</p>
            <p class="text-sm {{ $cfg['text'] }} opacity-90 mt-0.5">{{ session($type) }}</p>
        </div>
        <button @click="show = false" class="flex-shrink-0 {{ $cfg['icon_color'] }} hover:opacity-70 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    @endif
@endforeach

{{-- Validation errors toast --}}
@if($errors->any())
<div x-data="{ show: true }"
     x-show="show"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed top-4 right-4 z-[99999] max-w-sm w-full bg-red-50 border border-red-400 rounded-2xl shadow-xl p-4"
     role="alert">
    <div class="flex items-start gap-3">
        <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-red-800">Please fix the following errors:</p>
            <ul class="mt-1 text-sm text-red-700 list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button @click="show = false" class="flex-shrink-0 text-red-500 hover:opacity-70 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
@endif
