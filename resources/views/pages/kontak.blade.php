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
                <form action="#" class="motion-card js-reveal rounded-lg border-2 border-primary/15 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.10)]">
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Kirim Pesan</p>
                    <h2 class="mt-3 text-2xl font-black leading-tight text-primary">Tulis kebutuhan Anda, admin akan membantu.</h2>

                    <div class="mt-6 grid gap-4">
                        <div>
                            <label for="name" class="text-sm font-black text-primary">Nama</label>
                            <input id="name" type="text" class="mt-2 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 py-3 text-sm outline-none transition focus:border-primary" placeholder="Nama orang tua">
                        </div>
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label for="phone" class="text-sm font-black text-primary">Nomor Telepon</label>
                                <input id="phone" type="tel" class="mt-2 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 py-3 text-sm outline-none transition focus:border-primary" placeholder="08xxxxxxxxxx">
                            </div>
                            <div>
                                <label for="topic" class="text-sm font-black text-primary">Topik</label>
                                <select id="topic" class="mt-2 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 py-3 text-sm outline-none transition focus:border-primary">
                                    <option>Informasi PPDB</option>
                                    <option>Jadwal Kunjungan</option>
                                    <option>Akademik</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="message" class="text-sm font-black text-primary">Pesan</label>
                            <textarea id="message" rows="5" class="mt-2 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 py-3 text-sm outline-none transition focus:border-primary" placeholder="Tuliskan pertanyaan atau kebutuhan Anda"></textarea>
                        </div>
                    </div>

                    <x-ui.button type="submit" variant="accent" class="mt-6">Kirim Pesan</x-ui.button>
                </form>

                <aside class="grid gap-5">
                    <div class="motion-card js-card rounded-lg border-2 border-primary/15 bg-surface p-6 shadow-[5px_5px_0_rgba(31,92,69,.08)]">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Lokasi</p>
                        <div class="media-placeholder-bg mt-5 aspect-[4/3] rounded-lg border-2 border-primary/10"></div>
                        <p class="mt-4 text-sm leading-7 text-slate-600">Jl. Pendidikan No. 12, Jakarta. Gunakan area ini untuk embed peta sekolah nanti.</p>
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
