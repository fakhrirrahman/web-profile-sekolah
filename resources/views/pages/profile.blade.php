@extends('layouts.app', ['title' => 'Profil Sekolah - SD Muhammadiyah Pepe'])

@php
    $profileTabs = [
        ['id' => 'sejarah', 'label' => 'Sejarah Sekolah', 'active' => true],
        ['id' => 'visi-misi', 'label' => 'Visi & Misi', 'active' => false],
        ['id' => 'budaya', 'label' => 'Budaya Belajar', 'active' => false],
        ['id' => 'guru', 'label' => 'Guru', 'active' => false],
        ['id' => 'struktur', 'label' => 'Struktur Organisasi', 'active' => false],
    ];

    $values = [
        ['title' => 'Disiplin', 'copy' => 'Siswa dibiasakan untuk datang tepat waktu, mematuhi tata tertib sekolah, serta bertanggung jawab terhadap tugas dan kewajibannya.'],
        ['title' => 'Santun', 'copy' => 'Guru dan siswa membangun komunikasi yang baik dengan mengedepankan sikap saling menghormati, menghargai perbedaan, dan menerapkan akhlak yang mulia.'],
        ['title' => 'Percaya Diri', 'copy' => 'Siswa didorong untuk berani bertanya, mengemukakan pendapat, serta mengembangkan potensi yang dimiliki melalui berbagai kegiatan akademik maupun nonakademik.'],
    ];

    // Foto dihapus, cukup nama + jabatan. Inisial dipakai untuk avatar.
    // Data sesuai Struktur Organisasi SD Muhammadiyah Pepe.
    $teachers = [
        (object) ['name' => 'Hanif Kurniawan, S.S., M.Pd.', 'position' => 'Kepala Sekolah'],
        (object) ['name' => 'Eik Sulistiyani, S.Pd.', 'position' => 'Guru Kelas I A'],
        (object) ['name' => 'Andhika Ariyani, S.Pd.', 'position' => 'Guru Kelas I B'],
        (object) ['name' => 'Mustika Indah Nurul Safitri, S.Pd.', 'position' => 'Guru Kelas II A'],
        (object) ['name' => 'Erianda Pradita, S.Pd.Gr.', 'position' => 'Guru Kelas II B'],
        (object) ['name' => 'Rahmawati, S.Pd.', 'position' => 'Guru Kelas III A'],
        (object) ['name' => 'Lucky Alfian, S.Pd.Gr.', 'position' => 'Guru Kelas III B'],
        (object) ['name' => 'M. Joni Purnomo, S.Pd.', 'position' => 'Guru Kelas IV A'],
        (object) ['name' => 'Ratna Kartika, S.Pd.', 'position' => 'Guru Kelas IV B'],
        (object) ['name' => 'Widarti, S.Pd.SD.', 'position' => 'Guru Kelas V A'],
        (object) ['name' => 'Risma Khasanatun, S.Pd.', 'position' => 'Guru Kelas V B'],
        (object) ['name' => 'Lutfiana Widyasti, S.Pd., Gr.', 'position' => 'Guru Kelas VI A'],
        (object) ['name' => 'Sekar Ayu Arabella, S.Pd.', 'position' => 'Guru Kelas VI B'],
        (object) ['name' => 'Siti Noor Cindri Asri, S.Th.I.', 'position' => 'Guru Mapel PAI'],
        (object) ['name' => 'Darul Istiqomah, S.Pd.I.', 'position' => 'Guru Mapel PAI'],
        (object) ['name' => 'Titis Janu Wiyanti, S.Pd.', 'position' => 'Guru Mapel PAI'],
        (object) ['name' => 'Ismawati, S.Pd.', 'position' => 'Guru Mapel PJOK'],
        (object) ['name' => 'Hariyatun, S.Pd.Jas.', 'position' => 'Guru Mapel PJOK'],
        (object) ['name' => 'Nurjanatullatifah, S.Pd.', 'position' => 'Guru Mapel Bahasa Inggris'],
        (object) ['name' => 'M. Arifin Budiono', 'position' => 'Guru TIK'],
        (object) ['name' => 'Eva Pungki Ainora, S.T., M.Pd.', 'position' => 'Guru Mulok'],
    ];

    // Tenaga kependidikan (non-guru) sesuai Struktur Organisasi SD Muhammadiyah Pepe.
    $staff = [
        (object) ['name' => 'H. Marsono, CH.', 'position' => 'Komite Sekolah'],
        (object) ['name' => 'Aminudin', 'position' => 'Unit Perpustakaan'],
        (object) ['name' => 'Dwi Prahasti', 'position' => 'Bendahara Sekolah'],
        (object) ['name' => 'Rina Dewi Susanti', 'position' => 'Tata Usaha'],
        (object) ['name' => 'Annisa Maula Hasanah, S.Pd.', 'position' => 'Tata Usaha'],
        (object) ['name' => 'Sukiman', 'position' => 'Penjaga Sekolah'],
        (object) ['name' => 'Siti Baryati', 'position' => 'Tenaga Kebersihan'],
    ];

    $missions = [
        'Menanamkan nilai-nilai Al-Islam, Kemuhammadiyahan, dan akhlak mulia melalui pembiasaan ibadah, kegiatan keagamaan, menumbuhkan etika, moral, dan akhlak mulia dalam kehidupan sehari-hari serta penguatan kepemimpinan siswa.',
        'Menyelenggarakan pembelajaran yang aktif, inovatif, berbasis teknologi, dan bahasa serta mengembangkan potensi siswa melalui berbagai kegiatan akademik dan ekstrakurikuler.',
        'Menciptakan lingkungan sekolah yang aman, inklusif, penuh kasih sayang serta menumbuhkan sikap peduli, saling menghargai, dan semangat berbagi.',
        'Menanamkan kecintaan terhadap budaya lokal dan nasional melalui pembelajaran, kegiatan seni budaya, serta pembiasaan sopan santun dan tata krama.',
    ];

    $orgLevels = [
        ['Kepala Sekolah'],
        ['Wakil Kepala Sekolah', 'Kepala Tata Usaha', 'Komite Sekolah'],
        ['Kurikulum', 'Kesiswaan', 'Sarpras', 'Humas'],
        ['Guru', 'Wali Kelas', 'Peserta Didik'],
    ];
@endphp

@section('content')
    <section class="relative isolate bg-primary py-14 text-white md:py-20">
        <img src="{{ asset('images/kegiatan-literasi.png') }}" alt="Kegiatan literasi SD Muhammadiyah Pepe" class="js-hero-image absolute inset-0 -z-20 h-full w-full object-cover">
        <div class="hero-overlay absolute inset-0 -z-10"></div>

        <div class="section-shell">
            <div class="js-reveal grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">
                <div>
                    <p class="inline-flex rounded-lg border-2 border-primary/35 bg-accent px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[4px_4px_0_rgba(255,255,255,.20)]">
                        Profil Sekolah
                    </p>
                    <h1 class="mt-5 max-w-3xl text-4xl font-black leading-tight text-white md:text-5xl">
                        Mengenal SD Muhammadiyah Pepe lebih dekat.
                    </h1>
                    <p class="mt-5 max-w-2xl text-base leading-8 text-white/80">
                        SD Muhammadiyah Pepe hadir sebagai lingkungan belajar yang tertata, hangat, dan membantu anak tumbuh percaya diri bersama keluarga.
                    </p>
                </div>

                <div class="motion-card js-card rounded-lg border-2 border-white/40 bg-white/90 p-5 shadow-[6px_6px_0_rgba(217,180,92,.18)] backdrop-blur">
                    <div class="grid gap-3 sm:grid-cols-3">
                        <div class="rounded-lg bg-surface p-4">
                            <p class="text-3xl font-black text-primary">24</p>
                            <p class="mt-1 text-xs font-black uppercase tracking-wide text-secondary">Guru</p>
                        </div>
                        <div class="rounded-lg bg-surface p-4">
                            <p class="text-3xl font-black text-primary">12</p>
                            <p class="mt-1 text-xs font-black uppercase tracking-wide text-secondary">Ekskul</p>
                        </div>
                        <div class="rounded-lg bg-accent p-4 text-primary">
                            <p class="text-3xl font-black">98%</p>
                            <p class="mt-1 text-xs font-black uppercase tracking-wide">Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="profil-detail" class="bg-white py-16 md:py-24">
        <div class="section-shell">
            <x-ui.section-heading eyebrow="Profil Sekolah" title="Sejarah, visi, dan budaya belajar dalam satu arah yang jelas." />

            <div data-profile-tabs class="mt-12 grid gap-10 lg:grid-cols-[330px_minmax(0,1fr)] lg:items-start">
                <aside class="js-stagger grid gap-3 lg:sticky lg:top-28">
                    @foreach ($profileTabs as $tab)
                        <button type="button" data-profile-tab="{{ $tab['id'] }}" aria-controls="profile-panel-{{ $tab['id'] }}" aria-selected="{{ $tab['active'] ? 'true' : 'false' }}" class="js-card rounded-lg border-2 px-5 py-5 text-left text-sm font-black uppercase tracking-[0.08em] transition hover:-translate-y-0.5 {{ $tab['active'] ? 'border-primary bg-primary text-white shadow-[5px_5px_0_rgba(217,180,92,.35)]' : 'border-primary/15 bg-surface text-primary shadow-[4px_4px_0_rgba(31,92,69,.08)] hover:border-primary/30 hover:bg-secondary-muted' }}">
                            {{ $tab['label'] }}
                        </button>
                    @endforeach
                </aside>

                <div class="js-reveal border-primary/12 lg:min-h-[520px] lg:border-l-2 lg:pl-10">
                    <div data-profile-panel="sejarah" id="profile-panel-sejarah">
                        <article class="max-w-3xl">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Sejarah Sekolah</p>
                            <h2 class="mt-3 text-3xl font-black leading-tight text-primary">Berawal dari komitmen menghadirkan sekolah yang dekat dengan kebutuhan anak.</h2>
                            <p class="mt-6 text-base leading-8 text-slate-600">
                                SD Muhammadiyah Pepe dibangun sebagai ruang belajar yang menggabungkan disiplin akademik, pembiasaan karakter, dan komunikasi yang ramah dengan orang tua. Setiap kegiatan dirancang agar siswa merasa aman untuk mencoba, terbiasa bertanggung jawab, dan percaya diri menghadapi tantangan baru.
                            </p>
                            <p class="mt-4 text-base leading-8 text-slate-600">
                                Seiring berkembangnya sekolah, SD Muhammadiyah Pepe terus memperkuat budaya belajar yang tertata: guru mendampingi proses anak, sekolah menjaga komunikasi yang jelas, dan siswa diberi ruang untuk menemukan minat serta kemampuan terbaiknya.
                            </p>
                        </article>

                        <div class="mt-10 grid gap-5 md:grid-cols-3">
                            <article class="rounded-lg border-2 border-primary/15 bg-surface p-5 shadow-[4px_4px_0_rgba(31,92,69,.08)]">
                                <p class="text-2xl font-black text-primary">2018</p>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Mulai mengembangkan sistem belajar yang rapi dan ramah keluarga.</p>
                            </article>
                            <article class="rounded-lg border-2 border-primary/15 bg-surface p-5 shadow-[4px_4px_0_rgba(31,92,69,.08)]">
                                <p class="text-2xl font-black text-primary">24</p>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Guru dan staf mendampingi proses akademik serta karakter siswa.</p>
                            </article>
                            <article class="rounded-lg border-2 border-primary/15 bg-accent p-5 text-primary shadow-[4px_4px_0_rgba(31,92,69,.10)]">
                                <p class="text-2xl font-black">12</p>
                                <p class="mt-2 text-sm font-semibold leading-6">Ekskul untuk ruang eksplorasi minat dan keberanian anak.</p>
                            </article>
                        </div>
                    </div>

                    <div data-profile-panel="visi-misi" id="profile-panel-visi-misi" class="hidden">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Visi & Misi</p>
                        <h2 class="mt-3 max-w-3xl text-3xl font-black leading-tight text-primary">Arah pendidikan yang jelas untuk akademik, karakter, dan komunikasi sekolah.</h2>

                        <div class="mt-8 grid gap-6 md:grid-cols-[0.85fr_1.15fr]">
                            <article class="motion-card rounded-lg border-2 border-primary/15 bg-surface p-6 shadow-[5px_5px_0_rgba(31,92,69,.08)]">
                                <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Visi</p>
                                <h3 class="mt-3 text-xl font-black leading-tight text-primary">Terwujudnya Kader Muhammadiyah yang Bertaqwa, Cerdas, Humanis, dan Berbudaya (BERCAHAYA).</h3>
                                <p class="mt-4 text-sm leading-7 text-slate-600">
                                    Visi SD Muhammadiyah Pepe tersebut menggambarkan komitmen sekolah dalam membentuk peserta didik yang memiliki ketakwaan kepada Allah Swt., kecerdasan intelektual, sikap humanis, serta kepedulian terhadap nilai-nilai budaya yang baik. Melalui visi ini, SD Muhammadiyah Pepe berupaya menciptakan lingkungan pendidikan yang mampu melahirkan generasi yang berakhlak mulia, berprestasi, dan siap memberikan manfaat bagi masyarakat.
                                </p>
                            </article>

                            <article class="motion-card rounded-lg border-2 border-primary/15 bg-white p-6 shadow-[5px_5px_0_rgba(31,92,69,.08)]">
                                <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Misi</p>
                                <ul class="mt-5 grid gap-3">
                                    @foreach ($missions as $mission)
                                        <li class="flex gap-3 text-sm leading-7 text-slate-600">
                                            <span class="mt-2 size-2 shrink-0 rounded-full bg-accent"></span>
                                            <span>{{ $mission }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </article>
                        </div>
                    </div>

                    <div data-profile-panel="budaya" id="profile-panel-budaya" class="hidden">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Budaya Belajar</p>
                        <h2 class="mt-3 max-w-3xl text-3xl font-black leading-tight text-primary">Tiga nilai yang menjaga pengalaman sekolah tetap nyaman.</h2>
                        <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600">
                            Budaya belajar di SD Muhammadiyah Pepe dibangun untuk menciptakan lingkungan belajar yang nyaman, disiplin, dan menyenangkan. Seluruh warga sekolah berupaya menanamkan nilai-nilai Islami, semangat belajar, serta sikap saling menghormati dalam setiap kegiatan pembelajaran.
                        </p>

                        <div class="mt-8 grid gap-5 md:grid-cols-3">
                            @foreach ($values as $value)
                                <article class="motion-card rounded-lg border-2 border-primary/15 bg-surface p-5 shadow-[4px_4px_0_rgba(31,92,69,.08)]">
                                    <div class="h-1.5 w-12 rounded-full bg-accent"></div>
                                    <h3 class="mt-5 text-xl font-black text-primary">{{ $value['title'] }}</h3>
                                    <p class="mt-3 text-sm leading-7 text-slate-600">{{ $value['copy'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    <div data-profile-panel="guru" id="profile-panel-guru" class="hidden">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Guru</p>
                        <h2 class="mt-3 max-w-3xl text-2xl font-black leading-tight text-primary">Guru yang berkompeten, berpengalaman, dan berdedikasi tinggi.</h2>
                        <div class="mt-8 grid gap-5 md:grid-cols-3">
                            @foreach ($teachers as $teacher)
                                @php
                                    // Buang gelar akademik (kata yang mengandung titik, mis. S.Pd., S.Pd.Gr., M.Pd.)
                                    // serta sapaan Bapak/Ibu, sisanya dipakai sebagai inisial nama.
                                    $initials = collect(explode(' ', $teacher->name))
                                        ->map(fn ($w) => trim($w, ','))
                                        ->reject(fn ($w) => str_contains($w, '.') || in_array(strtolower($w), ['bapak', 'ibu']))
                                        ->take(2)
                                        ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
                                        ->implode('');
                                @endphp
                                <article class="motion-card rounded-lg border-2 border-primary/15 bg-surface p-5 shadow-[4px_4px_0_rgba(31,92,69,.08)]">
                                    {{-- Foto dihapus, diganti avatar inisial --}}
                                    <div class="flex aspect-[4/3] w-full items-center justify-center rounded-lg border-2 border-primary/10 bg-secondary-muted">
                                        <span class="text-3xl font-black text-primary">{{ $initials }}</span>
                                    </div>
                                    <h3 class="mt-5 text-l font-black text-primary">{{ $teacher->name }}</h3>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">{{ $teacher->position }}</p>
                                </article>
                            @endforeach
                        </div>

                        <div class="mt-14">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Tenaga Kependidikan</p>
                            <h3 class="mt-3 max-w-3xl text-2xl font-black leading-tight text-primary">Tim pendukung yang menjaga kelancaran operasional sekolah.</h3>
                            <div class="mt-6 grid gap-5 sm:grid-cols-2 md:grid-cols-4">
                                @foreach ($staff as $person)
                                    @php
                                        $staffInitials = collect(explode(' ', $person->name))
                                            ->map(fn ($w) => trim($w, ','))
                                            ->reject(fn ($w) => str_contains($w, '.') || in_array(strtolower($w), ['bapak', 'ibu', 'h.']))
                                            ->take(2)
                                            ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
                                            ->implode('');
                                    @endphp
                                    <article class="rounded-lg border-2 border-primary/15 bg-white p-4 shadow-[3px_3px_0_rgba(31,92,69,.06)]">
                                        <div class="flex aspect-square w-full items-center justify-center rounded-lg border-2 border-primary/10 bg-surface">
                                            <span class="text-2xl font-black text-primary">{{ $staffInitials }}</span>
                                        </div>
                                        <h4 class="mt-4 text-sm font-black leading-snug text-primary">{{ $person->name }}</h4>
                                        <p class="mt-1 text-xs font-semibold uppercase tracking-wide text-secondary">{{ $person->position }}</p>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div data-profile-panel="struktur" id="profile-panel-struktur" class="hidden">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Struktur Organisasi</p>
                        <h2 class="mt-3 max-w-3xl text-3xl font-black leading-tight text-primary">Tim sekolah yang bekerja dalam alur koordinasi yang jelas.</h2>

                        <div class="mt-8 rounded-lg border-2 border-primary/15 bg-white p-5 shadow-[5px_5px_0_rgba(31,92,69,.10)] md:p-6">
                            <img src="{{ asset('images/STRUKTUR ORAGNISASI SD MUH PEPE.png') }}" alt="Struktur Organisasi SD Muhammadiyah Pepe" class="w-full rounded-lg object-contain">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="motion-card js-reveal section-shell rounded-lg border-2 border-primary/15 bg-gradient-to-br from-white via-surface to-secondary-muted p-8 text-primary shadow-[6px_6px_0_rgba(31,92,69,.10)] md:p-10">
            <div class="grid gap-8 md:grid-cols-[1fr_auto] md:items-center">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Kunjungan Sekolah</p>
                    <h2 class="mt-3 text-2xl font-black leading-tight md:text-3xl">Ingin melihat suasana SD Muhammadiyah Pepe secara langsung?</h2>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600">
                        Hubungi sekolah untuk jadwal kunjungan, konsultasi kelas, dan informasi penerimaan siswa baru.
                    </p>
                </div>
                <x-ui.button href="{{ url('/kontak') }}" variant="accent" size="lg">Hubungi Sekolah</x-ui.button>
            </div>
        </div>
    </section>
@endsection