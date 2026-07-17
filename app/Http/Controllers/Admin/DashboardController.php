<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\GalleryItem;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            ['label' => 'Pengumuman Aktif', 'value' => '3', 'tone' => 'primary'],
            ['label' => 'Berita Terbit', 'value' => (string) News::query()->where('is_active', true)->count(), 'tone' => 'secondary'],
            ['label' => 'Galeri Ditampilkan', 'value' => (string) GalleryItem::query()->where('is_active', true)->count(), 'tone' => 'accent'],
            ['label' => 'Pesan Masuk', 'value' => '0', 'tone' => 'neutral'],
        ];

        $modules = [
            ['title' => 'Berita', 'copy' => 'Kelola berita, pengumuman, dan artikel dinamis sekolah.', 'icon' => 'newspaper', 'href' => route('admin.news.index')],
            ['title' => 'Galeri', 'copy' => 'Atur foto-foto dokumentasi kegiatan dan fasilitas sekolah.', 'icon' => 'image', 'href' => route('admin.gallery-items.index')],
            ['title' => 'PPDB', 'copy' => 'Siapkan jadwal, alur pendaftaran, dan info administrasi.', 'icon' => 'calendar', 'href' => '#'],
            ['title' => 'Profil Sekolah', 'copy' => 'Perbarui visi, misi, budaya, dan struktur sekolah.', 'icon' => 'users', 'href' => '#'],
        ];

        $activities = [
            ['title' => 'PPDB Tahun Ajaran 2026/2027', 'meta' => 'Konten siap ditampilkan di halaman PPDB.'],
            ['title' => 'Prestasi LKBB Tingkat Kota', 'meta' => 'Masuk antrean konten berita terbaru.'],
            ['title' => 'Galeri Area Sekolah', 'meta' => 'Highlight digunakan di halaman beranda.'],
        ];

        return view('pages.admin.dashboard', compact('stats', 'modules', 'activities'));
    }
}
