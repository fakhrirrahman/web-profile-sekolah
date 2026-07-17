@extends('layouts.admin', ['title' => 'Kelola Berita - Golden Sierra School', 'heading' => 'Kelola Berita'])

@section('content')
    <section class="rounded-lg border-2 border-primary/12 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.08)]">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Berita & Kegiatan</p>
                <h2 class="mt-1 text-2xl font-black text-primary">Daftar Berita</h2>
            </div>
            <x-news.create-modal />
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
                    @forelse ($newsItems as $news)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-black text-primary">
                                <div class="flex items-center gap-2">
                                    @if ($news->is_featured)
                                        <span class="rounded bg-accent/20 px-2 py-0.5 text-[10px] font-black uppercase text-secondary">Utama</span>
                                    @endif
                                    {{ $news->title }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded bg-secondary-muted px-2.5 py-1 text-xs font-bold text-secondary">{{ $news->category }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold">{{ $news->date }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2 py-1 text-xs font-semibold {{ $news->is_active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                    <span class="size-1.5 rounded-full {{ $news->is_active ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                    {{ $news->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <x-admin.action-menu>
                                    <x-news.create-modal :news="$news" :id="'news-edit-modal-' . $news->id" />
                                    <form method="POST" action="{{ route('admin.news.destroy', $news) }}"
                                        data-confirm
                                        data-confirm-title="Hapus berita?"
                                        data-confirm-text="Berita {{ $news->title }} akan dihapus dari daftar berita.">
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
                                Belum ada berita yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
