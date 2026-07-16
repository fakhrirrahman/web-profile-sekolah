@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $base = 'motion-button inline-flex items-center justify-center gap-2 rounded-lg border-2 font-black transition-[transform,box-shadow,background-color,color,border-color] duration-200 hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0.5 active:translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';

    $variants = [
        'primary' => 'border-primary bg-primary text-primary-foreground shadow-[3px_3px_0_rgba(49,88,70,.18)] hover:bg-primary hover:shadow-[5px_5px_0_rgba(49,88,70,.15)] active:shadow-[1px_1px_0_rgba(49,88,70,.18)]',
        'secondary' => 'border-secondary-dark bg-secondary text-secondary-foreground shadow-[3px_3px_0_rgba(122,166,141,.20)] hover:bg-secondary hover:shadow-[5px_5px_0_rgba(122,166,141,.16)] active:shadow-[1px_1px_0_rgba(122,166,141,.20)]',
        'muted' => 'border-primary/35 bg-white text-primary shadow-[3px_3px_0_rgba(122,166,141,.16)] hover:border-secondary hover:bg-secondary-muted hover:shadow-[5px_5px_0_rgba(122,166,141,.14)] active:shadow-[1px_1px_0_rgba(122,166,141,.16)]',
        'accent' => 'border-primary bg-primary text-primary-foreground shadow-[3px_3px_0_rgba(49,88,70,.14)] hover:bg-primary-dark hover:shadow-[5px_5px_0_rgba(49,88,70,.13)] active:shadow-[1px_1px_0_rgba(49,88,70,.14)]',
        'outline' => 'border-primary/50 bg-white text-primary shadow-[3px_3px_0_rgba(122,166,141,.13)] hover:border-secondary hover:bg-secondary-muted hover:text-primary hover:shadow-[5px_5px_0_rgba(122,166,141,.12)] active:shadow-[1px_1px_0_rgba(122,166,141,.13)]',
        'ghost' => 'border-transparent text-secondary shadow-none hover:translate-x-0 hover:-translate-y-0.5 hover:bg-secondary/10',
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
