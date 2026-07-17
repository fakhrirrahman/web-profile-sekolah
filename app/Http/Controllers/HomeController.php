<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(): View
    {
        $news = News::query()
            ->where('is_active', true)
            ->latest()
            ->take(2)
            ->get();

        $galleryItems = GalleryItem::query()
            ->where('is_active', true)
            ->latest()
            ->take(5)
            ->get();

        $this->appendGalleryImageUrls($galleryItems);

        return view('pages.home', compact('news', 'galleryItems'));
    }

    public function profile(): View
    {
        return view('pages.profile');
    }

    public function berita(Request $request): View
    {
        $categories = ['Semua', 'Prestasi', 'Kegiatan', 'Akademik', 'Info Orang Tua'];

        $search = $request->input('search');
        $activeCategory = $request->input('category', 'Semua');

        $query = News::query()->where('is_active', true);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('copy', 'like', "%{$search}%");
            });
        }

        if ($activeCategory !== 'Semua') {
            $query->where('category', $activeCategory);
        }

        $featuredQuery = clone $query;
        $featured = $featuredQuery->where('is_featured', true)->latest()->first();

        if (!$featured) {
            $featuredQuery = clone $query;
            $featured = $featuredQuery->latest()->first();
        }

        $articlesQuery = clone $query;
        if ($featured) {
            $articlesQuery->where('id', '!=', $featured->id);
        }

        return view('pages.berita', [
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'featured' => $featured,
            'articles' => $articlesQuery->latest()->get(),
            'search' => $search,
        ]);
    }

    public function ppdb(): View
    {
        return view('pages.ppdb');
    }

    public function galeri(Request $request): View
    {
        $albumDescriptions = [
            'Kegiatan Belajar' => 'Dokumentasi suasana kelas, diskusi, dan pembelajaran aktif.',
            'Prestasi Siswa' => 'Momen lomba, penyerahan penghargaan, dan apresiasi siswa.',
            'Ekstrakurikuler' => 'Kegiatan minat bakat yang membantu siswa berani mencoba.',
            'Lingkungan Sekolah' => 'Area sekolah, fasilitas, dan ruang belajar sehari-hari.',
        ];

        $activeAlbum = $request->input('album');
        $query = GalleryItem::query()->where('is_active', true);

        if ($activeAlbum) {
            $query->where('album', $activeAlbum);
        }

        $galleryItems = $query->latest()->get();
        $this->appendGalleryImageUrls($galleryItems);

        $albumCounts = GalleryItem::query()
            ->where('is_active', true)
            ->select('album', DB::raw('count(*) as count'))
            ->groupBy('album')
            ->get()
            ->pluck('count', 'album')
            ->toArray();

        $albums = [];
        foreach ($albumDescriptions as $title => $copy) {
            $count = $albumCounts[$title] ?? 0;
            $albums[] = [
                'title' => $title,
                'count' => $count . ' Foto',
                'copy' => $copy,
                'active' => $activeAlbum === $title,
            ];
        }

        return view('pages.galeri', [
            'albums' => $albums,
            'galleryItems' => $galleryItems,
            'totalPhotos' => GalleryItem::query()->where('is_active', true)->count(),
            'totalAlbums' => GalleryItem::query()->where('is_active', true)->distinct('album')->count('album'),
            'activeAlbum' => $activeAlbum,
        ]);
    }

    public function kontak(): View
    {
        return view('pages.kontak');
    }

    private function appendGalleryImageUrls(Collection $galleryItems): void
    {
        $galleryItems->each(function (GalleryItem $item) {
            $item->image_url = $item->image
                ? Storage::disk('public')->url($item->image)
                : null;
        });
    }
}
