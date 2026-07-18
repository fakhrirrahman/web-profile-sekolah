@extends('layouts.app', ['title' => 'Berita - Golden Sierra School'])

@section('content')
    <section class="relative isolate bg-primary py-14 text-white md:py-20">
        <img src="{{ asset('images/berita.png') }}" alt="Berita Golden Sierra School" class="js-hero-image absolute inset-0 -z-20 h-full w-full object-cover">
        <div class="hero-overlay absolute inset-0 -z-10"></div>

        <div class="section-shell grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">
            <div class="js-reveal">
                <p class="inline-flex rounded-lg border-2 border-primary/35 bg-accent px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[4px_4px_0_rgba(255,255,255,.20)]">Berita Sekolah</p>
                <h1 class="mt-5 max-w-3xl text-4xl font-black leading-tight text-white md:text-5xl">Kabar terbaru dari kegiatan dan prestasi Golden Sierra.</h1>
                <p class="mt-5 max-w-2xl text-base leading-8 text-white/80">Temukan pengumuman, agenda, dan cerita kegiatan sekolah dalam format yang mudah dipindai oleh siswa maupun orang tua.</p>
            </div>

            <form action="{{ route('berita') }}" method="GET" class="motion-card js-card rounded-lg border-2 border-white/40 bg-white/90 p-4 shadow-[6px_6px_0_rgba(217,180,92,.18)] backdrop-blur">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <label for="news-search" class="sr-only">Cari berita</label>
                <div class="flex overflow-hidden rounded-lg border-2 border-primary/20 bg-surface">
                    <input id="news-search" type="search" name="search" value="{{ $search }}" placeholder="Cari berita atau pengumuman" class="min-w-0 flex-1 bg-transparent px-4 py-3 text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    <button type="submit" class="bg-primary px-5 text-sm font-black text-white transition hover:bg-primary-dark">Cari</button>
                </div>
            </form>
        </div>
    </section>

    <section class="bg-white py-16 md:py-24">
        <div class="section-shell">
            <div class="js-stagger flex flex-wrap gap-3">
                @foreach ($categories as $category)
                    <a href="{{ route('berita', ['category' => $category, 'search' => $search]) }}" class="js-card rounded-lg border-2 px-4 py-2 text-xs font-black uppercase tracking-wide transition {{ $activeCategory === $category ? 'border-primary bg-primary text-white shadow-[3px_3px_0_rgba(217,180,92,.35)]' : 'border-primary/15 bg-surface text-primary hover:bg-secondary-muted' }}">{{ $category }}</a>
                @endforeach
            </div>

            <div class="mt-10 grid gap-8 lg:grid-cols-[minmax(0,1fr)_360px] lg:items-start">
                @if ($featured)
                    <article class="motion-card js-reveal rounded-lg border-2 border-primary/15 bg-surface p-6 shadow-[6px_6px_0_rgba(31,92,69,.10)] md:p-8">
                        <div class="overflow-hidden rounded-lg border-2 border-primary/10 bg-white">
                            @if ($featured->image_url)
                                <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" class="aspect-[16/9] w-full object-cover">
                            @else
                                <div class="media-placeholder-bg aspect-[16/9]"></div>
                            @endif
                        </div>
                        <p class="mt-6 text-xs font-black uppercase tracking-[0.18em] text-secondary">{{ $featured->category }}</p>
                        <h2 class="mt-4 text-3xl font-black leading-tight text-primary">{{ $featured->title }}</h2>
                        <p class="mt-3 text-sm font-bold uppercase tracking-wide text-slate-500">{{ $featured->date }}</p>
                        <p class="mt-5 text-base leading-8 text-slate-600">{{ $featured->copy }}</p>
                        <x-ui.button href="{{ route('berita.show', $featured->slug) }}" variant="accent" class="mt-7">Baca Selengkapnya</x-ui.button>
                    </article>
                @else
                    <div class="rounded-lg border-2 border-dashed border-primary/20 p-12 text-center text-slate-500 font-semibold">
                        Belum ada berita utama yang tersedia.
                    </div>
                @endif

                <aside class="rounded-lg border-2 border-primary/15 bg-white p-6 shadow-[5px_5px_0_rgba(31,92,69,.08)]">
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Pengumuman Cepat</p>
                    <div class="mt-5 grid gap-4">
                        @forelse ($quickAnnouncements as $announcement)
                            <a href="{{ route('pengumuman.show', $announcement->slug) }}" class="block rounded-lg {{ $loop->odd ? 'bg-surface' : 'bg-accent text-primary' }} p-4 transition hover:-translate-y-0.5">
                                <p class="text-[11px] font-black uppercase tracking-wide {{ $loop->odd ? 'text-secondary' : 'text-primary/70' }}">{{ $announcement->category }}</p>
                                <h3 class="mt-2 text-sm font-black text-primary">{{ $announcement->title }}</h3>
                                <p class="mt-2 text-sm {{ $loop->odd ? 'text-slate-600' : 'font-semibold text-primary/80' }} leading-6">{{ $announcement->date }}</p>
                            </a>
                        @empty
                            <div class="rounded-lg border-2 border-dashed border-primary/15 bg-surface p-4 text-sm font-semibold leading-6 text-slate-500">
                                Belum ada pengumuman tambahan untuk filter ini.
                            </div>
                        @endforelse
                    </div>
                </aside>
            </div>

            <div class="js-stagger mt-10 grid gap-5">
                @forelse ($articles as $article)
                    <article class="motion-card js-card rounded-lg border-2 border-primary/12 bg-white p-5 shadow-[4px_4px_0_rgba(31,92,69,.08)] transition">
                        <div class="grid gap-5 md:grid-cols-[180px_minmax(0,1fr)] md:items-center">
                            <div class="overflow-hidden rounded-lg border-2 border-primary/10 bg-surface">
                                @if ($article->image_url)
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="aspect-[4/3] w-full object-cover transition duration-700 hover:scale-105">
                                @else
                                    <div class="media-placeholder-bg aspect-[4/3]"></div>
                                @endif
                            </div>
                            <div>
                                <div class="flex flex-wrap items-center gap-2 text-xs font-black uppercase tracking-wide">
                                    <span class="rounded-md bg-secondary-muted px-2.5 py-1 text-secondary">{{ $article->category }}</span>
                                    <span class="text-slate-500">{{ $article->date }}</span>
                                </div>
                                <h3 class="mt-3 text-xl font-black leading-tight text-primary">{{ $article->title }}</h3>
                                <p class="mt-3 text-sm leading-7 text-slate-600">{{ $article->copy }}</p>
                                <x-ui.button href="{{ route('berita.show', $article->slug) }}" variant="outline" size="sm" class="mt-4">Detail</x-ui.button>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-lg border-2 border-dashed border-primary/20 p-8 text-center text-slate-500 font-semibold">
                        Tidak ada berita lain yang ditemukan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
