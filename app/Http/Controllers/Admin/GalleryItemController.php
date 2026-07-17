<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryItemController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.gallery.index', [
            'galleryItems' => GalleryItem::query()->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.gallery.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'album' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        GalleryItem::create($validated);

        return redirect()
            ->route('admin.gallery-items.index')
            ->with('status', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(GalleryItem $galleryItem): View
    {
        return view('pages.admin.gallery.edit', compact('galleryItem'));
    }

    public function update(Request $request, GalleryItem $galleryItem): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'album' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $galleryItem->update($validated);

        return redirect()
            ->route('admin.gallery-items.index')
            ->with('status', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(GalleryItem $galleryItem): RedirectResponse
    {
        $galleryItem->delete();

        return redirect()
            ->route('admin.gallery-items.index')
            ->with('status', 'Foto galeri berhasil dihapus.');
    }
}
