<!-- 
FILE: MODAL COMPONENT EXAMPLES
Dokumentasi lengkap dengan semua contoh penggunaan modal component
Simpan file ini sebagai referensi untuk kopipasta saat membuat modal baru
-->

{{-- ==================== CONTOH 1: Modal Sederhana ====================  --}}
<x-ui.modal id="simple-modal">
    @slot('trigger')
        <x-ui.button type="button" variant="accent">Buka Modal</x-ui.button>
    @endslot

    <div class="text-center">
        <h2 class="text-xl font-black text-primary mb-2">Modal Sederhana</h2>
        <p class="text-slate-600 mb-4">Ini adalah contoh modal paling sederhana.</p>
        <x-ui.button @click="open = false" variant="primary">Tutup</x-ui.button>
    </div>
</x-ui.modal>

{{-- ==================== CONTOH 2: Confirmation Modal ====================  --}}
<x-ui.modal id="delete-confirm-modal">
    @slot('trigger')
        <x-ui.button type="button" variant="muted">Hapus Item</x-ui.button>
    @endslot

    <div>
        <div class="flex gap-3 mb-4">
            <div class="shrink-0 flex items-center justify-center size-12 rounded-lg bg-red-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6h16z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-black text-primary">Hapus Item?</h2>
                <p class="text-sm text-slate-600">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>

        <p class="text-sm text-slate-600 mb-6">Apakah Anda yakin ingin menghapus item ini? Data yang dihapus tidak bisa dikembalikan.</p>

        <div class="flex gap-2 justify-end">
            <x-ui.button @click="open = false" variant="muted">Batal</x-ui.button>
            <x-ui.button type="submit" variant="accent" class="hover:bg-red-600 hover:border-red-600">Hapus</x-ui.button>
        </div>
    </div>
</x-ui.modal>

{{-- ==================== CONTOH 3: Success Alert Modal ====================  --}}
<x-ui.modal id="success-alert-modal">
    <div class="text-center">
        <div class="flex items-center justify-center size-16 rounded-full bg-green-50 mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M20 6L9 17l-5-5"/>
            </svg>
        </div>
        <h2 class="text-xl font-black text-primary mb-2">Berhasil!</h2>
        <p class="text-slate-600 mb-6">Data Anda telah berhasil disimpan ke sistem.</p>
        <x-ui.button @click="open = false" variant="accent">Tutup</x-ui.button>
    </div>
</x-ui.modal>

{{-- ==================== CONTOH 4: Form Modal dengan Input Sederhana ====================  --}}
<x-ui.modal id="edit-category-modal">
    @slot('trigger')
        <x-ui.button type="button" variant="outline">Edit Kategori</x-ui.button>
    @endslot

    <div class="border-b-2 border-primary/8 pb-4 mb-4">
        <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Kelola Data</p>
        <h2 class="text-xl font-black text-primary">Edit Kategori</h2>
    </div>

    <form method="POST" action="">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="category-name" class="text-xs font-black uppercase tracking-wide text-primary/70">Nama Kategori</label>
            <input id="category-name" type="text" name="name" placeholder="Masukkan nama kategori"
                class="mt-1.5 h-10 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
        </div>

        <div class="flex gap-2 justify-end border-t-2 border-primary/8 pt-4">
            <x-ui.button @click="open = false" type="button" variant="muted">Batal</x-ui.button>
            <x-ui.button type="submit" variant="accent">Simpan Perubahan</x-ui.button>
        </div>
    </form>
</x-ui.modal>

{{-- ==================== CONTOH 5: Modal untuk Memilih File ====================  --}}
<x-ui.modal id="file-upload-modal">
    @slot('trigger')
        <x-ui.button type="button" variant="outline">Upload File</x-ui.button>
    @endslot

    <div class="border-b-2 border-primary/8 pb-4 mb-4">
        <h2 class="text-xl font-black text-primary">Upload File Dokumen</h2>
    </div>

    <form method="POST" action="" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="file-input" class="text-xs font-black uppercase tracking-wide text-primary/70">Pilih File</label>
            <div class="mt-1.5 flex items-center justify-center w-full p-6 border-2 border-dashed border-primary/25 rounded-lg bg-surface hover:bg-primary/[.03] transition cursor-pointer">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-primary/50 mx-auto mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 8.25 12 3.75m0 0L7.5 8.25M12 3.75v12"/>
                    </svg>
                    <p class="text-xs font-semibold text-slate-500">
                        <span class="font-black text-primary">Klik untuk memilih</span> atau seret file ke sini
                    </p>
                </div>
                <input id="file-input" type="file" name="file" class="hidden">
            </div>
        </div>

        <div class="flex gap-2 justify-end border-t-2 border-primary/8 pt-4">
            <x-ui.button @click="open = false" type="button" variant="muted">Batal</x-ui.button>
            <x-ui.button type="submit" variant="accent">Upload</x-ui.button>
        </div>
    </form>
</x-ui.modal>

{{-- ==================== CONTOH 6: Modal dengan Multiple Input Fields ====================  --}}
<x-ui.modal id="create-user-modal">
    @slot('trigger')
        <x-ui.button type="button" variant="accent">Tambah User Baru</x-ui.button>
    @endslot

    <div class="border-b-2 border-primary/8 pb-4 mb-4">
        <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">User Management</p>
        <h2 class="text-xl font-black text-primary">Tambah User Baru</h2>
    </div>

    <form method="POST" action="">
        @csrf

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="user-name" class="text-xs font-black uppercase tracking-wide text-primary/70">Nama Lengkap</label>
                <input id="user-name" type="text" name="name" placeholder="Contoh: John Doe"
                    class="mt-1.5 h-10 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
            </div>

            <div>
                <label for="user-email" class="text-xs font-black uppercase tracking-wide text-primary/70">Email</label>
                <input id="user-email" type="email" name="email" placeholder="contoh@email.com"
                    class="mt-1.5 h-10 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
            </div>
        </div>

        <div class="mt-4">
            <label for="user-role" class="text-xs font-black uppercase tracking-wide text-primary/70">Role</label>
            <select id="user-role" name="role"
                class="mt-1.5 h-10 w-full rounded-lg border-2 border-primary/15 bg-surface px-3 text-sm font-semibold outline-none transition focus:border-primary focus:bg-white">
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
            </select>
        </div>

        <div class="mt-4 flex items-center gap-2">
            <input id="user-active" type="checkbox" name="is_active" value="1" checked
                class="size-4 rounded border-2 border-primary/25 bg-surface text-primary focus:ring-2 focus:ring-accent">
            <label for="user-active" class="text-xs font-semibold text-slate-600">User Aktif</label>
        </div>

        <div class="mt-4 flex gap-2 justify-end border-t-2 border-primary/8 pt-4">
            <x-ui.button @click="open = false" type="button" variant="muted">Batal</x-ui.button>
            <x-ui.button type="submit" variant="accent">Tambah User</x-ui.button>
        </div>
    </form>
</x-ui.modal>

{{-- ==================== CONTOH 7: Info Modal ====================  --}}
<x-ui.modal id="info-modal">
    @slot('trigger')
        <x-ui.button type="button" @click="open = true" class="gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/>
            </svg>
            Info
        </x-ui.button>
    @endslot

    <div class="text-center">
        <div class="flex items-center justify-center size-16 rounded-full bg-blue-50 mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/>
            </svg>
        </div>
        <h2 class="text-xl font-black text-primary mb-2">Informasi Penting</h2>
        <p class="text-slate-600 mb-2">Pastikan semua data sudah terisi dengan benar sebelum melanjutkan.</p>
        <p class="text-sm text-slate-500">Perubahan tidak dapat dibatalkan setelah dikonfirmasi.</p>
        <div class="mt-6">
            <x-ui.button @click="open = false" variant="accent">Mengerti</x-ui.button>
        </div>
    </div>
</x-ui.modal>

{{-- ==================== CARA PENGGUNAAN JAVASCRIPT ====================  --}}
{{-- Untuk membuka modal dari JavaScript, gunakan dispatch event:

// Membuka modal
document.dispatchEvent(new CustomEvent('open-modal', { 
    detail: { id: 'simple-modal' } 
}));

// Menutup modal tertentu
document.dispatchEvent(new CustomEvent('close-modal', { 
    detail: { id: 'simple-modal' } 
}));

// Menutup semua modal
document.dispatchEvent(new CustomEvent('close-modal', { 
    detail: { id: 'all' } 
}));
--}}

{{-- ==================== CATATAN PENTING ====================  --}}
{{-- 
1. Selalu berikan ID unik untuk setiap modal
2. Modal akan otomatis closed jika user:
   - Klik tombol close (X)
   - Klik area backdrop (luar modal)
   - Tekan tombol ESC
   - Klik button dengan @click="open = false"

3. Untuk form modal, pastikan:
   - Method form sudah benar (POST/PUT/PATCH/DELETE)
   - Action route sudah valid
   - CSRF token sudah ada (@csrf)
   - Error handling sudah ada (@error)

4. Styling:
   - Modal mengikuti design system project
   - Warna: primary, secondary, accent, surface
   - Ukuran button: sm, md, lg
   - Variant button: primary, secondary, muted, accent, outline, ghost

5. Tips Customization:
   - Ubah max-w-lg menjadi max-w-2xl/max-w-4xl untuk modal lebih besar
   - Ubah padding p-6 untuk spacing berbeda
   - Tambah class overflow-y-auto jika konten modal panjang
--}}
