@extends('layouts.admin', ['title' => 'Edit Foto Galeri - Golden Sierra School', 'heading' => 'Edit Foto Galeri'])

@section('content')
    <form method="POST" action="{{ route('admin.gallery-items.update', $galleryItem) }}" class="rounded-lg border-2 border-primary/12 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.08)]">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Galeri & Dokumentasi</p>
                <h2 class="mt-2 text-2xl font-black text-primary">Edit: {{ $galleryItem->title }}</h2>
            </div>
            <x-ui.button href="{{ route('admin.gallery-items.index') }}" variant="muted" size="sm">Kembali</x-ui.button>
        </div>

        <div class="mt-6 grid gap-5">
            <div>
                <label for="title" class="text-sm font-black text-primary">Judul Foto / Keterangan Singkat</label>
                <input id="title" name="title" value="{{ old('title', $galleryItem->title) }}" placeholder="Contoh: Diskusi Kelompok di Perpustakaan" class="mt-2 h-12 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                @error('title')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="album" class="text-sm font-black text-primary">Album</label>
                <select id="album" name="album" class="mt-2 h-12 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                    <option value="Kegiatan Belajar" @selected(old('album', $galleryItem->album) === 'Kegiatan Belajar')>Kegiatan Belajar</option>
                    <option value="Prestasi Siswa" @selected(old('album', $galleryItem->album) === 'Prestasi Siswa')>Prestasi Siswa</option>
                    <option value="Ekstrakurikuler" @selected(old('album', $galleryItem->album) === 'Ekstrakurikuler')>Ekstrakurikuler</option>
                    <option value="Lingkungan Sekolah" @selected(old('album', $galleryItem->album) === 'Lingkungan Sekolah')>Lingkungan Sekolah</option>
                </select>
                @error('album')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-3">
                <label class="flex items-center gap-3 text-sm font-semibold text-slate-600">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $galleryItem->is_active)) class="size-4 rounded border-2 border-primary/25 bg-surface text-primary focus:ring-2 focus:ring-accent">
                    Tampilkan Foto Ini di Halaman Galeri
                </label>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <x-ui.button type="submit" variant="accent">Simpan Perubahan</x-ui.button>
        </div>
    </form>
@endsection
