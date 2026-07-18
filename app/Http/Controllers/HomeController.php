<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\GalleryItem;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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
        $this->appendNewsImageUrls($news);

        $achievements = News::query()
            ->where('is_active', true)
            ->where('category', 'Prestasi')
            ->latest()
            ->take(2)
            ->get();
        $this->appendNewsImageUrls($achievements);

        $galleryItems = GalleryItem::query()
            ->where('is_active', true)
            ->latest()
            ->take(5)
            ->get();

        $this->appendGalleryImageUrls($galleryItems);

        $announcements = Announcement::query()
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.home', compact('news', 'achievements', 'galleryItems', 'announcements'));
    }

    public function profile(): View
    {
        return view('pages.profile');
    }

    public function berita(Request $request): View
    {
        $categories = collect(['Semua'])
            ->merge(
                News::query()
                    ->where('is_active', true)
                    ->distinct()
                    ->orderBy('category')
                    ->pluck('category')
            )
            ->values()
            ->all();

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
        $articles = $articlesQuery->latest()->get();

        $quickAnnouncements = Announcement::query()
            ->where('is_active', true)
            ->latest()
            ->take(2)
            ->get();

        $newsItems = collect($articles->all());
        if ($featured) {
            $newsItems = $newsItems->push($featured);
        }
        $this->appendNewsImageUrls($newsItems);

        return view('pages.berita', [
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'featured' => $featured,
            'articles' => $articles,
            'quickAnnouncements' => $quickAnnouncements,
            'search' => $search,
        ]);
    }

    public function beritaShow(News $news): View
    {
        abort_unless($news->is_active, 404);

        $this->appendNewsImageUrls(collect([$news]));

        $relatedNews = News::query()
            ->where('is_active', true)
            ->where('id', '!=', $news->id)
            ->where('category', $news->category)
            ->latest()
            ->take(3)
            ->get();

        if ($relatedNews->count() < 3) {
            $fallbackNews = News::query()
                ->where('is_active', true)
                ->where('id', '!=', $news->id)
                ->whereNotIn('id', $relatedNews->pluck('id'))
                ->latest()
                ->take(3 - $relatedNews->count())
                ->get();

            $relatedNews = $relatedNews->concat($fallbackNews);
        }

        $this->appendNewsImageUrls($relatedNews);

        return view('pages.berita-detail', [
            'news' => $news,
            'relatedNews' => $relatedNews,
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

    private function appendNewsImageUrls(Collection $newsItems): void
    {
        $newsItems->each(function (News $item) {
            $item->image_url = match (true) {
                blank($item->image) => null,
                Str::startsWith($item->image, ['http://', 'https://', '/']) => $item->image,
                default => Storage::disk('public')->url($item->image),
            };
        });
    }

}
