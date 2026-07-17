@extends('layouts.admin', ['title' => 'Kelola Galeri - Golden Sierra School', 'heading' => 'Kelola Galeri'])

@section('content')
    <section class="rounded-lg border-2 border-primary/12 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.08)]">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Galeri & Dokumentasi</p>
                <h2 class="mt-1 text-2xl font-black text-primary">Daftar Foto Galeri</h2>
            </div>
            <x-gallery.create-modal />
        </div>

        <div class="mt-6 overflow-x-auto rounded-lg border-2 border-primary/10">
            <table class="w-full border-collapse text-left text-sm text-slate-600">
                <thead
                    class="bg-surface text-xs font-black uppercase tracking-wider text-primary border-b-2 border-primary/10">
                    <tr>
                        <th class="px-6 py-4">Judul Foto / Dokumentasi</th>
                        <th class="px-6 py-4">Album</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-primary/10 bg-white">
                    @forelse ($galleryItems as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-black text-primary">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-10 shrink-0 bg-secondary-muted rounded border border-primary/10 flex items-center justify-center text-xs font-black text-secondary">
                                        @if ($item->image_url)
                                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                                class="size-10 rounded object-cover border border-primary/10">
                                        @else
                                            <div
                                                class="size-10 shrink-0 bg-secondary-muted rounded border border-primary/10 flex items-center justify-center text-xs font-black text-secondary">
                                                NO
                                            </div>
                                        @endif
                                    </div>
                                    {{ $item->title }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="rounded bg-secondary-muted px-2.5 py-1 text-xs font-bold text-secondary">{{ $item->album }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full px-2 py-1 text-xs font-semibold {{ $item->is_active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                    <span
                                        class="size-1.5 rounded-full {{ $item->is_active ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <x-gallery.create-modal :gallery-item="$item" :id="'gallery-edit-modal-' . $item->id" />
                                    <form method="POST" action="{{ route('admin.gallery-items.destroy', $item) }}"
                                        data-confirm
                                        data-confirm-title="Hapus foto galeri?"
                                        data-confirm-text="Foto {{ $item->title }} akan dihapus dari daftar galeri.">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.button type="submit" variant="muted" size="sm"
                                            class="hover:border-red-200 hover:bg-red-50 hover:text-red-700">
                                            Hapus
                                        </x-ui.button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400 font-semibold">
                                Belum ada foto galeri yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
