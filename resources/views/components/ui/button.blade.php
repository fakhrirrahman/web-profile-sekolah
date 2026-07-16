@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $base = 'inline-flex items-center gap-2 rounded-md font-semibold transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-school-gold focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';

    $variants = [
        'primary' => 'bg-school-teal text-white shadow-sm hover:bg-school-teal-dark',
        'cream' => 'bg-school-cream text-school-navy shadow-sm hover:bg-white',
        'outline' => 'border border-school-teal bg-white text-school-teal hover:bg-school-teal hover:text-white',
        'ghost' => 'text-school-teal hover:bg-school-teal/10',
    ];

    $sizes = [
        'sm' => 'h-9 px-5 text-xs uppercase tracking-wide',
        'md' => 'h-10 px-5 text-sm',
        'lg' => 'h-12 px-7 text-sm',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
