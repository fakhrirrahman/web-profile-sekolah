<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PpdbRegistrationController extends Controller
{
    public function index(): View
    {
        $registrations = PpdbRegistration::query()
            ->latest()
            ->get();

        return view('pages.admin.ppdb.index', [
            'registrations' => $registrations,
            'statuses' => PpdbRegistration::STATUSES,
        ]);
    }

    public function update(Request $request, PpdbRegistration $ppdbRegistration): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys(PpdbRegistration::STATUSES))],
        ]);

        if (in_array($ppdbRegistration->status, PpdbRegistration::FINAL_STATUSES)) {
            flash()->error('Status akhir tidak dapat diubah.');
            return back();
        }

        $currentOrder = PpdbRegistration::STATUS_ORDER[$ppdbRegistration->status];
        $newOrder = PpdbRegistration::STATUS_ORDER[$validated['status']];

        if ($newOrder < $currentOrder) {
            flash()->error('Status tidak boleh dikembalikan ke tahap sebelumnya.');

            return back();
        }

        $ppdbRegistration->update($validated);

        flash()->success('Status pendaftaran berhasil diperbarui.');

        return redirect()->route('admin.ppdb-registrations.index');
    }

    public function destroy(PpdbRegistration $ppdbRegistration): RedirectResponse
    {
        $ppdbRegistration->delete();

        flash()->success('Data pendaftaran berhasil dihapus.');

        return redirect()->route('admin.ppdb-registrations.index');
    }
}
