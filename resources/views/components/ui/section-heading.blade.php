@props([
    'eyebrow' => null,
    'title' => null,
    'align' => 'center',
    'light' => false,
])

@php
    $alignment = $align === 'left' ? 'items-start text-left' : 'items-center text-center';
    $textColor = $light ? 'text-white' : 'text-primary';
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col {$alignment}"]) }}>
    @if ($eyebrow)
        <p class="text-xs font-black uppercase tracking-[0.18em] {{ $light ? 'text-accent' : 'text-secondary' }}">{{ $eyebrow }}</p>
    @endif
    @if ($title)
        <h2 class="mt-3 max-w-3xl text-2xl font-black leading-tight {{ $textColor }} md:text-4xl">{{ $title }}</h2>
    @endif
    <span class="mt-4 h-1 w-14 rounded-full bg-accent"></span>
    @if ($slot->isNotEmpty())
        <div class="mt-5 max-w-2xl text-sm leading-7 md:text-base {{ $light ? 'text-white/80' : 'text-slate-600' }}">
            {{ $slot }}
        </div>
    @endif
</div>
