@extends('layouts.app', ['title' => 'Galeri - Golden Sierra School'])

@section('content')
    <section class="bg-surface py-14 md:py-20">
        <div class="section-shell grid gap-10 lg:grid-cols-[1fr_360px] lg:items-end">
            <div class="js-reveal">
                <p class="inline-flex rounded-lg border-2 border-primary/20 bg-white px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[3px_3px_0_rgba(31,92,69,.10)]">Galeri Sekolah</p>
                <h1 class="mt-5 max-w-3xl text-4xl font-black leading-tight text-primary md:text-5xl">Potongan keseharian Golden Sierra School.</h1>
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
                <div class="motion-card js-reveal overflow-hidden rounded-lg border-2 border-primary/15 bg-white shadow-[5px_5px_0_rgba(31,92,69,.10)] sm:col-span-2 lg:row-span-2">
                    <img src="{{ asset('images/home.jpg') }}" alt="Lingkungan Golden Sierra School" class="h-full min-h-[360px] w-full object-cover">
                </div>
                @forelse ($galleryItems as $item)
                    <x-ui.media-placeholder :label="$item->title" ratio="aspect-[4/3]" class="motion-card" />
                @empty
                    <div class="col-span-full rounded-lg border-2 border-dashed border-primary/20 p-8 text-center text-slate-500 font-semibold">
                        Tidak ada foto dalam album ini.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
