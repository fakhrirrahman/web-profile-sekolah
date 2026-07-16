@extends('layouts.app', ['title' => 'PPDB - Golden Sierra School'])

@php
    $steps = [
        ['title' => 'Konsultasi Awal', 'copy' => 'Orang tua menghubungi admin untuk memilih jenjang dan jadwal kunjungan.'],
        ['title' => 'Isi Formulir', 'copy' => 'Data calon siswa dan orang tua dikumpulkan melalui formulir pendaftaran.'],
        ['title' => 'Observasi Siswa', 'copy' => 'Sekolah mengenal kebutuhan dan kesiapan belajar calon siswa secara ramah.'],
        ['title' => 'Daftar Ulang', 'copy' => 'Orang tua melengkapi berkas dan administrasi setelah dinyatakan diterima.'],
    ];

    $requirements = [
        'Fotokopi akta kelahiran calon siswa.',
        'Fotokopi kartu keluarga.',
        'Pas foto terbaru ukuran 3x4.',
        'Rapor atau dokumen belajar dari sekolah sebelumnya.',
        'Formulir pendaftaran yang sudah diisi lengkap.',
    ];

    $schedule = [
        ['label' => 'Pendaftaran Reguler', 'date' => '16 Juli - 30 Agustus 2026'],
        ['label' => 'Observasi Siswa', 'date' => 'Setiap Selasa dan Kamis'],
        ['label' => 'Pengumuman', 'date' => 'Maksimal 3 hari kerja setelah observasi'],
    ];
@endphp

@section('content')
    <section class="bg-surface py-14 md:py-20">
        <div class="section-shell grid gap-10 lg:grid-cols-[minmax(0,1fr)_390px] lg:items-center">
            <div class="js-reveal">
                <p class="inline-flex rounded-lg border-2 border-primary/20 bg-accent px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[3px_3px_0_rgba(31,92,69,.12)]">PPDB 2026/2027</p>
                <h1 class="mt-5 max-w-3xl text-4xl font-black leading-tight text-primary md:text-5xl">Siapkan langkah pertama anak bersama Golden Sierra School.</h1>
                <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600">Halaman ini merangkum alur, jadwal, dan persyaratan pendaftaran agar orang tua dapat mengambil keputusan dengan tenang.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <x-ui.button href="{{ url('/kontak') }}" variant="accent" size="lg">Hubungi Admin</x-ui.button>
                    <x-ui.button href="#alur-ppdb" variant="muted" size="lg">Lihat Alur</x-ui.button>
                </div>
            </div>

            <aside class="motion-card js-card rounded-lg border-2 border-primary/15 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.10)]">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Status Pendaftaran</p>
                <h2 class="mt-3 text-2xl font-black leading-tight text-primary">Pendaftaran reguler sedang dibuka.</h2>
                <p class="mt-4 text-sm leading-7 text-slate-600">Layanan konsultasi tersedia hari kerja pukul 08.00 - 15.00 WIB.</p>
                <div class="mt-6 rounded-lg bg-accent p-4 text-primary">
                    <p class="text-3xl font-black">30 Agustus</p>
                    <p class="mt-1 text-xs font-black uppercase tracking-wide">Batas Gelombang Reguler</p>
                </div>
            </aside>
        </div>
    </section>

    <section id="alur-ppdb" class="bg-white py-16 md:py-24">
        <div class="section-shell">
            <x-ui.section-heading eyebrow="Alur PPDB" title="Empat langkah sederhana dari konsultasi sampai daftar ulang." />

            <div class="js-stagger mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($steps as $step)
                    <article class="motion-card js-card rounded-lg border-2 border-primary/15 bg-surface p-5 shadow-[4px_4px_0_rgba(31,92,69,.08)]">
                        <span class="grid size-10 place-items-center rounded-lg bg-accent text-sm font-black text-primary">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h2 class="mt-6 text-xl font-black text-primary">{{ $step['title'] }}</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $step['copy'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-surface py-16 md:py-24">
        <div class="section-shell grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="motion-card js-reveal rounded-lg border-2 border-primary/15 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.10)]">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Jadwal</p>
                <div class="mt-6 grid gap-4">
                    @foreach ($schedule as $item)
                        <div class="rounded-lg bg-surface p-4">
                            <p class="text-sm font-black text-primary">{{ $item['label'] }}</p>
                            <p class="mt-1 text-sm leading-6 text-slate-600">{{ $item['date'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="motion-card js-reveal rounded-lg border-2 border-primary/15 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.10)]">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Persyaratan</p>
                <h2 class="mt-3 text-2xl font-black leading-tight text-primary">Berkas yang perlu disiapkan.</h2>
                <ul class="mt-6 grid gap-3">
                    @foreach ($requirements as $requirement)
                        <li class="flex gap-3 text-sm leading-7 text-slate-600">
                            <span class="mt-2 size-2 shrink-0 rounded-full bg-accent"></span>
                            <span>{{ $requirement }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection
