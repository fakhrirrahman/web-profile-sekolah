@props([
    'label' => null,
    'ratio' => 'aspect-[16/9]',
])

<div {{ $attributes->merge(['class' => "{$ratio} overflow-hidden rounded-2xl bg-gradient-to-br from-slate-200 to-slate-300"]) }}>
    <div class="grid h-full place-items-center text-xs font-semibold uppercase tracking-wide text-slate-400">
        {{ $label }}
    </div>
</div>
