<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\News;
use App\Models\GalleryItem;
use App\Models\PpdbRegistration;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            ['label' => 'Pendaftar PPDB', 'value' => (string) PpdbRegistration::query()->count(), 'tone' => 'primary'],
            ['label' => 'Berita Terbit', 'value' => (string) News::query()->where('is_active', true)->count(), 'tone' => 'secondary'],
            ['label' => 'Galeri Ditampilkan', 'value' => (string) GalleryItem::query()->where('is_active', true)->count(), 'tone' => 'accent'],
            ['label' => 'Pesan Masuk', 'value' => (string) ContactMessage::query()->count(), 'tone' => 'neutral'],
        ];

        $modules = [
            ['title' => 'Berita', 'copy' => 'Kelola berita, pengumuman, dan artikel dinamis sekolah.', 'icon' => 'newspaper', 'href' => route('admin.news.index')],
            ['title' => 'Galeri', 'copy' => 'Atur foto-foto dokumentasi kegiatan dan fasilitas sekolah.', 'icon' => 'image', 'href' => route('admin.gallery-items.index')],
            ['title' => 'PPDB', 'copy' => 'Pantau data pendaftar dan perbarui status proses seleksi.', 'icon' => 'calendar', 'href' => route('admin.ppdb-registrations.index')],
            ['title' => 'Pesan Masuk', 'copy' => 'Baca pesan dari halaman kontak dan tandai tindak lanjutnya.', 'icon' => 'mail', 'href' => route('admin.contact-messages.index')],
        ];

        $activities = [
            ['title' => 'PPDB Tahun Ajaran 2026/2027', 'meta' => PpdbRegistration::query()->where('status', 'baru')->count() . ' pendaftar baru menunggu tindak lanjut.'],
            ['title' => 'Pesan Kontak', 'meta' => ContactMessage::query()->where('status', 'baru')->count() . ' pesan baru perlu dicek admin.'],
            ['title' => 'Prestasi LKBB Tingkat Kota', 'meta' => 'Masuk antrean konten berita terbaru.'],
        ];

        return view('pages.admin.dashboard', compact('stats', 'modules', 'activities'));
    }
}
