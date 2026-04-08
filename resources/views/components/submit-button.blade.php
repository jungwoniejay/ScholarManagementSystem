@props([
    'label'        => 'Save',
    'loadingLabel' => 'Saving...',
    'class'        => 'px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition shadow-sm disabled:opacity-60 disabled:cursor-not-allowed',
])

<button type="submit"
    x-data="{ loading: false }"
    x-on:click="loading = true"
    :disabled="loading"
    {{ $attributes->merge(['class' => $class]) }}>
    <span x-show="!loading" class="flex items-center gap-2">
        {{ $slot->isEmpty() ? $label : $slot }}
    </span>
    <span x-show="loading" x-cloak class="flex items-center gap-2">
        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
        </svg>
        {{ $loadingLabel }}
    </span>
</button>
