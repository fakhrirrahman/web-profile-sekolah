@extends('layouts.app', ['title' => 'Golden Sierra School'])

@php
    $quickLinks = [
        ['title' => 'Profil Sekolah', 'copy' => 'Kenali visi, misi, dan budaya belajar Golden Sierra.', 'href' => '#profil', 'icon' => '01'],
        ['title' => 'PPDB 2026', 'copy' => 'Informasi jadwal, alur pendaftaran, dan persyaratan.', 'href' => '#ppdb', 'icon' => '02'],
        ['title' => 'Prestasi', 'copy' => 'Lihat pencapaian siswa di bidang akademik dan minat bakat.', 'href' => '#prestasi', 'icon' => '03'],
        ['title' => 'Galeri', 'copy' => 'Dokumentasi kegiatan belajar, lomba, dan keseharian sekolah.', 'href' => '#galeri', 'icon' => '04'],
    ];

    $announcements = [
        ['title' => 'PPDB Tahun Ajaran 2026/2027', 'date' => '16 Juli 2026', 'type' => 'Pendaftaran'],
        ['title' => 'Jadwal Asesmen Tengah Semester', 'date' => '22 Juli 2026', 'type' => 'Akademik'],
        ['title' => 'Pengambilan Seragam dan Buku Paket', 'date' => '27 Juli 2026', 'type' => 'Info Orang Tua'],
    ];

    $features = [
        ['title' => 'Kelas Aktif', 'copy' => 'Pembelajaran dirancang interaktif agar siswa terbiasa bertanya, berdiskusi, dan menyampaikan ide.'],
        ['title' => 'Karakter Kuat', 'copy' => 'Rutinitas sekolah membantu siswa membangun disiplin, empati, dan tanggung jawab.'],
        ['title' => 'Pendampingan Dekat', 'copy' => 'Wali kelas dan guru membimbing perkembangan akademik maupun sosial siswa secara berkala.'],
    ];

    $achievements = [
        ['title' => 'Juara 1 Lomba LKBB', 'date' => '11 Juni 2026', 'category' => 'Prestasi'],
        ['title' => 'Juara 1 Lomba Sandi Morse', 'date' => '11 Juni 2026', 'category' => 'Prestasi'],
    ];

    $extracurriculars = [
        ['title' => 'Pramuka', 'copy' => 'Melatih kemandirian, kepemimpinan, dan kerja sama.'],
        ['title' => 'Basket', 'copy' => 'Mengasah sportivitas, strategi, dan stamina siswa.'],
        ['title' => 'Paduan Suara', 'copy' => 'Ruang berekspresi melalui olah vokal dan penampilan.'],
        ['title' => 'Robotik', 'copy' => 'Mengenalkan logika, eksperimen, dan pemecahan masalah.'],
    ];

    $gallery = ['Kelas Interaktif', 'Perpustakaan', 'Lapangan Sekolah', 'Laboratorium'];

    $news = [
        ['title' => 'Siswa Golden Sierra Raih Juara LKBB Tingkat Kota', 'date' => '11 Juni 2026', 'category' => 'Berita'],
        ['title' => 'Kegiatan Literasi Pagi Dorong Budaya Membaca', 'date' => '9 Juni 2026', 'category' => 'Kegiatan'],
    ];
@endphp

@section('content')
    <section id="beranda" class="relative isolate bg-primary text-white">
        <img src="{{ asset('images/home.jpg') }}" alt="Gedung Golden Sierra School" class="js-hero-image absolute inset-0 -z-20 h-full w-full object-cover">
        <div class="hero-overlay absolute inset-0 -z-10"></div>

        <div class="section-shell grid min-h-[560px] items-center gap-10 pb-28 pt-14 md:min-h-[620px] lg:min-h-[660px] lg:grid-cols-[minmax(0,1fr)_360px] lg:pb-32 lg:pt-16">
            <div class="max-w-3xl">
                <p class="js-hero-item inline-flex rounded-lg border border-white/15 bg-white/10 px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-accent backdrop-blur">
                    PPDB 2026/2027 sudah dibuka
                </p>
                <h1 class="js-hero-item mt-6 text-4xl font-black leading-tight text-white md:text-5xl xl:text-6xl">
                    Sekolah yang membantu anak belajar percaya diri, tertib, dan berani bertumbuh.
                </h1>
                <p class="js-hero-item mt-6 max-w-2xl text-base leading-8 text-white/78 md:text-lg">
                    Golden Sierra School menghadirkan pengalaman belajar yang hangat, terarah, dan dekat dengan kebutuhan siswa serta orang tua.
                </p>

                <div class="js-hero-item mt-8 flex flex-col gap-3 sm:flex-row">
                    <x-ui.button href="#ppdb" variant="accent" size="lg">Daftar PPDB</x-ui.button>
                    <x-ui.button href="#profil" variant="muted" size="lg">Lihat Profil Sekolah</x-ui.button>
                </div>

                <form action="#" class="js-hero-item mt-8 flex max-w-2xl overflow-hidden rounded-lg border border-white/15 bg-white shadow-xl">
                    <label for="school-search" class="sr-only">Cari informasi sekolah</label>
                    <input id="school-search" type="search" placeholder="Cari pengumuman, berita, atau kegiatan sekolah" class="min-w-0 flex-1 border-0 bg-transparent px-5 py-4 text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    <button type="submit" class="grid w-14 place-items-center bg-accent text-primary transition hover:bg-accent-muted" aria-label="Cari">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="m21 21-4.35-4.35"></path>
                            <circle cx="11" cy="11" r="7"></circle>
                        </svg>
                    </button>
                </form>
            </div>

            <div class="js-hero-panel hidden rounded-lg border border-white/15 bg-white/10 p-5 backdrop-blur lg:block">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-accent">Info Hari Ini</p>
                <div class="mt-5 grid gap-4">
                    <div class="rounded-lg bg-white p-4 text-foreground">
                        <p class="text-sm font-black text-primary">Jalur pendaftaran reguler</p>
                        <p class="mt-2 text-sm leading-6 text-slate-600">Konsultasi dan pendaftaran tersedia setiap hari kerja pukul 08.00 - 15.00 WIB.</p>
                    </div>
                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div class="rounded-lg bg-white/12 p-3">
                            <p class="text-2xl font-black">24</p>
                            <p class="mt-1 text-[11px] font-bold uppercase tracking-wide text-white/70">Guru</p>
                        </div>
                        <div class="rounded-lg bg-white/12 p-3">
                            <p class="text-2xl font-black">12</p>
                            <p class="mt-1 text-[11px] font-bold uppercase tracking-wide text-white/70">Ekskul</p>
                        </div>
                        <div class="rounded-lg bg-white/12 p-3">
                            <p class="text-2xl font-black">98%</p>
                            <p class="mt-1 text-[11px] font-bold uppercase tracking-wide text-white/70">Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-10 bg-surface py-10">
        <div class="js-stagger section-shell -mt-16 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($quickLinks as $link)
                <a href="{{ $link['href'] }}" class="motion-card js-card group rounded-lg border border-slate-200 bg-white p-5 shadow-lg shadow-primary/5 transition hover:border-secondary/40">
                    <div class="flex items-start justify-between gap-4">
                        <span class="grid size-10 place-items-center rounded-lg bg-secondary-muted text-xs font-black text-secondary">{{ $link['icon'] }}</span>
                        <span class="text-secondary transition group-hover:translate-x-1" aria-hidden="true">-&gt;</span>
                    </div>
                    <h2 class="mt-5 text-base font-black text-primary">{{ $link['title'] }}</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $link['copy'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section id="profil" class="js-reveal bg-surface py-16 md:py-24">
        <div class="section-shell grid gap-12 lg:grid-cols-[minmax(0,1.05fr)_minmax(340px,0.95fr)] lg:items-start">
            <div>
                <x-ui.section-heading eyebrow="Profil Sekolah" title="Lingkungan belajar yang rapi, hangat, dan berorientasi pada karakter." align="left">
                    Kami percaya sekolah terbaik adalah tempat anak merasa aman untuk mencoba, berani bertanya, dan terbiasa menyelesaikan tanggung jawabnya dengan baik.
                </x-ui.section-heading>

                <div class="mt-10 grid gap-6 md:grid-cols-2">
                    <x-ui.media-placeholder label="Tentang Golden Sierra" ratio="aspect-[4/3]" />
                    <div class="motion-card js-card rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-black text-primary">Belajar dengan ritme yang jelas.</h3>
                        <p class="mt-4 text-sm leading-7 text-slate-600">
                            Golden Sierra School menyusun kegiatan akademik, pembiasaan karakter, dan eksplorasi minat dalam alur harian yang mudah diikuti siswa.
                        </p>
                        <x-ui.button href="#" variant="outline" size="sm" class="mt-6">Baca Profil</x-ui.button>
                    </div>
                </div>
            </div>

            <aside id="ppdb" class="motion-card js-card rounded-lg border border-primary/10 bg-white p-6 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Pengumuman</p>
                <h2 class="mt-3 text-2xl font-black leading-tight text-primary">Informasi penting untuk orang tua dan siswa.</h2>
                <div class="mt-6 grid gap-4">
                    @foreach ($announcements as $item)
                        <article class="rounded-lg border border-slate-200 p-4">
                            <div class="flex flex-wrap items-center gap-2 text-[11px] font-bold uppercase tracking-wide">
                                <span class="rounded-md bg-secondary-muted px-2.5 py-1 text-secondary">{{ $item['type'] }}</span>
                                <span class="text-slate-500">{{ $item['date'] }}</span>
                            </div>
                            <h3 class="mt-3 text-sm font-black leading-6 text-primary">{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
                <x-ui.button href="#" variant="secondary" class="mt-6 w-full">Lihat Semua Pengumuman</x-ui.button>
            </aside>
        </div>
    </section>

    <section class="js-reveal bg-white py-16 md:py-24">
        <div class="section-shell">
            <x-ui.section-heading eyebrow="Kenapa Golden Sierra" title="Detail kecil yang membuat kegiatan sekolah terasa nyaman." />

            <div class="js-stagger mt-12 grid gap-5 md:grid-cols-3">
                @foreach ($features as $feature)
                    <article class="motion-card js-card rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="h-1.5 w-14 rounded-full bg-accent"></div>
                        <h3 class="mt-6 text-lg font-black text-primary">{{ $feature['title'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $feature['copy'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="prestasi" class="js-reveal bg-primary py-16 text-white md:py-24">
        <div class="section-shell">
            <x-ui.section-heading eyebrow="Prestasi Terbaru" title="Ruang apresiasi untuk keberanian dan kerja keras siswa." light>
                Prestasi kami tampilkan sebagai catatan proses, bukan hanya hasil akhir. Setiap lomba adalah kesempatan belajar.
            </x-ui.section-heading>

            <div class="js-stagger mt-12 grid gap-5">
                @foreach ($achievements as $achievement)
                    <x-ui.article-row :title="$achievement['title']" :date="$achievement['date']" :category="$achievement['category']" image-label="Prestasi" />
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                <x-ui.button href="#" variant="accent">Lihat Semua Prestasi</x-ui.button>
            </div>
        </div>
    </section>

    <section class="js-reveal bg-surface py-16 md:py-24">
        <div class="section-shell">
            <x-ui.section-heading eyebrow="Ekstrakurikuler" title="Pilihan kegiatan untuk menemukan minat dan membangun percaya diri." />

            <div class="js-stagger mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($extracurriculars as $item)
                    <article class="motion-card js-card group rounded-lg border border-slate-200 bg-white p-4 shadow-sm transition hover:border-secondary/40">
                        <x-ui.media-placeholder :label="$item['title']" ratio="aspect-[4/3]" class="rounded-lg" />
                        <h3 class="mt-5 text-base font-black text-primary">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">{{ $item['copy'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="galeri" class="js-reveal bg-white py-16 md:py-24">
        <div class="section-shell">
            <div class="grid gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-end">
                <x-ui.section-heading eyebrow="Galeri Sekolah" title="Potongan keseharian Golden Sierra School." align="left">
                    Tampilkan dokumentasi kegiatan belajar, lomba, pentas seni, kunjungan, dan momen penting sekolah di area ini.
                </x-ui.section-heading>
                <div class="flex justify-start lg:justify-end">
                    <x-ui.button href="#" variant="outline">Buka Galeri</x-ui.button>
                </div>
            </div>

            <div class="js-stagger mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="lg:col-span-2 lg:row-span-2">
                    <div class="motion-card js-card group relative aspect-[4/3] h-full overflow-hidden rounded-lg">
                        <img src="{{ asset('images/home.jpg') }}" alt="Area sekolah Golden Sierra" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                        <div class="absolute inset-x-5 bottom-5 rounded-lg bg-white/90 p-4 shadow-sm backdrop-blur">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Highlight</p>
                            <h3 class="mt-2 text-lg font-black text-primary">Lingkungan sekolah yang terbuka dan aktif.</h3>
                        </div>
                    </div>
                </div>
                @foreach ($gallery as $item)
                    <x-ui.media-placeholder class="js-card" :label="$item" ratio="aspect-[4/3]" />
                @endforeach
            </div>
        </div>
    </section>

    <section id="berita" class="js-reveal bg-surface py-16 md:py-24">
        <div class="section-shell">
            <x-ui.section-heading eyebrow="Berita Terbaru" title="Kabar terbaru dari kegiatan dan prestasi sekolah." />

            <div class="js-stagger mt-12 grid gap-5">
                @foreach ($news as $item)
                    <x-ui.article-row :title="$item['title']" :date="$item['date']" :category="$item['category']" image-label="Berita" />
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                <x-ui.button href="#" variant="outline">Lihat Semua Berita</x-ui.button>
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="motion-card js-reveal section-shell rounded-lg bg-secondary p-8 text-white shadow-sm md:p-10">
            <div class="grid gap-8 md:grid-cols-[1fr_auto] md:items-center">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-accent">PPDB Golden Sierra</p>
                    <h2 class="mt-3 text-2xl font-black leading-tight md:text-4xl">Siapkan langkah pertama anak bersama Golden Sierra School.</h2>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-white/78">
                        Hubungi admin sekolah untuk konsultasi kelas, jadwal kunjungan, dan alur pendaftaran terbaru.
                    </p>
                </div>
                <x-ui.button href="#kontak" variant="accent" size="lg">Hubungi Sekolah</x-ui.button>
            </div>
        </div>
    </section>
@endsection
