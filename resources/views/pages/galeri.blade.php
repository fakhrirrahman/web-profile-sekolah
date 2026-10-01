@extends('layouts.app', ['title' => 'Galeri - SD Muhammadiyah Pepe'])

@section('content')
    <section class="bg-surface py-14 md:py-20">
        <div class="section-shell grid gap-10 lg:grid-cols-[1fr_360px] lg:items-end">
            <div class="js-reveal">
                <p class="inline-flex rounded-lg border-2 border-primary/20 bg-white px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[3px_3px_0_rgba(31,92,69,.10)]">Galeri Sekolah</p>
                <h1 class="mt-5 max-w-3xl text-4xl font-black leading-tight text-primary md:text-5xl">Potongan keseharian SD Muhammadiyah Pepe.</h1>
                <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600">Galeri dibuat sederhana agar orang tua mudah melihat suasana belajar, kegiatan siswa, dan fasilitas sekolah.</p>
            </div>

            <div class="motion-card js-card rounded-lg border-2 border-primary/15 bg-white p-5 shadow-[6px_6px_0_rgba(31,92,69,.10)]">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Total Dokumentasi</p>
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <div class="rounded-lg bg-surface p-4">
                        <p class="text-3xl font-black text-primary">{{ $totalPhotos }}</p>
                        <p class="text-xs font-black uppercase text-secondary">Foto</p>
                    </div>
                    <div class="rounded-lg bg-accent p-4 text-primary">
                        <p class="text-3xl font-black">{{ $totalAlbums }}</p>
                        <p class="text-xs font-black uppercase">Album</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 md:py-24">
        <div class="section-shell">
            <x-ui.section-heading eyebrow="Album" title="Pilih dokumentasi berdasarkan kegiatan." />

            <div class="js-stagger mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($albums as $album)
                    <a href="{{ route('galeri', ['album' => $album['active'] ? null : $album['title']]) }}" class="motion-card js-card rounded-lg border-2 p-5 shadow-[4px_4px_0_rgba(31,92,69,.08)] block transition {{ $album['active'] ? 'border-primary bg-primary/5 shadow-[4px_4px_0_rgba(31,92,69,.12)]' : 'border-primary/15 bg-surface text-primary hover:bg-secondary-muted' }}">
                        <div class="flex items-start justify-between gap-4">
                            <span class="rounded-md bg-white px-3 py-1 text-xs font-black uppercase text-secondary">{{ $album['count'] }}</span>
                            <x-ui.icon name="arrow-right" class="size-5 text-primary transition duration-300 {{ $album['active'] ? 'rotate-90' : '' }}" />
                        </div>
                        <h2 class="mt-8 text-xl font-black text-primary">{{ $album['title'] }}</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $album['copy'] }}</p>
                    </a>
                @endforeach
            </div>

            <div class="mt-16 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($galleryItems as $item)
                    @php
                        $isFeatured = $loop->first;
                    @endphp

                    <article class="motion-card js-reveal group overflow-hidden rounded-lg border-2 border-primary/15 bg-white shadow-[5px_5px_0_rgba(31,92,69,.10)] {{ $isFeatured ? 'sm:col-span-2 lg:row-span-2' : '' }}">
                        <div class="relative {{ $isFeatured ? 'h-full min-h-[360px]' : 'aspect-[4/3]' }}">
                            @if ($item->image_url)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            @else
                                <div class="h-full w-full motion-media media-placeholder-bg"></div>
                            @endif

                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-primary/85 via-primary/45 to-transparent p-4 text-white">
                                <span class="inline-flex rounded-md bg-white/90 px-2.5 py-1 text-[11px] font-black uppercase text-primary">{{ $item->album }}</span>
                                <h2 class="mt-2 text-base font-black {{ $isFeatured ? 'md:text-2xl' : '' }}">{{ $item->title }}</h2>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-lg border-2 border-dashed border-primary/20 p-8 text-center text-slate-500 font-semibold">
                        Tidak ada foto dalam album ini.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
