@extends('layouts.admin', ['title' => 'Kelola PPDB - Golden Sierra School', 'heading' => 'Kelola PPDB'])

@php
    $statusClasses = [
        'baru' => 'bg-blue-50 text-blue-700',
        'dihubungi' => 'bg-amber-50 text-amber-800',
        'observasi' => 'bg-secondary-muted text-secondary',
        'lolos_berkas' => 'bg-emerald-50 text-emerald-700',
        'tidak_lolos_berkas' => 'bg-rose-50 text-rose-700',
        'tes_akademik' => 'bg-indigo-50 text-indigo-700',
        'wawancara' => 'bg-cyan-50 text-cyan-700',
        'diterima' => 'bg-green-50 text-green-700',
        'ditolak' => 'bg-red-50 text-red-700',
    ];

    $statusDots = [
        'baru' => 'bg-blue-500',
        'dihubungi' => 'bg-amber-500',
        'observasi' => 'bg-secondary',
        'lolos_berkas' => 'bg-emerald-500',
        'tidak_lolos_berkas' => 'bg-rose-500',
        'tes_akademik' => 'bg-indigo-500',
        'wawancara' => 'bg-cyan-500',
        'diterima' => 'bg-green-500',
        'ditolak' => 'bg-red-500',
    ];

    $activeFilters = array_filter($filters ?? [], fn ($value) => filled($value));
@endphp

@section('content')
    <section class="rounded-lg border-2 border-primary/12 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.08)]">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Penerimaan Peserta Didik Baru</p>
                <h2 class="mt-1 text-2xl font-black text-primary">Data Pendaftar</h2>
            </div>
            <div class="rounded-lg border-2 border-primary/10 bg-surface px-4 py-3 text-sm font-black text-primary">
                {{ $registrations->count() }} Pendaftar
            </div>
        </div>

        <form method="GET" action="{{ route('admin.ppdb-registrations.index') }}" class="mt-6 grid gap-3 rounded-lg border-2 border-primary/10 bg-surface p-4 lg:grid-cols-[minmax(14rem,1fr)_13rem_13rem_auto] lg:items-end">
            <div>
                <label for="search" class="text-xs font-black uppercase tracking-wide text-primary">Cari Data</label>
                <input id="search" name="search" value="{{ $filters['search'] ?? '' }}" type="search" class="mt-2 w-full rounded-lg border-2 border-primary/15 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-primary" placeholder="Nama, nomor PPDB, orang tua, WA, email">
            </div>

            <div>
                <label for="status" class="text-xs font-black uppercase tracking-wide text-primary">Status</label>
                <select id="status" name="status" class="mt-2 w-full rounded-lg border-2 border-primary/15 bg-white px-4 py-3 text-sm font-semibold text-slate-700 outline-none transition focus:border-primary">
                    <option value="">Semua status</option>
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}" @selected(($filters['status'] ?? '') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="grade" class="text-xs font-black uppercase tracking-wide text-primary">Jenjang</label>
                <select id="grade" name="grade" class="mt-2 w-full rounded-lg border-2 border-primary/15 bg-white px-4 py-3 text-sm font-semibold text-slate-700 outline-none transition focus:border-primary">
                    <option value="">Semua jenjang</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade }}" @selected(($filters['grade'] ?? '') === $grade)>{{ $grade }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-2 sm:flex-row lg:justify-end">
                <x-ui.button type="submit" variant="primary" size="md">Terapkan</x-ui.button>
                <x-ui.button href="{{ route('admin.ppdb-registrations.index') }}" variant="muted" size="md">Reset</x-ui.button>
                <x-ui.button href="{{ route('admin.ppdb-registrations.pdf', $activeFilters) }}" variant="accent" size="md">
                    <x-ui.icon name="download" class="size-4" />
                    Cetak PDF
                </x-ui.button>
            </div>
        </form>

        <div class="mt-6 overflow-x-auto rounded-lg border-2 border-primary/10">
            <table class="w-full border-collapse text-left text-sm text-slate-600">
                <thead
                    class="border-b-2 border-primary/10 bg-surface text-xs font-black uppercase tracking-wider text-primary">
                    <tr>
                        <th class="px-6 py-4">Pendaftar</th>
                        <th class="px-6 py-4">Calon Siswa</th>
                        <th class="px-6 py-4">Jenjang</th>
                        <th class="px-6 py-4">Kontak</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-primary/10 bg-white">
                    @forelse ($registrations as $registration)
                        <tr class="align-top transition hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <p class="font-black text-primary">{{ $registration->registration_number }}</p>
                                <p class="mt-1 text-xs font-semibold text-slate-500">
                                    {{ $registration->created_at->format('d M Y H:i') }}</p>
                                <p class="mt-3 text-xs font-black uppercase tracking-wide text-secondary">Orang tua</p>
                                <p class="mt-1 font-bold text-slate-700">{{ $registration->parent_name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-black text-primary">{{ $registration->student_name }}</p>
                                <p class="mt-1 text-xs font-semibold text-slate-500">
                                    {{ $registration->gender }} · {{ $registration->birth_place }},
                                    {{ $registration->birth_date->format('d M Y') }}
                                </p>
                                @if ($registration->previous_school)
                                    <p class="mt-2 text-xs leading-5 text-slate-500">Asal sekolah:
                                        {{ $registration->previous_school }}</p>
                                @endif
                                <p class="mt-2 max-w-xs text-xs leading-5 text-slate-500">{{ $registration->address }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="rounded bg-secondary-muted px-2.5 py-1 text-xs font-bold text-secondary">{{ $registration->desired_grade }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-primary">{{ $registration->phone }}</p>
                                @if ($registration->email)
                                    <p class="mt-1 text-xs font-semibold text-slate-500">{{ $registration->email }}</p>
                                @endif
                                @if ($registration->notes)
                                    <p class="mt-3 max-w-xs rounded bg-surface p-3 text-xs leading-5 text-slate-600">
                                        {{ $registration->notes }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-full px-2.5 py-1 text-xs font-black {{ $statusClasses[$registration->status] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ $registration->status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @php
                                    $currentOrder = \App\Models\PpdbRegistration::STATUS_ORDER[$registration->status];
                                    $isFinalStatus = in_array(
                                        $registration->status,
                                        \App\Models\PpdbRegistration::FINAL_STATUSES,
                                        true,
                                    );
                                @endphp

                                <x-admin.action-menu>
                                    @if ($isFinalStatus)
                                        <div class="rounded-lg bg-surface px-3 py-2 text-xs font-bold leading-5 text-slate-600">
                                            Status akhir tidak dapat diubah.
                                        </div>
                                    @else
                                        <button type="button"
                                            data-status-dialog-open="status-dialog-{{ $registration->id }}"
                                            class="inline-flex h-9 w-full items-center justify-start rounded-lg border-2 border-primary/15 bg-white px-3 text-xs font-black uppercase tracking-wide text-primary transition hover:border-primary/35 hover:bg-secondary-muted focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-accent">
                                            Ubah Status
                                        </button>
                                    @endif

                                    <form method="POST"
                                        action="{{ route('admin.ppdb-registrations.destroy', $registration) }}"
                                        data-confirm data-confirm-title="Hapus data PPDB?"
                                        data-confirm-text="Data pendaftaran {{ $registration->registration_number }} milik {{ $registration->student_name }} akan dihapus.">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button type="submit" variant="muted" size="sm"
                                            class="w-full hover:border-red-200 hover:bg-red-50 hover:text-red-700">
                                            Hapus
                                        </x-ui.button>
                                    </form>
                                </x-admin.action-menu>

                                @unless ($isFinalStatus)
                                    <dialog id="status-dialog-{{ $registration->id }}" data-status-dialog
                                        class="m-auto w-[min(100%-2rem,38rem)] overflow-hidden rounded-lg border-2 border-primary/15 bg-white p-0 text-left text-slate-600 shadow-[8px_8px_0_rgba(31,92,69,.14)] backdrop:bg-primary/30 backdrop:backdrop-blur-sm">
                                        <div class="border-b-2 border-primary/10 bg-surface px-5 py-4">
                                            <div class="flex items-start justify-between gap-4">
                                                <div>
                                                    <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">
                                                        Ubah Status PPDB
                                                    </p>
                                                    <h3 class="mt-1 text-xl font-black text-primary">
                                                        {{ $registration->student_name }}
                                                    </h3>
                                                    <p class="mt-1 text-xs font-bold text-slate-500">
                                                        {{ $registration->registration_number }}
                                                    </p>
                                                </div>
                                                <form method="dialog">
                                                    <button type="submit"
                                                        class="rounded-lg border-2 border-primary/15 bg-white px-3 py-2 text-xs font-black text-primary transition hover:bg-secondary-muted focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-accent">
                                                        Tutup
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <form method="POST"
                                            action="{{ route('admin.ppdb-registrations.update', $registration) }}"
                                            class="p-5">
                                            @csrf
                                            @method('PUT')

                                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                                <p class="text-sm font-bold text-slate-600">Pilih tahap berikutnya:</p>
                                                <span
                                                    class="inline-flex w-fit rounded-full px-2.5 py-1 text-xs font-black {{ $statusClasses[$registration->status] ?? 'bg-slate-100 text-slate-700' }}">
                                                    Sekarang: {{ $registration->status_label }}
                                                </span>
                                            </div>

                                            <fieldset class="mt-4">
                                                <legend class="sr-only">Status PPDB</legend>
                                                <div class="grid max-h-[52vh] gap-2 overflow-y-auto pr-1 sm:grid-cols-2">
                                                    @foreach ($statuses as $value => $label)
                                                        @if (\App\Models\PpdbRegistration::STATUS_ORDER[$value] >= $currentOrder)
                                                            <label
                                                                class="flex min-h-12 cursor-pointer items-center gap-3 rounded-lg border-2 border-primary/10 bg-white px-3 py-2 transition hover:border-primary/30 hover:bg-secondary-muted has-[:checked]:border-primary/55 has-[:checked]:bg-secondary-muted has-[:checked]:shadow-[3px_3px_0_rgba(31,92,69,.10)]">
                                                                <input type="radio" name="status" value="{{ $value }}"
                                                                    class="peer sr-only" @checked($registration->status === $value)>
                                                                <span
                                                                    class="grid size-5 shrink-0 place-items-center rounded-full border-2 border-primary/20 bg-white transition peer-checked:border-primary peer-checked:bg-primary">
                                                                    <span class="size-2 rounded-full bg-white"></span>
                                                                </span>
                                                                <span class="min-w-0">
                                                                    <span class="flex items-center gap-2 text-xs font-black text-primary">
                                                                        <span
                                                                            class="size-2 rounded-full {{ $statusDots[$value] ?? 'bg-slate-400' }}"></span>
                                                                        <span class="truncate">{{ $label }}</span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </fieldset>

                                            <div class="mt-5 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                                                <button type="button" data-status-dialog-close
                                                    class="inline-flex h-10 items-center justify-center rounded-lg border-2 border-primary/20 bg-white px-4 text-xs font-black uppercase tracking-wide text-primary transition hover:bg-secondary-muted focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-accent">
                                                    Batal
                                                </button>
                                                <x-ui.button type="submit" variant="primary" size="md">
                                                    Simpan Status
                                                </x-ui.button>
                                            </div>
                                        </form>
                                    </dialog>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center font-semibold text-slate-400">
                                Belum ada pendaftar PPDB.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <script>
        document.addEventListener('click', (event) => {
            const openButton = event.target.closest('[data-status-dialog-open]');
            const closeButton = event.target.closest('[data-status-dialog-close]');

            if (openButton) {
                const dialog = document.getElementById(openButton.dataset.statusDialogOpen);

                if (dialog instanceof HTMLDialogElement) {
                    document
                        .querySelectorAll('[data-admin-action-menu]')
                        .forEach((menu) => menu.removeAttribute('open'));
                    dialog.showModal();
                }
            }

            if (closeButton) {
                closeButton.closest('dialog')?.close();
            }

            if (event.target.matches('[data-status-dialog]')) {
                event.target.close();
            }
        });
    </script>
@endsection
