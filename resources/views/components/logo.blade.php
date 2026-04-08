<div {{ $attributes->merge(['class' => 'logo-container']) }}>
    @if($variant === 'icon')
        <img src="{{ asset('images/scholarhub-icon.svg') }}" alt="ScholarHub Icon" class="logo-icon">
    @elseif($variant === 'dark')
        <img src="{{ asset('images/scholarhub-logo-dark.svg') }}" alt="ScholarHub Logo" class="logo-full">
    @else
        <img src="{{ asset('images/scholarhub-logo.svg') }}" alt="ScholarHub Logo" class="logo-full">
    @endif
</div>
