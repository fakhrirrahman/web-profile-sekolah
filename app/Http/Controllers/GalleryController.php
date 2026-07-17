<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
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

        // Group by album to get counts
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

        $totalPhotos = GalleryItem::query()->where('is_active', true)->count();
        $totalAlbums = GalleryItem::query()->where('is_active', true)->distinct('album')->count('album');

        return view('pages.galeri', [
            'albums' => $albums,
            'galleryItems' => $galleryItems,
            'totalPhotos' => $totalPhotos,
            'totalAlbums' => $totalAlbums,
            'activeAlbum' => $activeAlbum,
        ]);
    }
}
