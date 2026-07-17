@extends('layouts.admin', ['title' => 'Kelola PPDB - Golden Sierra School', 'heading' => 'Kelola PPDB'])

@php
    $statusClasses = [
        'baru' => 'bg-blue-50 text-blue-700',
        'dihubungi' => 'bg-amber-50 text-amber-800',
        'observasi' => 'bg-secondary-muted text-secondary',
        'diterima' => 'bg-green-50 text-green-700',
        'ditolak' => 'bg-red-50 text-red-700',
    ];
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

        <div class="mt-6 overflow-x-auto rounded-lg border-2 border-primary/10">
            <table class="w-full border-collapse text-left text-sm text-slate-600">
                <thead class="border-b-2 border-primary/10 bg-surface text-xs font-black uppercase tracking-wider text-primary">
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
                                <p class="mt-1 text-xs font-semibold text-slate-500">{{ $registration->created_at->format('d M Y H:i') }}</p>
                                <p class="mt-3 text-xs font-black uppercase tracking-wide text-secondary">Orang tua</p>
                                <p class="mt-1 font-bold text-slate-700">{{ $registration->parent_name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-black text-primary">{{ $registration->student_name }}</p>
                                <p class="mt-1 text-xs font-semibold text-slate-500">
                                    {{ $registration->gender }} · {{ $registration->birth_place }}, {{ $registration->birth_date->format('d M Y') }}
                                </p>
                                @if ($registration->previous_school)
                                    <p class="mt-2 text-xs leading-5 text-slate-500">Asal sekolah: {{ $registration->previous_school }}</p>
                                @endif
                                <p class="mt-2 max-w-xs text-xs leading-5 text-slate-500">{{ $registration->address }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded bg-secondary-muted px-2.5 py-1 text-xs font-bold text-secondary">{{ $registration->desired_grade }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-primary">{{ $registration->phone }}</p>
                                @if ($registration->email)
                                    <p class="mt-1 text-xs font-semibold text-slate-500">{{ $registration->email }}</p>
                                @endif
                                @if ($registration->notes)
                                    <p class="mt-3 max-w-xs rounded bg-surface p-3 text-xs leading-5 text-slate-600">{{ $registration->notes }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-black {{ $statusClasses[$registration->status] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ $registration->status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex min-w-56 flex-col gap-2">
                                    <form method="POST" action="{{ route('admin.ppdb-registrations.update', $registration) }}" class="flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <label class="sr-only" for="status-{{ $registration->id }}">Status PPDB</label>
                                        <select id="status-{{ $registration->id }}" name="status" class="min-w-0 flex-1 rounded-lg border-2 border-primary/15 bg-white px-3 py-2 text-xs font-bold text-primary outline-none focus:border-primary">
                                            @foreach ($statuses as $value => $label)
                                                <option value="{{ $value }}" @selected($registration->status === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <x-ui.button type="submit" variant="outline" size="sm">Simpan</x-ui.button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.ppdb-registrations.destroy', $registration) }}"
                                        data-confirm
                                        data-confirm-title="Hapus data PPDB?"
                                        data-confirm-text="Data pendaftaran {{ $registration->registration_number }} milik {{ $registration->student_name }} akan dihapus.">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button type="submit" variant="muted" size="sm" class="w-full hover:border-red-200 hover:bg-red-50 hover:text-red-700">
                                            Hapus
                                        </x-ui.button>
                                    </form>
                                </div>
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
@endsection
