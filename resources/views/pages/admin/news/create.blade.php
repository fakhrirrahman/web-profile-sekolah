@extends('layouts.admin', ['title' => 'Tambah Berita - Golden Sierra School', 'heading' => 'Tambah Berita'])

@section('content')
    <form method="POST" action="{{ route('admin.news.store') }}" class="rounded-lg border-2 border-primary/12 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.08)]">
        @csrf

        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Berita & Kegiatan</p>
                <h2 class="mt-2 text-2xl font-black text-primary">Tulis Berita Baru</h2>
            </div>
            <x-ui.button href="{{ route('admin.news.index') }}" variant="muted" size="sm">Kembali</x-ui.button>
        </div>

        <div class="mt-6 grid gap-5">
            <div>
                <label for="title" class="text-sm font-black text-primary">Judul Berita</label>
                <input id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Siswa Raih Juara Lomba" class="mt-2 h-12 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                @error('title')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="category" class="text-sm font-black text-primary">Kategori</label>
                    <select id="category" name="category" class="mt-2 h-12 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                        <option value="Prestasi" @selected(old('category') === 'Prestasi')>Prestasi</option>
                        <option value="Kegiatan" @selected(old('category') === 'Kegiatan')>Kegiatan</option>
                        <option value="Akademik" @selected(old('category') === 'Akademik')>Akademik</option>
                        <option value="Info Orang Tua" @selected(old('category') === 'Info Orang Tua')>Info Orang Tua</option>
                    </select>
                    @error('category')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date" class="text-sm font-black text-primary">Tanggal Tampil</label>
                    <input id="date" name="date" value="{{ old('date', now()->isoFormat('D MMMM Y')) }}" placeholder="Contoh: 11 Juni 2026" class="mt-2 h-12 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                    @error('date')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="copy" class="text-sm font-black text-primary">Isi Berita</label>
                <textarea id="copy" name="copy" rows="8" placeholder="Tuliskan isi berita di sini..." class="mt-2 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition focus:border-accent focus:bg-white">{{ old('copy') }}</textarea>
                @error('copy')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-3">
                <label class="flex items-center gap-3 text-sm font-semibold text-slate-600">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured')) class="size-4 rounded border-2 border-primary/25 bg-surface text-primary focus:ring-2 focus:ring-accent">
                    Jadikan Berita Utama (Featured)
                </label>

                <label class="flex items-center gap-3 text-sm font-semibold text-slate-600">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true)) class="size-4 rounded border-2 border-primary/25 bg-surface text-primary focus:ring-2 focus:ring-accent">
                    Tampilkan Berita Ini
                </label>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <x-ui.button type="submit" variant="accent">Tambah Berita</x-ui.button>
        </div>
    </form>
@endsection
