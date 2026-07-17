<x-ui.modal :id="$id">
    @slot('trigger')
        <x-ui.button @click="open = true" :variant="$buttonVariant" size="sm" class="w-full sm:w-auto">
            {{ $triggerLabel }}
        </x-ui.button>
    @endslot

    <div class="mb-5 border-b-2 border-primary/8 pb-4">
        <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary text-start">Berita & Kegiatan</p>
        <h2 class="mt-1 text-xl font-black text-primary text-start">{{ $modalTitle }}</h2>
    </div>

    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="grid gap-4">
            <div>
                <label for="{{ $titleId }}" class="text-xs font-black uppercase tracking-wide text-primary/70">Judul Berita</label>
                <input id="{{ $titleId }}" name="title" value="{{ old('title', $news?->title) }}" placeholder="Contoh: Siswa Raih Juara Lomba"
                    class="mt-1.5 h-10 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                @error('title')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="{{ $categoryId }}" class="text-xs font-black uppercase tracking-wide text-primary/70">Kategori</label>
                    <select id="{{ $categoryId }}" name="category"
                        class="mt-1.5 h-10 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                        @foreach ($categoryOptions as $category)
                            <option value="{{ $category }}" @selected(old('category', $news?->category) === $category)>{{ $category }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="{{ $dateId }}" class="text-xs font-black uppercase tracking-wide text-primary/70">Tanggal Tampil</label>
                    <input id="{{ $dateId }}" name="date" value="{{ old('date', $defaultDate) }}" placeholder="Contoh: 11 Juni 2026"
                        class="mt-1.5 h-10 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                    @error('date')
                        <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="text-xs font-black uppercase tracking-wide text-primary/70">Gambar</label>

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
                                <span class="font-black text-primary">Gambar saat ini</span> klik untuk ganti gambar
                            @else
                                <span class="font-black text-primary">Klik untuk pilih gambar</span> atau seret & lepas di sini
                            @endif
                        </p>
                        <p id="{{ $dzMetaId }}" class="{{ $currentImageUrl ? '' : 'hidden' }} truncate text-[11px] font-semibold text-slate-400">
                            {{ $currentImageName }}
                        </p>
                    </div>

                    <button type="button" id="{{ $btnRemoveId }}" aria-label="Hapus gambar"
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

            <div>
                <label for="{{ $copyId }}" class="text-xs font-black uppercase tracking-wide text-primary/70">Isi Berita</label>
                <textarea id="{{ $copyId }}" name="copy" rows="6" placeholder="Tuliskan isi berita di sini..."
                    class="mt-1.5 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 py-2 text-sm font-semibold leading-6 text-slate-700 outline-none transition focus:border-accent focus:bg-white">{{ old('copy', $news?->copy) }}</textarea>
                @error('copy')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 flex flex-col gap-3 border-t-2 border-primary/8 pt-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="grid gap-2">
                <label class="flex items-center gap-2 text-xs font-bold text-slate-600">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $news?->is_featured ?? false))
                        class="size-4 rounded border-2 border-primary/25 bg-surface text-primary focus:ring-2 focus:ring-accent">
                    Jadikan Berita Utama
                </label>

                <label class="flex items-center gap-2 text-xs font-bold text-slate-600">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $news?->is_active ?? true))
                        class="size-4 rounded border-2 border-primary/25 bg-surface text-primary focus:ring-2 focus:ring-accent">
                    Tampilkan Berita Ini
                </label>
            </div>

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

                dzPreview.src = URL.createObjectURL(file);
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
                    '<span class="font-black text-primary">Klik untuk pilih gambar</span> atau seret & lepas di sini';
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
