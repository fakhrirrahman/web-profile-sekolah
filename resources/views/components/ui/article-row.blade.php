@props([
    'title',
    'date' => '11 Juni 2026',
    'imageLabel' => null,
])

<article {{ $attributes->merge(['class' => 'grid gap-6 md:grid-cols-[minmax(0,1.05fr)_minmax(280px,0.95fr)] md:items-center']) }}>
    <x-ui.media-placeholder :label="$imageLabel" class="min-h-48" />

    <div>
        <h3 class="text-sm font-black text-school-navy">{{ $title }}</h3>
        <p class="mt-1 text-[11px] font-bold text-slate-500">Publish : {{ $date }}</p>
        <p class="mt-6 max-w-xl text-sm leading-7 text-slate-600">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since 1966, when designers at Letraset and James Mosley.
        </p>
        <x-ui.button href="#" size="sm" class="mt-4">Baca Selengkapnya</x-ui.button>
    </div>
</article>
