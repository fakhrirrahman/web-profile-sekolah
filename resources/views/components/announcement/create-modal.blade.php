<x-ui.modal :id="$id">
    @slot('trigger')
        <x-ui.button @click="open = true" :variant="$buttonVariant" size="sm" class="w-full sm:w-auto">
            {{ $triggerLabel }}
        </x-ui.button>
    @endslot

    <div class="mb-5 border-b-2 border-primary/8 pb-4">
        <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary text-start">Pengumuman</p>
        <h2 class="mt-1 text-xl font-black text-primary text-start">{{ $modalTitle }}</h2>
    </div>

    <form method="POST" action="{{ $action }}">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="grid gap-4">
            <div>
                <label for="{{ $titleId }}" class="text-xs font-black uppercase tracking-wide text-primary/70">Judul Pengumuman</label>
                <input id="{{ $titleId }}" name="title" value="{{ old('title', $announcement?->title) }}" placeholder="Contoh: PPDB Tahun Ajaran 2026/2027"
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
                            <option value="{{ $category }}" @selected(old('category', $announcement?->category) === $category)>{{ $category }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="{{ $dateId }}" class="text-xs font-black uppercase tracking-wide text-primary/70">Tanggal Tampil</label>
                    <input id="{{ $dateId }}" name="date" value="{{ old('date', $defaultDate) }}" placeholder="Contoh: 16 Juli 2026"
                        class="mt-1.5 h-10 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                    @error('date')
                        <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="{{ $copyId }}" class="text-xs font-black uppercase tracking-wide text-primary/70">Isi Pengumuman</label>
                <textarea id="{{ $copyId }}" name="copy" rows="6" placeholder="Tuliskan isi pengumuman di sini..."
                    class="mt-1.5 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 py-2 text-sm font-semibold leading-6 text-slate-700 outline-none transition focus:border-accent focus:bg-white">{{ old('copy', $announcement?->copy) }}</textarea>
                @error('copy')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 flex flex-col gap-3 border-t-2 border-primary/8 pt-4 sm:flex-row sm:items-center sm:justify-between">
            <label class="flex items-center gap-2 text-xs font-bold text-slate-600">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $announcement?->is_active ?? true))
                    class="size-4 rounded border-2 border-primary/25 bg-surface text-primary focus:ring-2 focus:ring-accent">
                Tampilkan Pengumuman Ini
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
</x-ui.modal>
