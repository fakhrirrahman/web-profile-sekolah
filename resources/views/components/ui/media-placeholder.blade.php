@props([
    'label' => null,
    'ratio' => 'aspect-[16/9]',
])

<div {{ $attributes->merge(['class' => "{$ratio} media-placeholder-bg overflow-hidden rounded-lg"]) }}>
    <div class="relative h-full">
        <div class="absolute inset-x-6 bottom-6 rounded-lg border border-white/70 bg-white/80 p-4 shadow-sm backdrop-blur">
            <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">{{ $label }}</p>
            <div class="mt-3 h-1.5 w-20 rounded-full bg-accent"></div>
        </div>
    </div>
</div>
