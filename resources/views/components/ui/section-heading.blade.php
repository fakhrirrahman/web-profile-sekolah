@props([
    'eyebrow' => null,
    'align' => 'center',
    'light' => false,
])

@php
    $alignment = $align === 'left' ? 'items-start text-left' : 'items-center text-center';
    $textColor = $light ? 'text-white' : 'text-school-navy';
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col {$alignment}"]) }}>
    @if ($eyebrow)
        <p class="text-xs font-black uppercase tracking-wide {{ $textColor }}">{{ $eyebrow }}</p>
    @endif
    <span class="mt-2 h-1 w-12 rounded-full bg-school-gold"></span>
    @if ($slot->isNotEmpty())
        <div class="mt-4 max-w-2xl text-sm leading-6 {{ $light ? 'text-white/80' : 'text-slate-600' }}">
            {{ $slot }}
        </div>
    @endif
</div>
