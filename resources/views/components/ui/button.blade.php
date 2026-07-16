@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg font-bold transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';

    $variants = [
        'primary' => 'bg-primary text-primary-foreground shadow-sm shadow-primary/20 hover:bg-primary-dark',
        'secondary' => 'bg-secondary text-secondary-foreground shadow-sm shadow-secondary/20 hover:bg-secondary-dark',
        'muted' => 'bg-accent-muted text-accent-foreground shadow-sm hover:bg-white',
        'accent' => 'bg-accent text-accent-foreground shadow-sm hover:bg-accent-muted',
        'outline' => 'border border-primary/15 bg-white text-primary shadow-sm hover:border-primary hover:bg-primary hover:text-primary-foreground',
        'ghost' => 'text-secondary hover:bg-secondary/10',
    ];

    $sizes = [
        'sm' => 'h-9 px-4 text-xs uppercase tracking-wide',
        'md' => 'h-10 px-5 text-sm',
        'lg' => 'h-12 px-6 text-sm',
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
