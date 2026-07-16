@props([
    'title',
    'date' => '11 Juni 2026',
    'imageLabel' => null,
    'category' => 'Sekolah',
    'excerpt' => "Golden Sierra School terus mendukung siswa untuk berani tampil, bekerja sama, dan membangun prestasi melalui kegiatan akademik maupun non-akademik.",
])

<article {{ $attributes->merge(['class' => 'motion-card js-card grid gap-6 rounded-lg border border-slate-200 bg-white p-4 shadow-sm transition hover:border-secondary/40 md:grid-cols-[240px_minmax(0,1fr)] md:items-center']) }}>
    <x-ui.media-placeholder :label="$imageLabel" ratio="aspect-[4/3]" class="rounded-lg" />

    <div>
        <div class="flex flex-wrap items-center gap-2 text-[11px] font-bold uppercase tracking-wide text-slate-500">
            <span class="rounded-md bg-secondary-muted px-2.5 py-1 text-secondary">{{ $category }}</span>
            <span>Publish : {{ $date }}</span>
        </div>
        <h3 class="mt-3 text-lg font-black leading-snug text-primary">{{ $title }}</h3>
        <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600">
            {{ $excerpt }}
        </p>
        <x-ui.button href="#" variant="ghost" size="sm" class="mt-4 -ml-4">Baca Selengkapnya</x-ui.button>
    </div>
</article>
