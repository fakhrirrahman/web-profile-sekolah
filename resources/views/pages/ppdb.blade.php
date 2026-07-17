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

    $grades = ['KB/TK', 'SD Kelas 1', 'SD Kelas 2', 'SD Kelas 3', 'SD Kelas 4', 'SD Kelas 5', 'SD Kelas 6'];
@endphp

@section('content')
    <section class="relative isolate bg-primary py-14 text-white md:py-20">
        <img src="{{ asset('images/kelas-interaktif.png') }}" alt="Kelas interaktif Golden Sierra School" class="js-hero-image absolute inset-0 -z-20 h-full w-full object-cover">
        <div class="hero-overlay absolute inset-0 -z-10"></div>

        <div class="section-shell grid gap-10 lg:grid-cols-[minmax(0,1fr)_390px] lg:items-center">
            <div class="js-reveal">
                <p class="inline-flex rounded-lg border-2 border-primary/35 bg-accent px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[4px_4px_0_rgba(255,255,255,.20)]">PPDB 2026/2027</p>
                <h1 class="mt-5 max-w-3xl text-4xl font-black leading-tight text-white md:text-5xl">Siapkan langkah pertama anak bersama Golden Sierra School.</h1>
                <p class="mt-5 max-w-2xl text-base leading-8 text-white/80">Halaman ini merangkum alur, jadwal, dan persyaratan pendaftaran agar orang tua dapat mengambil keputusan dengan tenang.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <x-ui.button href="#form-ppdb" variant="accent" size="lg">Isi Formulir</x-ui.button>
                    <x-ui.button href="#alur-ppdb" variant="muted" size="lg">Lihat Alur</x-ui.button>
                </div>
            </div>

            <aside class="motion-card js-card rounded-lg border-2 border-white/40 bg-white/90 p-6 shadow-[6px_6px_0_rgba(217,180,92,.18)] backdrop-blur">
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

    <section id="form-ppdb" class="bg-surface py-16 md:py-24">
        <div class="section-shell grid gap-8 lg:grid-cols-[0.75fr_1.25fr] lg:items-start">
            <div class="js-reveal">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Formulir Online</p>
                <h2 class="mt-3 text-3xl font-black leading-tight text-primary md:text-4xl">Kirim data calon siswa langsung ke admin sekolah.</h2>
                <p class="mt-4 text-sm leading-7 text-slate-600">
                    Setelah formulir dikirim, admin akan menghubungi orang tua untuk konfirmasi jadwal konsultasi dan observasi.
                </p>

                @if (session('registration_number'))
                    <div class="mt-6 rounded-lg border-2 border-green-200 bg-green-50 p-4 text-green-700">
                        <p class="text-xs font-black uppercase tracking-wide">Pendaftaran terkirim</p>
                        <p class="mt-2 text-sm font-bold">Nomor pendaftaran: {{ session('registration_number') }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-6 rounded-lg border-2 border-red-200 bg-red-50 p-4 text-red-700">
                        <p class="text-sm font-black">Ada data yang perlu diperbaiki.</p>
                        <p class="mt-1 text-xs font-semibold">Silakan cek kembali kolom formulir yang bertanda merah.</p>
                    </div>
                @endif
            </div>

            <form action="{{ route('ppdb.store') }}" method="POST" class="motion-card js-card rounded-lg border-2 border-primary/15 bg-white p-5 shadow-[6px_6px_0_rgba(31,92,69,.10)] md:p-6">
                @csrf

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="student_name" class="text-xs font-black uppercase tracking-wide text-primary">Nama Calon Siswa</label>
                        <input id="student_name" name="student_name" value="{{ old('student_name') }}" type="text" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('student_name') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" required>
                        @error('student_name')
                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="desired_grade" class="text-xs font-black uppercase tracking-wide text-primary">Jenjang Tujuan</label>
                        <select id="desired_grade" name="desired_grade" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('desired_grade') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" required>
                            <option value="">Pilih jenjang</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade }}" @selected(old('desired_grade') === $grade)>{{ $grade }}</option>
                            @endforeach
                        </select>
                        @error('desired_grade')
                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="birth_place" class="text-xs font-black uppercase tracking-wide text-primary">Tempat Lahir</label>
                        <input id="birth_place" name="birth_place" value="{{ old('birth_place') }}" type="text" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('birth_place') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" required>
                        @error('birth_place')
                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="birth_date" class="text-xs font-black uppercase tracking-wide text-primary">Tanggal Lahir</label>
                        <input id="birth_date" name="birth_date" value="{{ old('birth_date') }}" type="date" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('birth_date') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" required>
                        @error('birth_date')
                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gender" class="text-xs font-black uppercase tracking-wide text-primary">Jenis Kelamin</label>
                        <select id="gender" name="gender" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('gender') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki" @selected(old('gender') === 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('gender') === 'Perempuan')>Perempuan</option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="previous_school" class="text-xs font-black uppercase tracking-wide text-primary">Asal Sekolah</label>
                        <input id="previous_school" name="previous_school" value="{{ old('previous_school') }}" type="text" class="mt-2 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 py-3 text-sm outline-none transition focus:border-primary" placeholder="Opsional">
                    </div>

                    <div>
                        <label for="parent_name" class="text-xs font-black uppercase tracking-wide text-primary">Nama Orang Tua/Wali</label>
                        <input id="parent_name" name="parent_name" value="{{ old('parent_name') }}" type="text" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('parent_name') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" required>
                        @error('parent_name')
                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="text-xs font-black uppercase tracking-wide text-primary">Nomor WhatsApp</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}" type="text" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('phone') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" required>
                        @error('phone')
                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="text-xs font-black uppercase tracking-wide text-primary">Email</label>
                        <input id="email" name="email" value="{{ old('email') }}" type="email" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('email') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" placeholder="Opsional">
                        @error('email')
                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="text-xs font-black uppercase tracking-wide text-primary">Alamat</label>
                        <textarea id="address" name="address" rows="3" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('address') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" required>{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="notes" class="text-xs font-black uppercase tracking-wide text-primary">Catatan Tambahan</label>
                        <textarea id="notes" name="notes" rows="3" class="mt-2 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 py-3 text-sm outline-none transition focus:border-primary" placeholder="Opsional">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-ui.button type="submit" variant="accent" size="lg">Kirim Pendaftaran</x-ui.button>
                </div>
            </form>
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
