# ScholarHub Logo Assets

## Logo Files

- **scholarhub-logo.svg** - Full logo with text (light background)
- **scholarhub-logo-dark.svg** - Full logo with text (dark background)
- **scholarhub-icon.svg** - Icon only (for favicon/app icon)

## Usage in Blade Templates

```blade
<!-- Default logo (light background) -->
<x-logo />

<!-- Dark background version -->
<x-logo variant="dark" />

<!-- Icon only -->
<x-logo variant="icon" />

<!-- With custom classes -->
<x-logo class="w-48 h-auto" />
```

## Direct Usage

```html
<img src="{{ asset('images/scholarhub-logo.svg') }}" alt="ScholarHub">
```

## Color Palette

- Primary Blue: #2563EB
- Light Blue: #3B82F6, #60A5FA
- Gold/Yellow: #FBBF24, #FCD34D
- Dark Text: #1E293B
- Light Text: #F1F5F9

## Favicon Setup

Add to your layout head:
```html
<link rel="icon" type="image/svg+xml" href="{{ asset('images/scholarhub-icon.svg') }}">
```
