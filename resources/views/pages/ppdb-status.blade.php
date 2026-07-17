@extends('layouts.app', ['title' => 'Cek Status PPDB - Golden Sierra School'])

@php
    $statusMessages = [
        'baru' => 'Data sudah masuk. Admin akan menghubungi orang tua untuk konfirmasi awal.',
        'dihubungi' => 'Admin sudah menghubungi orang tua. Silakan lanjutkan komunikasi melalui kontak sekolah.',
        'observasi' => 'Pendaftaran masuk tahap observasi. Ikuti jadwal yang sudah diinformasikan admin.',
        'diterima' => 'Selamat, calon siswa dinyatakan diterima. Silakan lanjutkan proses daftar ulang.',
        'ditolak' => 'Mohon hubungi admin sekolah untuk informasi lebih lanjut terkait hasil pendaftaran.',
    ];

    $statusClasses = [
        'baru' => 'bg-blue-50 text-blue-700 border-blue-200',
        'dihubungi' => 'bg-amber-50 text-amber-800 border-amber-200',
        'observasi' => 'bg-secondary-muted text-secondary border-secondary/20',
        'diterima' => 'bg-green-50 text-green-700 border-green-200',
        'ditolak' => 'bg-red-50 text-red-700 border-red-200',
    ];
@endphp

@section('content')
    <section class="relative isolate bg-primary py-12 text-white md:py-16">
        <img src="{{ asset('images/kelas-interaktif.png') }}" alt="Cek status PPDB Golden Sierra School" class="absolute inset-0 -z-20 h-full w-full object-cover">
        <div class="hero-overlay absolute inset-0 -z-10"></div>

        <div class="section-shell">
            <p class="inline-flex rounded-lg border-2 border-primary/35 bg-accent px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[4px_4px_0_rgba(255,255,255,.20)]">Status PPDB</p>
            <div class="mt-5 grid gap-5 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end">
                <div>
                    <h1 class="max-w-3xl text-4xl font-black leading-tight text-white md:text-5xl">Cek hasil dan tindak lanjut pendaftaran.</h1>
                    <p class="mt-4 max-w-2xl text-base leading-8 text-white/80">
                        Masukkan nomor pendaftaran dan nomor WhatsApp yang sama dengan data formulir PPDB.
                    </p>
                </div>
                <x-ui.button href="{{ route('ppdb') }}" variant="muted" size="lg">Kembali ke PPDB</x-ui.button>
            </div>
        </div>
    </section>

    <section class="bg-surface py-12 md:py-16">
        <div class="section-shell grid gap-8 lg:grid-cols-[minmax(0,1fr)_360px] lg:items-start">
            <article class="motion-card js-reveal rounded-lg border-2 border-primary/15 bg-white p-5 shadow-[6px_6px_0_rgba(31,92,69,.10)] md:p-7">
                @if (session('registration_number'))
                    <div class="mb-6 rounded-lg border-2 border-green-200 bg-green-50 p-4 text-green-700">
                        <p class="text-xs font-black uppercase tracking-wide">Pendaftaran berhasil dikirim</p>
                        <p class="mt-2 text-sm font-bold">Nomor pendaftaran: {{ session('registration_number') }}</p>
                        <p class="mt-1 text-xs font-semibold">Isi nomor WhatsApp untuk melihat status terbaru.</p>
                    </div>
                @endif

                <div class="grid gap-6 lg:grid-cols-[0.8fr_1.2fr] lg:items-start">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Cek Data</p>
                        <h2 class="mt-3 text-2xl font-black leading-tight text-primary">Status pendaftaran</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">
                            Nomor pendaftaran diberikan setelah formulir berhasil dikirim.
                        </p>
                    </div>

                    <form action="{{ route('ppdb.status') }}" method="GET" class="grid gap-4">
                        <div>
                            <label for="registration_number" class="text-xs font-black uppercase tracking-wide text-primary">Nomor Pendaftaran</label>
                            <input id="registration_number" name="registration_number" value="{{ old('registration_number', $statusSearch['registration_number'] ?? session('registration_number')) }}" type="text" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-primary {{ $errors->statusLookup->has('registration_number') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" placeholder="PPDB-2026-0001" required>
                            @error('registration_number', 'statusLookup')
                                <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status_phone" class="text-xs font-black uppercase tracking-wide text-primary">Nomor WhatsApp</label>
                            <input id="status_phone" name="phone" value="{{ old('phone', $statusSearch['phone'] ?? '') }}" type="text" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-primary {{ $errors->statusLookup->has('phone') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" placeholder="08123456789" required>
                            @error('phone', 'statusLookup')
                                <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-ui.button type="submit" variant="primary" size="lg" class="w-full sm:w-auto">Cek Status</x-ui.button>
                    </form>
                </div>

                @isset($statusSearch)
                    @if ($statusRegistration)
                        <div class="mt-7 rounded-lg border-2 border-primary/12 bg-surface p-5">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">{{ $statusRegistration->registration_number }}</p>
                                    <h3 class="mt-2 text-2xl font-black leading-tight text-primary">{{ $statusRegistration->student_name }}</h3>
                                    <p class="mt-1 text-sm font-semibold text-slate-500">{{ $statusRegistration->desired_grade }}</p>
                                </div>
                                <span class="inline-flex rounded-full border px-3 py-1.5 text-xs font-black uppercase tracking-wide {{ $statusClasses[$statusRegistration->status] ?? 'border-primary/15 bg-white text-primary' }}">
                                    {{ $statusRegistration->status_label }}
                                </span>
                            </div>

                            <div class="mt-5 border-l-4 border-accent bg-white px-4 py-3">
                                <p class="text-sm font-semibold leading-7 text-slate-600">
                                    {{ $statusMessages[$statusRegistration->status] ?? 'Status pendaftaran sedang diproses oleh admin.' }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="mt-7 rounded-lg border-2 border-red-200 bg-red-50 p-5 text-red-700">
                            <p class="text-sm font-black">Data pendaftaran tidak ditemukan.</p>
                            <p class="mt-1 text-xs font-semibold leading-6">Pastikan nomor pendaftaran dan nomor WhatsApp sama seperti saat mengisi formulir.</p>
                        </div>
                    @endif
                @else
                    <div class="mt-7 rounded-lg border-2 border-dashed border-primary/15 bg-surface p-4">
                        <p class="text-sm font-semibold leading-6 text-slate-500">
                            Hasil status akan muncul di sini setelah data pendaftaran dicek.
                        </p>
                    </div>
                @endisset
            </article>

            <aside class="js-stagger grid gap-4">
                <div class="js-card overflow-hidden rounded-lg border-2 border-primary/15 bg-white shadow-[5px_5px_0_rgba(31,92,69,.08)]">
                    <img src="{{ asset('images/kegiatan-literasi.png') }}" alt="Kegiatan siswa Golden Sierra" class="aspect-[16/10] w-full object-cover">
                    <div class="p-5">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Cara Mengecek</p>
                        <div class="mt-4 grid gap-3">
                            <div class="flex gap-3 text-sm leading-6 text-slate-600">
                                <span class="grid size-7 shrink-0 place-items-center rounded-lg bg-accent text-xs font-black text-primary">1</span>
                                <span>Ambil nomor pendaftaran dari pesan setelah submit formulir.</span>
                            </div>
                            <div class="flex gap-3 text-sm leading-6 text-slate-600">
                                <span class="grid size-7 shrink-0 place-items-center rounded-lg bg-accent text-xs font-black text-primary">2</span>
                                <span>Masukkan nomor WhatsApp yang dipakai saat mendaftar.</span>
                            </div>
                            <div class="flex gap-3 text-sm leading-6 text-slate-600">
                                <span class="grid size-7 shrink-0 place-items-center rounded-lg bg-accent text-xs font-black text-primary">3</span>
                                <span>Ikuti arahan sesuai status yang muncul.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="js-card rounded-lg border-2 border-primary/15 bg-white p-5 shadow-[5px_5px_0_rgba(31,92,69,.08)]">
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Butuh Bantuan?</p>
                    <h2 class="mt-3 text-lg font-black leading-tight text-primary">Nomor tidak ditemukan?</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Hubungi admin sekolah jika nomor pendaftaran hilang atau nomor WhatsApp berubah.
                    </p>
                    <x-ui.button href="{{ route('kontak') }}" variant="outline" size="sm" class="mt-5">Hubungi Sekolah</x-ui.button>
                </div>
            </aside>
        </div>
    </section>
@endsection
