@extends('layouts.app', ['title' => 'Cek Status PPDB - Golden Sierra School'])

@php
    $statusMessages = [
        'baru' => 'Data sudah masuk. Admin akan menghubungi orang tua untuk konfirmasi awal.',
        'dihubungi' => 'Admin sudah menghubungi orang tua. Silakan lanjutkan komunikasi melalui kontak sekolah.',
        'observasi' => 'Pendaftaran masuk tahap observasi. Ikuti jadwal yang sudah diinformasikan admin.',
        'lolos_berkas' => 'Berkas pendaftaran sudah sesuai. Silakan ikuti arahan admin untuk tahap berikutnya.',
        'tidak_lolos_berkas' => 'Berkas pendaftaran belum memenuhi ketentuan. Mohon hubungi admin sekolah untuk informasi lebih lanjut.',
        'tes_akademik' => 'Pendaftaran masuk tahap tes akademik. Ikuti jadwal dan arahan yang sudah diinformasikan admin.',
        'wawancara' => 'Pendaftaran masuk tahap wawancara. Mohon mengikuti jadwal yang sudah diinformasikan admin.',
        'diterima' => 'Selamat, calon siswa dinyatakan diterima. Silakan lanjutkan proses daftar ulang.',
        'ditolak' => 'Mohon hubungi admin sekolah untuk informasi lebih lanjut terkait hasil pendaftaran.',
    ];

    $statusClasses = [
        'baru' => 'bg-blue-50 text-blue-700 border-blue-200',
        'dihubungi' => 'bg-amber-50 text-amber-800 border-amber-200',
        'observasi' => 'bg-secondary-muted text-secondary border-secondary/20',
        'lolos_berkas' => 'bg-green-50 text-green-700 border-green-200',
        'tidak_lolos_berkas' => 'bg-red-50 text-red-700 border-red-200',
        'tes_akademik' => 'bg-blue-50 text-blue-700 border-blue-200',
        'wawancara' => 'bg-amber-50 text-amber-800 border-amber-200',
        'diterima' => 'bg-green-50 text-green-700 border-green-200',
        'ditolak' => 'bg-red-50 text-red-700 border-red-200',
    ];

    $lookupRegistrations = $lookupRegistrations ?? collect();
    $selectedRegistrationNumber = old('registration_number', $statusSearch['registration_number'] ?? session('registration_number'));
    $selectedLookupRegistration = $lookupRegistrations->firstWhere('registration_number', $selectedRegistrationNumber);
    $selectedLookupValue = $selectedLookupRegistration
        ? $selectedLookupRegistration->registration_number . ' - ' . $selectedLookupRegistration->student_name
        : $selectedRegistrationNumber;
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
                        Cari nama atau nomor pendaftaran untuk melihat status PPDB.
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
                        <p class="mt-1 text-xs font-semibold">Cari nama atau nomor pendaftaran untuk melihat status terbaru.</p>
                    </div>
                @endif

                <div class="grid gap-6 lg:grid-cols-[0.8fr_1.2fr] lg:items-start">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Cek Data</p>
                        <h2 class="mt-3 text-2xl font-black leading-tight text-primary">Status pendaftaran</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">
                            Pilih data pendaftar dari kolom pencarian untuk melihat status terbaru.
                        </p>
                    </div>

                    <form action="{{ route('ppdb.status') }}" method="GET" class="grid gap-4" data-ppdb-status-form>
                        <div>
                            <label for="registration_lookup" class="text-xs font-black uppercase tracking-wide text-primary">Cari Pendaftar</label>
                            <div class="relative mt-2" data-ppdb-combobox>
                                <input id="registration_lookup" value="{{ $selectedLookupValue }}" type="text" class="w-full rounded-lg border-2 px-4 py-3 pr-11 text-sm text-slate-700 outline-none transition focus:border-primary {{ $errors->statusLookup->has('registration_number') ? 'border-red-300 bg-red-50' : 'border-primary/15 bg-surface' }}" placeholder="Ketik nomor pendaftaran atau nama siswa" autocomplete="off" required data-ppdb-registration-lookup>
                                <button type="button" class="absolute right-2 top-1/2 grid size-8 -translate-y-1/2 place-items-center rounded-lg text-primary transition hover:bg-secondary-muted" aria-label="Buka pilihan pendaftar" data-ppdb-toggle>
                                    <x-ui.icon name="chevron-down" class="size-4" />
                                </button>
                                <div class="absolute left-0 right-0 top-[calc(100%+.35rem)] z-30 hidden max-h-64 overflow-y-auto rounded-lg border-2 border-primary/15 bg-white p-2 shadow-[6px_6px_0_rgba(31,92,69,.12)]" data-ppdb-options>
                                    @forelse ($lookupRegistrations as $registration)
                                        <button type="button" class="block w-full rounded-md px-3 py-2 text-left transition hover:bg-secondary-muted focus:bg-secondary-muted focus:outline-none" data-ppdb-option data-label="{{ $registration->registration_number }} - {{ $registration->student_name }}" data-registration-number="{{ $registration->registration_number }}" data-grade="{{ $registration->desired_grade }}">
                                            <span class="block text-sm font-black text-primary">{{ $registration->registration_number }}</span>
                                            <span class="mt-0.5 block text-xs font-semibold text-slate-500">{{ $registration->student_name }} - {{ $registration->desired_grade }}</span>
                                        </button>
                                    @empty
                                        <div class="px-3 py-2 text-xs font-semibold leading-5 text-slate-500">
                                            Belum ada data pendaftaran.
                                        </div>
                                    @endforelse
                                    <div class="hidden px-3 py-2 text-xs font-semibold leading-5 text-slate-500" data-ppdb-empty>
                                        Data pendaftar tidak ditemukan.
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="registration_number" value="{{ $selectedRegistrationNumber }}" data-ppdb-registration-number>
                            @error('registration_number', 'statusLookup')
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

                            @php
                                $statusHistories = $statusRegistration->statusHistories->values();
                                $historyCount = max($statusHistories->count(), 1);
                                $currentHistory = $statusHistories->last();
                            @endphp

                            <div class="mt-5 rounded-lg border-2 border-primary/10 bg-white p-4 sm:p-5">
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Riwayat status</p>
                                        <h4 class="mt-1 text-lg font-black leading-tight text-primary">Progress pendaftaran</h4>
                                    </div>
                                    <div class="inline-flex w-fit items-center gap-2 rounded-lg border-2 border-primary/10 bg-surface px-3 py-2">
                                        <span class="text-xs font-black uppercase tracking-wide text-primary">
                                            Tahap saat ini
                                        </span>
                                    </div>
                                </div>

                                <ol class="relative mt-6 hidden gap-0 md:grid" style="grid-template-columns: repeat({{ $historyCount }}, minmax(0, 1fr));">
                                    <span class="absolute left-10 right-10 top-5 h-1 rounded-full bg-primary/10" aria-hidden="true"></span>
                                    <span class="absolute left-10 right-10 top-5 h-1 rounded-full bg-secondary/40" aria-hidden="true"></span>
                                    @forelse ($statusHistories as $history)
                                        @php
                                            $isCurrent = $loop->last;
                                        @endphp
                                        <li class="relative z-10 flex min-w-0 flex-col items-center px-2 text-center">
                                            <span class="grid size-11 place-items-center rounded-full border-2 shadow-[0_0_0_6px_#fff] {{ $isCurrent ? ($statusClasses[$history->status] ?? 'border-primary/15 bg-white text-primary') : 'border-secondary/25 bg-white text-secondary' }}">
                                                <span class="text-sm font-black">{{ $loop->iteration }}</span>
                                            </span>
                                            <div class="mt-3 min-w-0">
                                                <p class="truncate text-sm font-black leading-5 text-primary">{{ $history->status_label }}</p>
                                                <p class="mt-1 text-xs font-semibold leading-5 text-slate-500">
                                                    {{ optional($history->changed_at)->format('d M Y H:i') }}
                                                </p>
                                                @if ($isCurrent)
                                                    <span class="mt-2 inline-flex rounded-full border border-secondary/20 bg-secondary-muted px-2 py-1 text-[10px] font-black uppercase tracking-wide text-secondary">
                                                        Saat ini
                                                    </span>
                                                @endif
                                            </div>
                                        </li>
                                    @empty
                                        <li class="relative z-10 flex min-w-0 flex-col items-center px-2 text-center">
                                            <span class="grid size-11 place-items-center rounded-full border-2 shadow-[0_0_0_6px_#fff] {{ $statusClasses[$statusRegistration->status] ?? 'border-primary/15 bg-white text-primary' }}">
                                                <span class="text-sm font-black">1</span>
                                            </span>
                                            <div class="mt-3 min-w-0">
                                                <p class="truncate text-sm font-black leading-5 text-primary">{{ $statusRegistration->status_label }}</p>
                                                <p class="mt-1 text-xs font-semibold leading-5 text-slate-500">
                                                    {{ optional($statusRegistration->created_at)->format('d M Y H:i') }}
                                                </p>
                                                <span class="mt-2 inline-flex rounded-full border border-secondary/20 bg-secondary-muted px-2 py-1 text-[10px] font-black uppercase tracking-wide text-secondary">
                                                    Saat ini
                                                </span>
                                            </div>
                                        </li>
                                    @endforelse
                                </ol>

                                <ol class="mt-5 grid gap-0 md:hidden">
                                    @forelse ($statusHistories as $history)
                                        @php
                                            $isCurrent = $loop->last;
                                        @endphp
                                        <li class="grid grid-cols-[auto_1fr] gap-3">
                                            <div class="flex flex-col items-center">
                                                <span class="grid size-10 place-items-center rounded-full border-2 {{ $isCurrent ? ($statusClasses[$history->status] ?? 'border-primary/15 bg-white text-primary') : 'border-secondary/25 bg-white text-secondary' }}">
                                                    <span class="text-sm font-black">{{ $loop->iteration }}</span>
                                                </span>
                                                @unless ($loop->last)
                                                    <span class="h-full min-h-8 w-1 rounded-full bg-secondary/30"></span>
                                                @endunless
                                            </div>
                                            <div class="min-w-0 pb-5">
                                                <div class="rounded-lg border-2 {{ $isCurrent ? 'border-primary/20 bg-secondary-muted' : 'border-primary/10 bg-surface' }} px-4 py-3">
                                                    <div class="flex flex-wrap items-center gap-2">
                                                        <p class="text-sm font-black leading-5 text-primary">{{ $history->status_label }}</p>
                                                        @if ($isCurrent)
                                                            <span class="rounded-full bg-white px-2 py-1 text-[10px] font-black uppercase tracking-wide text-secondary">
                                                                Saat ini
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <p class="mt-2 text-xs font-semibold leading-5 text-slate-500">
                                                        {{ optional($history->changed_at)->format('d M Y H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="grid grid-cols-[auto_1fr] gap-3">
                                            <div class="flex flex-col items-center">
                                                <span class="grid size-10 place-items-center rounded-full border-2 {{ $statusClasses[$statusRegistration->status] ?? 'border-primary/15 bg-white text-primary' }}">
                                                    <span class="text-sm font-black">1</span>
                                                </span>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="rounded-lg border-2 border-primary/20 bg-secondary-muted px-4 py-3">
                                                    <div class="flex flex-wrap items-center gap-2">
                                                        <p class="text-sm font-black leading-5 text-primary">{{ $statusRegistration->status_label }}</p>
                                                        <span class="rounded-full bg-white px-2 py-1 text-[10px] font-black uppercase tracking-wide text-secondary">
                                                            Saat ini
                                                        </span>
                                                    </div>
                                                    <p class="mt-2 text-xs font-semibold leading-5 text-slate-500">
                                                        {{ optional($statusRegistration->created_at)->format('d M Y H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforelse
                                </ol>

                                <div class="mt-5 rounded-lg border-2 border-primary/10 bg-surface px-4 py-3">
                                    <p class="text-xs font-black uppercase tracking-wide text-secondary">Status terbaru</p>
                                    <div class="mt-2 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <p class="text-base font-black leading-6 text-primary">
                                            {{ optional($currentHistory)->status_label ?? $statusRegistration->status_label }}
                                        </p>
                                        <p class="text-xs font-semibold text-slate-500">
                                            {{ optional(optional($currentHistory)->changed_at ?? $statusRegistration->created_at)->format('d M Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mt-7 rounded-lg border-2 border-red-200 bg-red-50 p-5 text-red-700">
                            <p class="text-sm font-black">Data pendaftaran tidak ditemukan.</p>
                            <p class="mt-1 text-xs font-semibold leading-6">Pastikan nomor pendaftaran sama seperti saat mengisi formulir.</p>
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
                                <span>Cari nomor pendaftaran atau nama siswa pada kolom pencarian.</span>
                            </div>
                            <div class="flex gap-3 text-sm leading-6 text-slate-600">
                                <span class="grid size-7 shrink-0 place-items-center rounded-lg bg-accent text-xs font-black text-primary">2</span>
                                <span>Pilih data pendaftar yang sesuai dari dropdown.</span>
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

    <script>
        document.querySelectorAll('[data-ppdb-status-form]').forEach((form) => {
            const combobox = form.querySelector('[data-ppdb-combobox]');
            const lookupInput = form.querySelector('[data-ppdb-registration-lookup]');
            const registrationInput = form.querySelector('[data-ppdb-registration-number]');
            const optionsPanel = form.querySelector('[data-ppdb-options]');
            const toggleButton = form.querySelector('[data-ppdb-toggle]');
            const emptyState = form.querySelector('[data-ppdb-empty]');
            const optionButtons = Array.from(form.querySelectorAll('[data-ppdb-option]'));

            if (!combobox || !lookupInput || !registrationInput || !optionsPanel) {
                return;
            }

            const normalize = (value) => value.trim().toLowerCase();
            const showOptions = () => optionsPanel.classList.remove('hidden');
            const hideOptions = () => optionsPanel.classList.add('hidden');

            const selectOption = (option) => {
                lookupInput.value = option.dataset.label || '';
                registrationInput.value = option.dataset.registrationNumber || '';
                lookupInput.setCustomValidity('');
                hideOptions();
            };

            const findExactOption = () => {
                const search = normalize(lookupInput.value);

                return optionButtons.find((option) => normalize(option.dataset.label || '') === search)
                    || optionButtons.find((option) => normalize(option.dataset.registrationNumber || '') === search);
            };

            const getMatchingOptions = () => {
                const search = normalize(lookupInput.value);

                return optionButtons.filter((option) => normalize(option.dataset.label || '').includes(search)
                    || normalize(option.dataset.registrationNumber || '').includes(search)
                    || normalize(option.dataset.grade || '').includes(search));
            };

            const filterOptions = () => {
                const matchingOptions = getMatchingOptions();

                optionButtons.forEach((option) => {
                    option.classList.toggle('hidden', !matchingOptions.includes(option));
                });

                if (emptyState) {
                    emptyState.classList.toggle('hidden', matchingOptions.length > 0);
                }

                showOptions();
            };

            lookupInput.addEventListener('focus', filterOptions);
            lookupInput.addEventListener('input', () => {
                registrationInput.value = '';
                filterOptions();
            });

            toggleButton?.addEventListener('click', () => {
                if (optionsPanel.classList.contains('hidden')) {
                    filterOptions();
                    lookupInput.focus();
                    return;
                }

                hideOptions();
            });

            optionButtons.forEach((option) => {
                option.addEventListener('click', () => selectOption(option));
            });

            document.addEventListener('click', (event) => {
                if (!combobox.contains(event.target)) {
                    hideOptions();
                }
            });

            form.addEventListener('submit', (event) => {
                const exactOption = findExactOption();
                const matchingOptions = getMatchingOptions();

                if (exactOption) {
                    selectOption(exactOption);
                    return;
                }

                if (matchingOptions.length === 1) {
                    selectOption(matchingOptions[0]);
                    return;
                }

                if (registrationInput.value) {
                    return;
                }

                event.preventDefault();
                lookupInput.setCustomValidity('Pilih data pendaftar dari dropdown.');
                lookupInput.reportValidity();
                filterOptions();
            });
        });
    </script>
@endsection
