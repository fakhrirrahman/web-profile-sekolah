@extends('layouts.app', ['title' => 'Berita - Golden Sierra School'])

@php
    $categories = ['Semua', 'Prestasi', 'Kegiatan', 'Akademik', 'Info Orang Tua'];

    $featured = [
        'title' => 'Siswa Golden Sierra Raih Juara LKBB Tingkat Kota',
        'date' => '11 Juni 2026',
        'category' => 'Prestasi',
        'copy' => 'Tim siswa Golden Sierra menunjukkan disiplin, kekompakan, dan keberanian saat mengikuti lomba tingkat kota.',
    ];

    $articles = [
        ['title' => 'Kegiatan Literasi Pagi Dorong Budaya Membaca', 'date' => '9 Juni 2026', 'category' => 'Kegiatan', 'copy' => 'Program literasi pagi membantu siswa membangun kebiasaan membaca secara ringan dan konsisten.'],
        ['title' => 'Jadwal Asesmen Tengah Semester Telah Dibagikan', 'date' => '22 Juli 2026', 'category' => 'Akademik', 'copy' => 'Orang tua dapat melihat jadwal asesmen melalui wali kelas dan kanal komunikasi sekolah.'],
        ['title' => 'Pengambilan Seragam dan Buku Paket', 'date' => '27 Juli 2026', 'category' => 'Info Orang Tua', 'copy' => 'Sekolah menyiapkan jadwal pengambilan bertahap agar proses tetap tertib dan nyaman.'],
        ['title' => 'Ekskul Robotik Memulai Proyek Semester Baru', 'date' => '3 Agustus 2026', 'category' => 'Kegiatan', 'copy' => 'Siswa belajar mengenal logika, rangkaian sederhana, dan kebiasaan menyelesaikan masalah.'],
    ];
@endphp

@section('content')
    <section class="bg-surface py-14 md:py-20">
        <div class="section-shell grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">
            <div class="js-reveal">
                <p class="inline-flex rounded-lg border-2 border-primary/20 bg-white px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[3px_3px_0_rgba(31,92,69,.10)]">Berita Sekolah</p>
                <h1 class="mt-5 max-w-3xl text-4xl font-black leading-tight text-primary md:text-5xl">Kabar terbaru dari kegiatan dan prestasi Golden Sierra.</h1>
                <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600">Temukan pengumuman, agenda, dan cerita kegiatan sekolah dalam format yang mudah dipindai oleh siswa maupun orang tua.</p>
            </div>

            <form action="#" class="motion-card js-card rounded-lg border-2 border-primary/15 bg-white p-4 shadow-[6px_6px_0_rgba(31,92,69,.10)]">
                <label for="news-search" class="sr-only">Cari berita</label>
                <div class="flex overflow-hidden rounded-lg border-2 border-primary/20 bg-surface">
                    <input id="news-search" type="search" placeholder="Cari berita atau pengumuman" class="min-w-0 flex-1 bg-transparent px-4 py-3 text-sm outline-none placeholder:text-slate-400">
                    <button type="submit" class="bg-primary px-5 text-sm font-black text-white transition hover:bg-primary-dark">Cari</button>
                </div>
            </form>
        </div>
    </section>

    <section class="bg-white py-16 md:py-24">
        <div class="section-shell">
            <div class="js-stagger flex flex-wrap gap-3">
                @foreach ($categories as $category)
                    <button type="button" class="js-card rounded-lg border-2 px-4 py-2 text-xs font-black uppercase tracking-wide transition {{ $loop->first ? 'border-primary bg-primary text-white shadow-[3px_3px_0_rgba(217,180,92,.35)]' : 'border-primary/15 bg-surface text-primary hover:bg-secondary-muted' }}">{{ $category }}</button>
                @endforeach
            </div>

            <div class="mt-10 grid gap-8 lg:grid-cols-[minmax(0,1fr)_360px] lg:items-start">
                <article class="motion-card js-reveal rounded-lg border-2 border-primary/15 bg-surface p-6 shadow-[6px_6px_0_rgba(31,92,69,.10)] md:p-8">
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">{{ $featured['category'] }}</p>
                    <h2 class="mt-4 text-3xl font-black leading-tight text-primary">{{ $featured['title'] }}</h2>
                    <p class="mt-3 text-sm font-bold uppercase tracking-wide text-slate-500">{{ $featured['date'] }}</p>
                    <p class="mt-5 text-base leading-8 text-slate-600">{{ $featured['copy'] }}</p>
                    <x-ui.button href="#" variant="accent" class="mt-7">Baca Berita Utama</x-ui.button>
                </article>

                <aside class="rounded-lg border-2 border-primary/15 bg-white p-6 shadow-[5px_5px_0_rgba(31,92,69,.08)]">
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Pengumuman Cepat</p>
                    <div class="mt-5 grid gap-4">
                        <div class="rounded-lg bg-surface p-4">
                            <p class="text-sm font-black text-primary">PPDB 2026/2027</p>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Pendaftaran reguler dibuka setiap hari kerja.</p>
                        </div>
                        <div class="rounded-lg bg-accent p-4 text-primary">
                            <p class="text-sm font-black">Konsultasi Orang Tua</p>
                            <p class="mt-2 text-sm font-semibold leading-6">Hubungi admin sekolah untuk jadwal kunjungan.</p>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="js-stagger mt-10 grid gap-5">
                @foreach ($articles as $article)
                    <article class="motion-card js-card rounded-lg border-2 border-primary/12 bg-white p-5 shadow-[4px_4px_0_rgba(31,92,69,.08)] transition">
                        <div class="grid gap-5 md:grid-cols-[180px_minmax(0,1fr)_auto] md:items-center">
                            <div class="media-placeholder-bg aspect-[4/3] rounded-lg"></div>
                            <div>
                                <div class="flex flex-wrap items-center gap-2 text-xs font-black uppercase tracking-wide">
                                    <span class="rounded-md bg-secondary-muted px-2.5 py-1 text-secondary">{{ $article['category'] }}</span>
                                    <span class="text-slate-500">{{ $article['date'] }}</span>
                                </div>
                                <h3 class="mt-3 text-xl font-black leading-tight text-primary">{{ $article['title'] }}</h3>
                                <p class="mt-3 text-sm leading-7 text-slate-600">{{ $article['copy'] }}</p>
                            </div>
                            <x-ui.button href="#" variant="outline" size="sm">Detail</x-ui.button>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
