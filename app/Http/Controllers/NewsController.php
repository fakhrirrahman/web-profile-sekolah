<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $categories = ['Semua', 'Prestasi', 'Kegiatan', 'Akademik', 'Info Orang Tua'];
        
        $search = $request->input('search');
        $activeCategory = $request->input('category', 'Semua');

        // Main articles query
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

        // Fetch featured news: latest active featured item matching current filters
        $featuredQuery = clone $query;
        $featured = $featuredQuery->where('is_featured', true)->latest()->first();

        // Fallback to latest news matching current filters if no featured item matches
        if (!$featured) {
            $featuredQuery = clone $query;
            $featured = $featuredQuery->latest()->first();
        }

        // Articles list (excluding featured item)
        $articlesQuery = clone $query;
        if ($featured) {
            $articlesQuery->where('id', '!=', $featured->id);
        }
        $articles = $articlesQuery->latest()->get();

        return view('pages.berita', [
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'featured' => $featured,
            'articles' => $articles,
            'search' => $search,
        ]);
    }
}
