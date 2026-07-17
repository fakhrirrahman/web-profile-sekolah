<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'album' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('gallery', 'public')
            : null;

        GalleryItem::create([
            'title' => $request->input('title'),
            'album' => $request->input('album'),
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active', true),
        ]);

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
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'album' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = $galleryItem->image;

        if ($request->hasFile('image')) {
            // hapus gambar lama biar tidak numpuk file sampah di storage
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('gallery', 'public');
        } elseif ($request->boolean('remove_image') && $imagePath) {
            Storage::disk('public')->delete($imagePath);
            $imagePath = null;
        }

        $galleryItem->update([
            'title' => $request->input('title'),
            'album' => $request->input('album'),
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active'),
        ]);

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
