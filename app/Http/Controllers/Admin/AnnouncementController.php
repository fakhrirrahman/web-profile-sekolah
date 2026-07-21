<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::query()
            ->latest()
            ->get();

        return view('pages.admin.announcements.index', compact('announcements'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['copy'] = $validated['content_type'] === 'text' ? $validated['copy'] : '';
        unset($validated['pdf_file']);

        if ($request->hasFile('pdf_file')) {
            $validated['pdf_path'] = $request->file('pdf_file')->store('announcements', 'public');
        }

        Announcement::create($validated);

        flash()->success('Pengumuman berhasil ditambahkan.');

        return redirect()->route('admin.announcements.index');
    }

    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $validated = $this->validatedData($request, $announcement);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['slug'] = Str::slug($validated['title']);
        $validated['copy'] = $validated['content_type'] === 'text' ? $validated['copy'] : '';
        unset($validated['pdf_file']);

        if ($validated['content_type'] === 'text') {
            $this->deletePdf($announcement);
            $validated['pdf_path'] = null;
        }

        if ($request->hasFile('pdf_file')) {
            $this->deletePdf($announcement);
            $validated['pdf_path'] = $request->file('pdf_file')->store('announcements', 'public');
        }

        $announcement->update($validated);

        flash()->success('Pengumuman berhasil diperbarui.');

        return redirect()->route('admin.announcements.index');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $this->deletePdf($announcement);
        $announcement->delete();

        flash()->success('Pengumuman berhasil dihapus.');

        return redirect()->route('admin.announcements.index');
    }

    private function validatedData(Request $request, ?Announcement $announcement = null): array
    {
        $contentType = $request->input('content_type', 'text');
        $copyRules = $contentType === 'text' ? ['required', 'string'] : ['nullable', 'string'];
        $pdfRules = ['nullable', 'file', 'mimes:pdf', 'max:10240'];

        if ($contentType === 'pdf' && ! $announcement?->pdf_path) {
            array_unshift($pdfRules, 'required');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'content_type' => ['nullable', Rule::in(['text', 'pdf'])],
            'copy' => $copyRules,
            'pdf_file' => $pdfRules,
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['content_type'] = $contentType;

        return $validated;
    }

    private function deletePdf(Announcement $announcement): void
    {
        if ($announcement->pdf_path) {
            Storage::disk('public')->delete($announcement->pdf_path);
        }
    }
}
