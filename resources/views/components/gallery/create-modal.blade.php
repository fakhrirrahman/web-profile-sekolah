@props([
    'id' => 'gallery-create-modal',
    'galleryItem' => null,
    'triggerLabel' => null,
    'buttonVariant' => null,
])

@php
    $isEdit = filled($galleryItem?->getKey());
    $modalTitle = $isEdit ? 'Edit Foto' : 'Tambah Foto Baru';
    $submitLabel = $isEdit ? 'Simpan Perubahan' : 'Tambah Foto';
    $triggerLabel ??= $isEdit ? 'Edit' : 'Tambah Foto';
    $buttonVariant ??= $isEdit ? 'outline' : 'accent';
    $action = $isEdit
        ? route('admin.gallery-items.update', $galleryItem)
        : route('admin.gallery-items.store');
    $fieldPrefix = str_replace(['.', '[', ']'], '-', $id);
    $titleId = $fieldPrefix . '-title';
    $albumId = $fieldPrefix . '-album';
    $dropzoneId = $fieldPrefix . '-dropzone';
    $dzIconId = $fieldPrefix . '-dz-icon';
    $dzPreviewId = $fieldPrefix . '-dz-preview';
    $dzTextId = $fieldPrefix . '-dz-text';
    $dzMetaId = $fieldPrefix . '-dz-meta';
    $btnRemoveId = $fieldPrefix . '-btn-remove';
    $imageId = $fieldPrefix . '-image';
    $removeImageId = $fieldPrefix . '-remove-image';
    $currentImageUrl = $isEdit && $galleryItem->image
        ? \Illuminate\Support\Facades\Storage::disk('public')->url($galleryItem->image)
        : null;
@endphp

<x-ui.modal :id="$id">
    @slot('trigger')
        <x-ui.button @click="open = true" :variant="$buttonVariant" size="sm" class="w-full sm:w-auto">
            {{ $triggerLabel }}
        </x-ui.button>
    @endslot

    <!-- Modal Header -->
    <div class="mb-5 border-b-2 border-primary/8 pb-4">
        <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary text-start">Galeri & Dokumentasi</p>
        <h2 class="mt-1 text-xl font-black text-primary text-start">{{ $modalTitle }}</h2>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="grid gap-4 sm:grid-cols-2">
            <!-- Title Input -->
            <div>
                <label for="{{ $titleId }}" class="text-xs font-black uppercase tracking-wide text-primary/70">Judul Foto</label>
                <input id="{{ $titleId }}" name="title" value="{{ old('title', $galleryItem?->title) }}" placeholder="Contoh: Diskusi Kelompok"
                    class="mt-1.5 h-10 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                @error('title')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Album Select -->
            <div>
                <label for="{{ $albumId }}" class="text-xs font-black uppercase tracking-wide text-primary/70">Album</label>
                <select id="{{ $albumId }}" name="album"
                    class="mt-1.5 h-10 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                    <option value="Kegiatan Belajar" @selected(old('album', $galleryItem?->album) === 'Kegiatan Belajar')>Kegiatan Belajar</option>
                    <option value="Prestasi Siswa" @selected(old('album', $galleryItem?->album) === 'Prestasi Siswa')>Prestasi Siswa</option>
                    <option value="Ekstrakurikuler" @selected(old('album', $galleryItem?->album) === 'Ekstrakurikuler')>Ekstrakurikuler</option>
                    <option value="Lingkungan Sekolah" @selected(old('album', $galleryItem?->album) === 'Lingkungan Sekolah')>Lingkungan Sekolah</option>
                </select>
                @error('album')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Image Upload Dropzone -->
        <div class="mt-4">
            <label class="text-xs font-black uppercase tracking-wide text-primary/70">Foto</label>

            <div id="{{ $dropzoneId }}"
                class="mt-1.5 flex cursor-pointer items-center gap-3 rounded-lg border-2 border-dashed border-primary/25 bg-surface px-4 py-3 transition hover:border-primary/50 hover:bg-primary/[.03]">
                <div id="{{ $dzIconId }}"
                    class="{{ $currentImageUrl ? 'hidden' : 'flex' }} size-9 shrink-0 items-center justify-center rounded-md bg-primary/8 text-primary/50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 8.25 12 3.75m0 0L7.5 8.25M12 3.75v12" />
                    </svg>
                </div>
                <img id="{{ $dzPreviewId }}" src="{{ $currentImageUrl ?? '' }}" alt="" class="{{ $currentImageUrl ? '' : 'hidden' }} size-9 shrink-0 rounded-md object-cover">

                <div class="min-w-0 flex-1">
                    <p id="{{ $dzTextId }}" class="text-xs font-semibold text-slate-500">
                        @if ($currentImageUrl)
                            <span class="font-black text-primary">Foto saat ini</span> klik untuk ganti foto
                        @else
                            <span class="font-black text-primary">Klik untuk pilih foto</span> atau seret & lepas di sini
                        @endif
                    </p>
                    <p id="{{ $dzMetaId }}" class="{{ $currentImageUrl ? '' : 'hidden' }} truncate text-[11px] font-semibold text-slate-400">
                        {{ $currentImageUrl ? basename($galleryItem->image) : '' }}
                    </p>
                </div>

                <button type="button" id="{{ $btnRemoveId }}" aria-label="Hapus foto"
                    class="{{ $currentImageUrl ? 'flex' : 'hidden' }} shrink-0 items-center justify-center rounded-full bg-red-50 px-2.5 py-1 text-xs font-black text-red-600 transition hover:bg-red-100">
                    Hapus
                </button>

                <input id="{{ $imageId }}" name="image" type="file" accept="image/*" class="hidden">
                <input id="{{ $removeImageId }}" name="remove_image" type="hidden" value="0">
            </div>

            @error('image')
                <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Active Checkbox & Submit -->
        <div class="mt-4 flex flex-col gap-3 border-t-2 border-primary/8 pt-4 sm:flex-row sm:items-center sm:justify-between">
            <label class="flex items-center gap-2 text-xs font-bold text-slate-600">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $galleryItem?->is_active ?? true))
                    class="size-4 rounded border-2 border-primary/25 bg-surface text-primary focus:ring-2 focus:ring-accent">
                Tampilkan di Halaman Galeri
            </label>

            <div class="flex gap-2 sm:justify-end">
                <x-ui.button type="button" @click="open = false; document.dispatchEvent(new CustomEvent('close-modal', { detail: { id: '{{ $id }}' } }))"
                    variant="muted" size="sm">
                    Batal
                </x-ui.button>
                <x-ui.button type="submit" variant="accent" size="sm">
                    {{ $submitLabel }}
                </x-ui.button>
            </div>
        </div>
    </form>

    <script>
        (function() {
            const dropzone = document.getElementById(@json($dropzoneId));
            const input = document.getElementById(@json($imageId));
            const removeImageInput = document.getElementById(@json($removeImageId));
            const dzIcon = document.getElementById(@json($dzIconId));
            const dzPreview = document.getElementById(@json($dzPreviewId));
            const dzText = document.getElementById(@json($dzTextId));
            const dzMeta = document.getElementById(@json($dzMetaId));
            const btnRemove = document.getElementById(@json($btnRemoveId));

            dropzone.addEventListener('click', (e) => {
                if (e.target === btnRemove) return;
                input.click();
            });

            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('border-primary', 'bg-primary/[.05]');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('border-primary', 'bg-primary/[.05]');
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('border-primary', 'bg-primary/[.05]');
                if (e.dataTransfer.files[0]) setFile(e.dataTransfer.files[0]);
            });

            input.addEventListener('change', () => {
                if (input.files[0]) setFile(input.files[0]);
            });

            btnRemove.addEventListener('click', (e) => {
                e.stopPropagation();
                clearFile();
            });

            function setFile(file) {
                if (!file.type.startsWith('image/')) return;

                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;

                const url = URL.createObjectURL(file);
                dzPreview.src = url;
                dzPreview.classList.remove('hidden');
                dzIcon.classList.add('hidden');
                removeImageInput.value = '0';

                dzText.innerHTML = `<span class="font-black text-primary">${file.name}</span>`;
                dzMeta.textContent = formatSize(file.size);
                dzMeta.classList.remove('hidden');

                btnRemove.classList.remove('hidden');
                btnRemove.classList.add('flex');
            }

            function clearFile() {
                input.value = '';
                dzPreview.src = '';
                dzPreview.classList.add('hidden');
                dzIcon.classList.remove('hidden');
                removeImageInput.value = '1';
                dzText.innerHTML =
                    '<span class="font-black text-primary">Klik untuk pilih foto</span> atau seret & lepas di sini';
                dzMeta.classList.add('hidden');
                btnRemove.classList.add('hidden');
                btnRemove.classList.remove('flex');
            }

            function formatSize(bytes) {
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(0) + ' KB';
                return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
            }
        })();
    </script>
</x-ui.modal>
