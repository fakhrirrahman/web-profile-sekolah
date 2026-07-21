@extends('layouts.admin', ['title' => 'Kelola Pengumuman - Golden Sierra School', 'heading' => 'Kelola Pengumuman'])

@section('content')
    <section class="rounded-lg border-2 border-primary/12 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.08)]">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Informasi Sekolah</p>
                <h2 class="mt-1 text-2xl font-black text-primary">Daftar Pengumuman</h2>
            </div>
            <x-announcement.create-modal />
        </div>

        <div class="mt-6 overflow-x-auto rounded-lg border-2 border-primary/10">
            <table class="w-full border-collapse text-left text-sm text-slate-600">
                <thead class="bg-surface text-xs font-black uppercase tracking-wider text-primary border-b-2 border-primary/10">
                    <tr>
                        <th class="px-6 py-4">Judul</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-primary/10 bg-white">
                    @forelse ($announcements as $announcement)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <p class="font-black text-primary">{{ $announcement->title }}</p>
                                <p class="mt-1 text-xs font-semibold {{ $announcement->is_pdf ? 'text-secondary' : 'text-slate-500' }}">
                                    {{ $announcement->is_pdf ? 'Dokumen PDF' : 'Teks pengumuman' }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded bg-secondary-muted px-2.5 py-1 text-xs font-bold text-secondary">{{ $announcement->category }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold">{{ $announcement->date }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2 py-1 text-xs font-semibold {{ $announcement->is_active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                    <span class="size-1.5 rounded-full {{ $announcement->is_active ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                    {{ $announcement->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <x-admin.action-menu>
                                    <x-announcement.create-modal :announcement="$announcement" :id="'announcement-edit-modal-' . $announcement->id" />
                                    <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}"
                                        data-confirm
                                        data-confirm-title="Hapus pengumuman?"
                                        data-confirm-text="Pengumuman {{ $announcement->title }} akan dihapus dari daftar pengumuman.">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button type="submit" variant="muted" size="sm" class="w-full hover:border-red-200 hover:bg-red-50 hover:text-red-700">
                                            Hapus
                                        </x-ui.button>
                                    </form>
                                </x-admin.action-menu>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-semibold">
                                Belum ada pengumuman yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
