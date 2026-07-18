<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(Request $request): View
    {
        $categories = collect(['Semua'])
            ->merge(
                Announcement::query()
                    ->where('is_active', true)
                    ->distinct()
                    ->orderBy('category')
                    ->pluck('category')
            )
            ->values()
            ->all();

        $search = $request->input('search');
        $activeCategory = $request->input('category', 'Semua');

        $query = Announcement::query()->where('is_active', true);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('copy', 'like', "%{$search}%");
            });
        }

        if ($activeCategory !== 'Semua') {
            $query->where('category', $activeCategory);
        }

        $announcements = $query->latest()->get();
        $quickAnnouncements = Announcement::query()
            ->where('is_active', true)
            ->latest()
            ->take(2)
            ->get();

        return view('pages.pengumuman', [
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'announcements' => $announcements,
            'quickAnnouncements' => $quickAnnouncements,
            'search' => $search,
        ]);
    }

    public function show(Announcement $announcement): View
    {
        abort_unless($announcement->is_active, 404);

        $relatedAnnouncements = Announcement::query()
            ->where('is_active', true)
            ->where('id', '!=', $announcement->id)
            ->where('category', $announcement->category)
            ->latest()
            ->take(3)
            ->get();

        if ($relatedAnnouncements->count() < 3) {
            $fallbackAnnouncements = Announcement::query()
                ->where('is_active', true)
                ->where('id', '!=', $announcement->id)
                ->whereNotIn('id', $relatedAnnouncements->pluck('id'))
                ->latest()
                ->take(3 - $relatedAnnouncements->count())
                ->get();

            $relatedAnnouncements = $relatedAnnouncements->concat($fallbackAnnouncements);
        }

        return view('pages.pengumuman-detail', [
            'announcement' => $announcement,
            'relatedAnnouncements' => $relatedAnnouncements,
        ]);
    }
}
