@extends('layouts.app', ['title' => 'Profil Sekolah - Golden Sierra School'])

@php
    $profileTabs = [
        ['id' => 'sejarah', 'label' => 'Sejarah Sekolah', 'active' => true],
        ['id' => 'visi-misi', 'label' => 'Visi & Misi', 'active' => false],
        ['id' => 'budaya', 'label' => 'Budaya Belajar', 'active' => false],
        ['id' => 'struktur', 'label' => 'Struktur Organisasi', 'active' => false],
    ];

    $values = [
        ['title' => 'Rapi', 'copy' => 'Alur belajar, komunikasi, dan kegiatan sekolah dibuat jelas agar mudah diikuti siswa maupun orang tua.'],
        ['title' => 'Hangat', 'copy' => 'Guru mendampingi anak dengan perhatian, empati, dan komunikasi yang terbuka.'],
        ['title' => 'Berani', 'copy' => 'Siswa didorong bertanya, mencoba, dan menyampaikan gagasan dengan percaya diri.'],
    ];

    $missions = [
        'Menyelenggarakan pendidikan berkualitas, tertata, dan relevan dengan perkembangan zaman.',
        'Membentuk peserta didik yang beriman, disiplin, santun, serta memiliki kepedulian sosial.',
        'Mengembangkan potensi akademik dan nonakademik melalui kegiatan yang seimbang.',
        'Membangun kemitraan yang ramah antara sekolah, siswa, dan orang tua.',
    ];

    $orgLevels = [
        ['Kepala Sekolah'],
        ['Wakil Kepala Sekolah', 'Kepala Tata Usaha', 'Komite Sekolah'],
        ['Kurikulum', 'Kesiswaan', 'Sarpras', 'Humas'],
        ['Guru', 'Wali Kelas', 'Peserta Didik'],
    ];
@endphp

@section('content')
    <section class="bg-surface py-14 md:py-20">
        <div class="section-shell">
            <div class="js-reveal grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">
                <div>
                    <p class="inline-flex rounded-lg border-2 border-primary/20 bg-white px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[3px_3px_0_rgba(31,92,69,.10)]">
                        Profil Sekolah
                    </p>
                    <h1 class="mt-5 max-w-3xl text-4xl font-black leading-tight text-primary md:text-5xl">
                        Mengenal Golden Sierra School lebih dekat.
                    </h1>
                    <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600">
                        Golden Sierra School hadir sebagai lingkungan belajar yang tertata, hangat, dan membantu anak tumbuh percaya diri bersama keluarga.
                    </p>
                </div>

                <div class="motion-card js-card rounded-lg border-2 border-primary/15 bg-white p-5 shadow-[6px_6px_0_rgba(31,92,69,.10)]">
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
                                Golden Sierra School dibangun sebagai ruang belajar yang menggabungkan disiplin akademik, pembiasaan karakter, dan komunikasi yang ramah dengan orang tua. Setiap kegiatan dirancang agar siswa merasa aman untuk mencoba, terbiasa bertanggung jawab, dan percaya diri menghadapi tantangan baru.
                            </p>
                            <p class="mt-4 text-base leading-8 text-slate-600">
                                Seiring berkembangnya sekolah, Golden Sierra terus memperkuat budaya belajar yang tertata: guru mendampingi proses anak, sekolah menjaga komunikasi yang jelas, dan siswa diberi ruang untuk menemukan minat serta kemampuan terbaiknya.
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
                                <h3 class="mt-3 text-2xl font-black leading-tight text-primary">Menjadi sekolah yang membentuk lulusan berkarakter dan percaya diri.</h3>
                                <p class="mt-4 text-sm leading-7 text-slate-600">
                                    Golden Sierra School berkomitmen menghadirkan pendidikan yang membantu siswa tumbuh unggul, peduli, kompeten, dan siap berkontribusi di lingkungan yang terus berkembang.
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
                            Nilai ini menjadi pegangan dalam kelas, kegiatan sekolah, komunikasi guru, dan cara sekolah mendampingi anak.
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

                    <div data-profile-panel="struktur" id="profile-panel-struktur" class="hidden">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Struktur Organisasi</p>
                        <h2 class="mt-3 max-w-3xl text-3xl font-black leading-tight text-primary">Tim sekolah yang bekerja dalam alur koordinasi yang jelas.</h2>

                        <div class="mt-8">
                            <div class="rounded-lg border-2 border-primary/15 bg-white p-5 shadow-[5px_5px_0_rgba(31,92,69,.10)] md:p-6">
                                <div class="grid gap-6">
                                    @foreach ($orgLevels as $level)
                                        @php
                                            $gridClass = match (count($level)) {
                                                1 => 'sm:grid-cols-1',
                                                3 => 'sm:grid-cols-3',
                                                4 => 'sm:grid-cols-4',
                                                default => 'sm:grid-cols-2',
                                            };
                                        @endphp
                                        <div class="grid gap-3 {{ $gridClass }}">
                                            @foreach ($level as $item)
                                                <div class="rounded-lg border-2 border-primary/12 bg-surface px-4 py-3 text-center text-xs font-black uppercase leading-5 tracking-wide text-primary">
                                                    {{ $item }}
                                                </div>
                                            @endforeach
                                        </div>
                                        @if (! $loop->last)
                                            <div class="mx-auto h-7 w-0.5 bg-primary/25"></div>
                                    @endif
                                @endforeach
                            </div>
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
                    <h2 class="mt-3 text-2xl font-black leading-tight md:text-4xl">Ingin melihat suasana Golden Sierra secara langsung?</h2>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600">
                        Hubungi sekolah untuk jadwal kunjungan, konsultasi kelas, dan informasi penerimaan siswa baru.
                    </p>
                </div>
                <x-ui.button href="{{ url('/kontak') }}" variant="accent" size="lg">Hubungi Sekolah</x-ui.button>
            </div>
        </div>
    </section>
@endsection
