<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.news.index', [
            'newsItems' => News::query()->latest()->get(),
        ]);
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
            'image' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

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
            'image' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

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
