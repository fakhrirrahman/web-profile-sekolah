<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\News;
use App\Models\GalleryItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsAndGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed News
        $newsItems = [
            [
                'title' => 'Siswa Golden Sierra Raih Juara LKBB Tingkat Kota',
                'date' => '11 Juni 2026',
                'category' => 'Prestasi',
                'copy' => 'Tim siswa Golden Sierra menunjukkan disiplin, kekompakan, dan keberanian saat mengikuti lomba tingkat kota.',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Kegiatan Literasi Pagi Dorong Budaya Membaca',
                'date' => '9 Juni 2026',
                'category' => 'Kegiatan',
                'copy' => 'Program literasi pagi membantu siswa membangun kebiasaan membaca secara ringan dan konsisten.',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Ekskul Robotik Memulai Proyek Semester Baru',
                'date' => '3 Agustus 2026',
                'category' => 'Kegiatan',
                'copy' => 'Siswa belajar mengenal logika, rangkaian sederhana, dan kebiasaan menyelesaikan masalah.',
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($newsItems as $news) {
            News::updateOrCreate(
                ['slug' => Str::slug($news['title'])],
                $news
            );
        }

        // Seed Announcements
        $announcements = [
            [
                'title' => 'PPDB Tahun Ajaran 2026/2027',
                'date' => '16 Juli 2026',
                'category' => 'Pendaftaran',
                'copy' => 'Informasi pendaftaran peserta didik baru tahun ajaran 2026/2027 telah tersedia untuk orang tua dan calon siswa.',
                'is_active' => true,
            ],
            [
                'title' => 'Jadwal Asesmen Tengah Semester',
                'date' => '22 Juli 2026',
                'category' => 'Akademik',
                'copy' => 'Orang tua dapat melihat jadwal asesmen melalui wali kelas dan kanal komunikasi sekolah.',
                'is_active' => true,
            ],
            [
                'title' => 'Pengambilan Seragam dan Buku Paket',
                'date' => '27 Juli 2026',
                'category' => 'Info Orang Tua',
                'copy' => 'Sekolah menyiapkan jadwal pengambilan bertahap agar proses tetap tertib dan nyaman.',
                'is_active' => true,
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::updateOrCreate(
                ['slug' => Str::slug($announcement['title'])],
                $announcement
            );
        }

        // Seed Gallery Items
        $galleryItems = [
            ['title' => 'Kelas Interaktif', 'album' => 'Kegiatan Belajar'],
            ['title' => 'Kegiatan Literasi', 'album' => 'Kegiatan Belajar'],
            ['title' => 'Pentas Seni', 'album' => 'Prestasi Siswa'],
            ['title' => 'Upacara Pagi', 'album' => 'Ekstrakurikuler'],
            ['title' => 'Ekskul Basket', 'album' => 'Ekstrakurikuler'],
            ['title' => 'Perpustakaan', 'album' => 'Lingkungan Sekolah'],
            ['title' => 'Lapangan Sekolah', 'album' => 'Lingkungan Sekolah'],
            ['title' => 'Laboratorium', 'album' => 'Lingkungan Sekolah'],
        ];

        foreach ($galleryItems as $item) {
            GalleryItem::updateOrCreate(
                ['title' => $item['title']],
                [
                    'album' => $item['album'],
                    'image' => null,
                    'is_active' => true,
                ]
            );
        }
    }
}
