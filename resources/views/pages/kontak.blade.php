@extends('layouts.app', ['title' => 'Kontak - Golden Sierra School'])

@php
    $contacts = [
        ['title' => 'Alamat', 'value' => 'Jl. Pendidikan No. 12, Jakarta', 'copy' => 'Kunjungan sekolah dapat dijadwalkan pada hari kerja.'],
        ['title' => 'Telepon', 'value' => '(021) 1234 5678', 'copy' => 'Admin siap membantu pukul 08.00 - 15.00 WIB.'],
        ['title' => 'Email', 'value' => 'info@goldensierra.sch.id', 'copy' => 'Untuk kebutuhan dokumen dan informasi resmi sekolah.'],
    ];

    $faqs = [
        ['question' => 'Apakah bisa survei sekolah terlebih dahulu?', 'answer' => 'Bisa. Orang tua dapat menghubungi admin untuk memilih jadwal kunjungan.'],
        ['question' => 'Kapan admin merespons pesan?', 'answer' => 'Pesan biasanya direspons pada jam kerja sekolah pukul 08.00 - 15.00 WIB.'],
        ['question' => 'Apakah konsultasi PPDB dikenakan biaya?', 'answer' => 'Konsultasi awal dengan admin sekolah tidak dikenakan biaya.'],
    ];
@endphp

@section('content')
    <section class="bg-surface py-14 md:py-20">
        <div class="section-shell grid gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:items-end">
            <div class="js-reveal">
                <p class="inline-flex rounded-lg border-2 border-primary/20 bg-white px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[3px_3px_0_rgba(31,92,69,.10)]">Kontak Kami</p>
                <h1 class="mt-5 max-w-3xl text-4xl font-black leading-tight text-primary md:text-5xl">Hubungi Golden Sierra dengan cara yang paling nyaman.</h1>
                <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600">Untuk kunjungan sekolah, informasi PPDB, atau pertanyaan orang tua, admin sekolah siap membantu dengan alur yang jelas.</p>
            </div>

            <div class="motion-card js-card rounded-lg border-2 border-primary/15 bg-white p-5 shadow-[6px_6px_0_rgba(31,92,69,.10)]">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Jam Layanan</p>
                <div class="mt-4 rounded-lg bg-accent p-5 text-primary">
                    <p class="text-3xl font-black">08.00 - 15.00</p>
                    <p class="mt-1 text-xs font-black uppercase tracking-wide">Senin sampai Jumat</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 md:py-24">
        <div class="section-shell">
            <div class="js-stagger grid gap-5 md:grid-cols-3">
                @foreach ($contacts as $contact)
                    <article class="motion-card js-card rounded-lg border-2 border-primary/15 bg-surface p-5 shadow-[4px_4px_0_rgba(31,92,69,.08)]">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">{{ $contact['title'] }}</p>
                        <h2 class="mt-4 text-xl font-black text-primary">{{ $contact['value'] }}</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $contact['copy'] }}</p>
                    </article>
                @endforeach
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-[minmax(0,1fr)_390px] lg:items-start">
                <form action="{{ route('kontak.store') }}" method="POST" class="motion-card js-reveal rounded-lg border-2 border-primary/15 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.10)]">
                    @csrf
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Kirim Pesan</p>
                    <h2 class="mt-3 text-2xl font-black leading-tight text-primary">Tulis kebutuhan Anda, admin akan membantu.</h2>

                    @if (session('contact_sent'))
                        <div class="mt-5 rounded-lg border-2 border-green-200 bg-green-50 p-4 text-green-700">
                            <p class="text-sm font-black">Pesan berhasil dikirim.</p>
                            <p class="mt-1 text-xs font-semibold">Admin sekolah akan menghubungi Anda melalui nomor telepon yang dicantumkan.</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mt-5 rounded-lg border-2 border-red-200 bg-red-50 p-4 text-red-700">
                            <p class="text-sm font-black">Ada data yang perlu diperbaiki.</p>
                            <p class="mt-1 text-xs font-semibold">Silakan cek kembali kolom formulir kontak.</p>
                        </div>
                    @endif

                    <div class="mt-6 grid gap-4">
                        <div>
                            <label for="name" class="text-sm font-black text-primary">Nama</label>
                            <input id="name" name="name" value="{{ old('name') }}" type="text" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('name') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" placeholder="Nama orang tua" required>
                            @error('name')
                                <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label for="phone" class="text-sm font-black text-primary">Nomor Telepon</label>
                                <input id="phone" name="phone" value="{{ old('phone') }}" type="tel" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('phone') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" placeholder="08xxxxxxxxxx" required>
                                @error('phone')
                                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="topic" class="text-sm font-black text-primary">Topik</label>
                                <select id="topic" name="topic" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('topic') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" required>
                                    @foreach (['Informasi PPDB', 'Jadwal Kunjungan', 'Akademik', 'Lainnya'] as $topic)
                                        <option value="{{ $topic }}" @selected(old('topic', 'Informasi PPDB') === $topic)>{{ $topic }}</option>
                                    @endforeach
                                </select>
                                @error('topic')
                                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="message" class="text-sm font-black text-primary">Pesan</label>
                            <textarea id="message" name="message" rows="5" class="mt-2 w-full rounded-lg border-2 px-4 py-3 text-sm outline-none transition focus:border-primary {{ $errors->has('message') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" placeholder="Tuliskan pertanyaan atau kebutuhan Anda" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <x-ui.button type="submit" variant="accent" class="mt-6">Kirim Pesan</x-ui.button>
                </form>

                <aside class="grid gap-5">
                    <div class="motion-card js-card rounded-lg border-2 border-primary/15 bg-surface p-6 shadow-[5px_5px_0_rgba(31,92,69,.08)]">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Lokasi</p>
                        <div class="mt-5 overflow-hidden rounded-lg border-2 border-primary/10 bg-white">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15778.121783137614!2d115.2082925!3d-8.6409939!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f68233a43f3%3A0x1459dbee1b7b8b90!2sLumintang%20Extreme%20Park!5e0!3m2!1sid!2sid!4v1784270587028!5m2!1sid!2sid" class="aspect-[4/3] w-full" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                        <p class="mt-4 text-sm leading-7 text-slate-600">Lokasi sekolah dapat dilihat melalui peta ini. Hubungi admin untuk jadwal kunjungan.</p>
                    </div>

                    <div class="motion-card js-card rounded-lg border-2 border-primary/15 bg-white p-6 shadow-[5px_5px_0_rgba(31,92,69,.08)]">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Pertanyaan Umum</p>
                        <div class="mt-5 grid gap-4">
                            @foreach ($faqs as $faq)
                                <div class="rounded-lg bg-surface p-4">
                                    <p class="text-sm font-black text-primary">{{ $faq['question'] }}</p>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $faq['answer'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
