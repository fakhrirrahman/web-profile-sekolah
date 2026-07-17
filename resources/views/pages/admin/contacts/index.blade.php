@extends('layouts.admin', ['title' => 'Pesan Masuk - Golden Sierra School', 'heading' => 'Pesan Masuk'])

@php
    $statusClasses = [
        'baru' => 'bg-blue-50 text-blue-700',
        'dibaca' => 'bg-amber-50 text-amber-800',
        'dibalas' => 'bg-green-50 text-green-700',
    ];
@endphp

@section('content')
    <section class="rounded-lg border-2 border-primary/12 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.08)]">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Kontak Sekolah</p>
                <h2 class="mt-1 text-2xl font-black text-primary">Daftar Pesan Masuk</h2>
            </div>
            <div class="rounded-lg border-2 border-primary/10 bg-surface px-4 py-3 text-sm font-black text-primary">
                {{ $messages->count() }} Pesan
            </div>
        </div>

        <div class="mt-6 overflow-x-auto rounded-lg border-2 border-primary/10">
            <table class="w-full border-collapse text-left text-sm text-slate-600">
                <thead class="border-b-2 border-primary/10 bg-surface text-xs font-black uppercase tracking-wider text-primary">
                    <tr>
                        <th class="px-6 py-4">Pengirim</th>
                        <th class="px-6 py-4">Topik</th>
                        <th class="px-6 py-4">Pesan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-primary/10 bg-white">
                    @forelse ($messages as $message)
                        <tr class="align-top transition hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <p class="font-black text-primary">{{ $message->name }}</p>
                                <p class="mt-1 text-xs font-semibold text-slate-500">{{ $message->phone }}</p>
                                <p class="mt-2 text-xs font-semibold text-slate-400">{{ $message->created_at->format('d M Y H:i') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded bg-secondary-muted px-2.5 py-1 text-xs font-bold text-secondary">{{ $message->topic }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="max-w-xl text-sm leading-7 text-slate-600">{{ $message->message }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-black {{ $statusClasses[$message->status] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ $message->status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex min-w-52 flex-col gap-2">
                                    <form method="POST" action="{{ route('admin.contact-messages.update', $message) }}" class="flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <label class="sr-only" for="contact-status-{{ $message->id }}">Status pesan</label>
                                        <select id="contact-status-{{ $message->id }}" name="status" class="min-w-0 flex-1 rounded-lg border-2 border-primary/15 bg-white px-3 py-2 text-xs font-bold text-primary outline-none focus:border-primary">
                                            @foreach ($statuses as $value => $label)
                                                <option value="{{ $value }}" @selected($message->status === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <x-ui.button type="submit" variant="outline" size="sm">Simpan</x-ui.button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.contact-messages.destroy', $message) }}"
                                        data-confirm
                                        data-confirm-title="Hapus pesan?"
                                        data-confirm-text="Pesan dari {{ $message->name }} akan dihapus dari daftar pesan masuk.">
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
                            <td colspan="5" class="px-6 py-12 text-center font-semibold text-slate-400">
                                Belum ada pesan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
