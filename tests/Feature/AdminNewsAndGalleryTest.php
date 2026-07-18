<?php

use App\Models\Announcement;
use App\Models\News;
use App\Models\GalleryItem;
use App\Models\User;
use Database\Seeders\NewsAndGallerySeeder;

beforeEach(function () {
    $this->seed(NewsAndGallerySeeder::class);
});

test('public berita page renders news from database', function () {
    $this->get('/berita')
        ->assertOk()
        ->assertSee('Siswa Golden Sierra Raih Juara LKBB Tingkat Kota')
        ->assertSee('Kegiatan Literasi Pagi Dorong Budaya Membaca');
});

test('public berita page filters news by category', function () {
    $this->get('/berita?category=Prestasi')
        ->assertOk()
        ->assertSee('Siswa Golden Sierra Raih Juara LKBB Tingkat Kota')
        ->assertDontSee('Kegiatan Literasi Pagi Dorong Budaya Membaca');
});

test('public berita page searches news by title', function () {
    $this->get('/berita?search=Literasi')
        ->assertOk()
        ->assertSee('Kegiatan Literasi Pagi Dorong Budaya Membaca')
        ->assertDontSee('Siswa Golden Sierra Raih Juara LKBB Tingkat Kota');
});

test('public pengumuman page renders announcements from database', function () {
    $this->get('/pengumuman')
        ->assertOk()
        ->assertSee('PPDB Tahun Ajaran 2026/2027')
        ->assertSee('Jadwal Asesmen Tengah Semester');
});

test('public pengumuman page filters announcements by category', function () {
    $this->get('/pengumuman?category=Pendaftaran')
        ->assertOk()
        ->assertSee('PPDB Tahun Ajaran 2026/2027')
        ->assertDontSee('Pengambilan Seragam dan Buku Paket');
});

test('public galeri page renders gallery items and albums', function () {
    $this->get('/galeri')
        ->assertOk()
        ->assertSee('Kelas Interaktif')
        ->assertSee('Pentas Seni');
});

test('public galeri page filters items by album', function () {
    $this->get('/galeri?album=Ekstrakurikuler')
        ->assertOk()
        ->assertSee('Upacara Pagi')
        ->assertSee('Ekskul Basket')
        ->assertDontSee('Kelas Interaktif');
});

test('homepage renders dynamic news and gallery', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Siswa Golden Sierra Raih Juara LKBB Tingkat Kota')
        ->assertSee('PPDB Tahun Ajaran 2026/2027')
        ->assertSee('Kelas Interaktif');
});

test('admin can manage news articles', function () {
    $user = User::factory()->create();

    // 1. Index
    $this->actingAs($user)
        ->get(route('admin.news.index'))
        ->assertOk()
        ->assertSee('Siswa Golden Sierra Raih Juara LKBB Tingkat Kota');

    // 2. Create
    $this->actingAs($user)
        ->post(route('admin.news.store'), [
            'title' => 'Berita Baru Sekolah',
            'category' => 'Kegiatan',
            'date' => '17 Juli 2026',
            'copy' => 'Ini adalah konten berita baru sekolah.',
            'is_active' => '1',
            'is_featured' => '0',
        ])
        ->assertRedirect(route('admin.news.index'));

    $this->assertDatabaseHas('news', [
        'title' => 'Berita Baru Sekolah',
        'category' => 'Kegiatan',
    ]);

    $news = News::where('title', 'Berita Baru Sekolah')->firstOrFail();

    // 3. Edit & Update
    $this->actingAs($user)
        ->put(route('admin.news.update', $news), [
            'title' => 'Berita Baru Sekolah Update',
            'category' => 'Prestasi',
            'date' => '18 Juli 2026',
            'copy' => 'Ini adalah konten berita baru sekolah yang diupdate.',
            'is_active' => '1',
            'is_featured' => '1',
        ])
        ->assertRedirect(route('admin.news.index'));

    $this->assertDatabaseHas('news', [
        'title' => 'Berita Baru Sekolah Update',
        'category' => 'Prestasi',
        'is_featured' => true,
    ]);

    // 4. Delete
    $this->actingAs($user)
        ->delete(route('admin.news.destroy', $news))
        ->assertRedirect(route('admin.news.index'));

    $this->assertDatabaseMissing('news', [
        'id' => $news->id,
    ]);
});

test('admin can manage announcements', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.announcements.index'))
        ->assertOk()
        ->assertSee('PPDB Tahun Ajaran 2026/2027');

    $this->actingAs($user)
        ->post(route('admin.announcements.store'), [
            'title' => 'Pengumuman Baru Sekolah',
            'category' => 'Info Orang Tua',
            'date' => '17 Juli 2026',
            'copy' => 'Ini adalah konten pengumuman baru sekolah.',
            'is_active' => '1',
        ])
        ->assertRedirect(route('admin.announcements.index'));

    $this->assertDatabaseHas('announcements', [
        'title' => 'Pengumuman Baru Sekolah',
        'category' => 'Info Orang Tua',
    ]);

    $announcement = Announcement::where('title', 'Pengumuman Baru Sekolah')->firstOrFail();

    $this->actingAs($user)
        ->put(route('admin.announcements.update', $announcement), [
            'title' => 'Pengumuman Baru Sekolah Update',
            'category' => 'Akademik',
            'date' => '18 Juli 2026',
            'copy' => 'Ini adalah konten pengumuman baru sekolah yang diupdate.',
            'is_active' => '0',
        ])
        ->assertRedirect(route('admin.announcements.index'));

    $this->assertDatabaseHas('announcements', [
        'title' => 'Pengumuman Baru Sekolah Update',
        'category' => 'Akademik',
        'is_active' => false,
    ]);

    $this->actingAs($user)
        ->delete(route('admin.announcements.destroy', $announcement))
        ->assertRedirect(route('admin.announcements.index'));

    $this->assertDatabaseMissing('announcements', [
        'id' => $announcement->id,
    ]);
});

test('admin can manage gallery items', function () {
    $user = User::factory()->create();

    // 1. Index
    $this->actingAs($user)
        ->get(route('admin.gallery-items.index'))
        ->assertOk()
        ->assertSee('Kelas Interaktif');

    // 2. Create
    $this->actingAs($user)
        ->post(route('admin.gallery-items.store'), [
            'title' => 'Foto Baru',
            'album' => 'Ekstrakurikuler',
            'is_active' => '1',
        ])
        ->assertRedirect(route('admin.gallery-items.index'));

    $this->assertDatabaseHas('gallery_items', [
        'title' => 'Foto Baru',
        'album' => 'Ekstrakurikuler',
    ]);

    $item = GalleryItem::where('title', 'Foto Baru')->firstOrFail();

    // 3. Edit & Update
    $this->actingAs($user)
        ->put(route('admin.gallery-items.update', $item), [
            'title' => 'Foto Baru Update',
            'album' => 'Lingkungan Sekolah',
            'is_active' => '0',
        ])
        ->assertRedirect(route('admin.gallery-items.index'));

    $this->assertDatabaseHas('gallery_items', [
        'title' => 'Foto Baru Update',
        'album' => 'Lingkungan Sekolah',
        'is_active' => false,
    ]);

    // 4. Delete
    $this->actingAs($user)
        ->delete(route('admin.gallery-items.destroy', $item))
        ->assertRedirect(route('admin.gallery-items.index'));

    $this->assertDatabaseMissing('gallery_items', [
        'id' => $item->id,
    ]);
});
