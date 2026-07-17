<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(): View
    {
        $newsItems = News::query()
            ->latest()
            ->get()
            ->map(function (News $news) {
                $news->image_url = match (true) {
                    blank($news->image) => null,
                    Str::startsWith($news->image, ['http://', 'https://', '/']) => $news->image,
                    default => Storage::disk('public')->url($news->image),
                };

                return $news;
            });

        return view('pages.admin.news.index', compact('newsItems'));
    }

    public function create(): View
    {
        return view('pages.admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'copy' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['image'] = $request->hasFile('image')
            ? $request->file('image')->store('news', 'public')
            : null;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['slug'] = Str::slug($validated['title']);

        News::create($validated);

        flash()->success('Berita berhasil ditambahkan.');

        return redirect()->route('admin.news.index');
    }

    public function edit(News $news): View
    {
        return view('pages.admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'copy' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = $news->image;

        if ($request->hasFile('image')) {
            if ($imagePath && ! Str::startsWith($imagePath, ['http://', 'https://', '/'])) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('news', 'public');
        } elseif ($request->boolean('remove_image') && $imagePath) {
            if (! Str::startsWith($imagePath, ['http://', 'https://', '/'])) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = null;
        }

        $validated['image'] = $imagePath;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['slug'] = Str::slug($validated['title']);

        $news->update($validated);

        flash()->success('Berita berhasil diperbarui.');

        return redirect()->route('admin.news.index');
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        flash()->success('Berita berhasil dihapus.');

        return redirect()->route('admin.news.index');
    }
}
