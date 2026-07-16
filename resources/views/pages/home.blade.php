@extends('layouts.app', ['title' => 'Golden Sierra School'])

@php
    $announcements = [
        [
            'title' => 'Profil Golden Sierra School',
            'copy' => 'Golden Sierra School menghadirkan lingkungan belajar yang aman, modern, dan berkarakter. Kami mendampingi siswa agar percaya diri, disiplin, dan siap menghadapi tantangan masa depan.',
            'label' => 'Profil',
        ],
        [
            'title' => 'Pengumuman PPDB Tahun Ajaran Baru',
            'copy' => 'Pendaftaran peserta didik baru telah dibuka. Calon siswa dapat melihat informasi jadwal seleksi, persyaratan dokumen, dan alur pendaftaran melalui halaman PPDB.',
            'label' => 'PPDB',
        ],
    ];

    $achievements = [
        ['title' => 'Juara 1 Lomba LKBB', 'date' => '11 Juni 2026'],
        ['title' => 'Juara 1 Lomba Sandi Morse', 'date' => '11 Juni 2026'],
    ];

    $extracurriculars = ['Pramuka', 'Basket', 'Paduan Suara', 'Robotik'];

    $gallery = ['Kegiatan Belajar', 'Laboratorium', 'Perpustakaan', 'Lapangan'];

    $news = [
        ['title' => 'Juara 1 Lomba LKBB', 'date' => '11 Juni 2026'],
        ['title' => 'Juara 1 Lomba Sandi Morse', 'date' => '11 Juni 2026'],
    ];
@endphp

@section('content')
    <section id="beranda" class="relative isolate min-h-[420px] overflow-hidden bg-school-teal md:min-h-[470px]">
        <img src="{{ asset('images/home.jpg') }}" alt="Gedung Golden Sierra School" class="absolute inset-0 -z-20 h-full w-full object-cover">
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-school-teal/70 via-white/15 to-school-teal/35"></div>

        <div class="mx-auto flex min-h-[420px] max-w-7xl items-center px-6 py-16 md:min-h-[470px] lg:px-8">
            <button class="absolute left-4 top-1/2 hidden size-11 -translate-y-1/2 place-items-center rounded-full bg-school-teal text-white shadow-lg transition hover:bg-school-teal-dark md:grid" aria-label="Slide sebelumnya">
                <span class="text-xl leading-none">&lsaquo;</span>
            </button>
            <button class="absolute right-4 top-1/2 hidden size-11 -translate-y-1/2 place-items-center rounded-full bg-school-teal text-white shadow-lg transition hover:bg-school-teal-dark md:grid" aria-label="Slide berikutnya">
                <span class="text-xl leading-none">&rsaquo;</span>
            </button>

            <div class="max-w-3xl">
                <p class="text-2xl font-black text-white drop-shadow md:text-3xl">Selamat Datang di</p>
                <h1 class="mt-2 text-4xl font-black uppercase leading-tight tracking-wide text-school-navy drop-shadow-sm md:text-5xl">
                    Golden Sierra School
                </h1>

                <form action="#" class="mt-5 flex max-w-xl overflow-hidden rounded-lg bg-white/95 shadow-lg ring-1 ring-black/5">
                    <label for="school-search" class="sr-only">Cari informasi sekolah</label>
                    <input id="school-search" type="search" placeholder="Cari seputar Golden Sierra School disini" class="min-w-0 flex-1 border-0 bg-transparent px-5 py-3 text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    <button type="submit" class="grid w-14 place-items-center text-slate-600 transition hover:bg-slate-100" aria-label="Cari">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="m21 21-4.35-4.35"></path>
                            <circle cx="11" cy="11" r="7"></circle>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section id="profil" class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-6xl px-6 lg:px-8">
            <div class="grid gap-16 lg:grid-cols-2">
                @foreach ($announcements as $item)
                    <div @if ($item['label'] === 'PPDB') id="ppdb" @endif>
                        <x-ui.section-heading :eyebrow="$item['title']" />
                        <div class="mt-10 grid gap-8 md:grid-cols-[minmax(0,1fr)_minmax(260px,0.85fr)] md:items-center lg:grid-cols-1 xl:grid-cols-[minmax(0,1fr)_minmax(260px,0.85fr)]">
                            <x-ui.media-placeholder :label="$item['label']" />
                            <div>
                                <p class="text-sm leading-7 text-slate-600">{{ $item['copy'] }}</p>
                                <x-ui.button href="#" size="sm" class="mt-4">Baca Selengkapnya</x-ui.button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white pb-16 md:pb-20">
        <div class="mx-auto max-w-5xl px-6 lg:px-8">
            <x-ui.section-heading eyebrow="Profil Golden Sierra School" />
            <div class="mt-10 grid gap-10 md:grid-cols-[minmax(0,1.05fr)_minmax(280px,0.95fr)] md:items-center">
                <x-ui.media-placeholder label="Tentang Kami" />
                <div>
                    <p class="text-sm leading-7 text-slate-600">
                        Kami percaya sekolah bukan hanya tempat belajar, tetapi ruang bertumbuh. Golden Sierra School membangun budaya akademik yang hangat, tertib, dan berorientasi pada karakter siswa.
                    </p>
                    <x-ui.button href="#" size="sm" class="mt-4">Baca Selengkapnya</x-ui.button>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-school-teal-light py-16 md:py-20">
        <div class="mx-auto max-w-5xl px-6 lg:px-8">
            <x-ui.section-heading eyebrow="Prestasi Terbaru" />

            <div class="mt-12 grid gap-10">
                @foreach ($achievements as $achievement)
                    <x-ui.article-row :title="$achievement['title']" :date="$achievement['date']" image-label="Prestasi" />
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                <x-ui.button href="#">Baca Selengkapnya</x-ui.button>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <x-ui.section-heading eyebrow="Ekstrakulikuler" />

            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($extracurriculars as $item)
                    <article class="group overflow-hidden rounded-2xl bg-slate-100 shadow-sm ring-1 ring-slate-200/70 transition hover:-translate-y-1 hover:shadow-lg">
                        <x-ui.media-placeholder :label="$item" ratio="aspect-square" class="rounded-none" />
                        <div class="bg-white px-4 py-4">
                            <h3 class="text-sm font-black text-school-navy">{{ $item }}</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Kegiatan pilihan untuk mengasah minat, kerja sama, dan keberanian siswa.</p>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                <x-ui.button href="#">Baca Selengkapnya</x-ui.button>
            </div>
        </div>
    </section>

    <section id="galeri" class="bg-school-teal-light py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($gallery as $item)
                    <x-ui.media-placeholder :label="$item" ratio="aspect-square" />
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                <x-ui.button href="#">Baca Selengkapnya</x-ui.button>
            </div>
        </div>
    </section>

    <section id="berita" class="bg-white py-16 md:py-24">
        <div class="mx-auto max-w-5xl px-6 lg:px-8">
            <x-ui.section-heading eyebrow="Berita Terbaru" />

            <div class="mt-12 grid gap-10">
                @foreach ($news as $item)
                    <x-ui.article-row :title="$item['title']" :date="$item['date']" image-label="Berita" />
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                <x-ui.button href="#">Baca Selengkapnya</x-ui.button>
            </div>
        </div>
    </section>
@endsection
