<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PpdbRegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $registrations = $this->filteredRegistrationsQuery($request)
            ->latest()
            ->get();

        return view('pages.admin.ppdb.index', [
            'filters' => $this->filters($request),
            'grades' => $this->availableGrades(),
            'registrations' => $registrations,
            'statuses' => PpdbRegistration::STATUSES,
        ]);
    }

    public function exportPdf(Request $request): Response
    {
        $registrations = $this->filteredRegistrationsQuery($request)
            ->latest()
            ->get();

        $filename = 'data-ppdb-' . now()->format('Ymd-His') . '.pdf';

        return Pdf::loadView('pages.admin.ppdb.pdf', [
            'filters' => $this->filters($request),
            'generatedAt' => now(),
            'registrations' => $registrations,
            'statuses' => PpdbRegistration::STATUSES,
        ])
            ->setPaper('a4', 'portrait')
            ->download($filename);
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

        DB::transaction(function () use ($ppdbRegistration, $validated) {
            $oldStatus = $ppdbRegistration->status;

            $ppdbRegistration->update($validated);

            if ($oldStatus !== $validated['status']) {
                $ppdbRegistration->recordStatusHistory($validated['status']);
            }
        });

        flash()->success('Status pendaftaran berhasil diperbarui.');

        return redirect()->route('admin.ppdb-registrations.index');
    }

    public function destroy(PpdbRegistration $ppdbRegistration): RedirectResponse
    {
        $ppdbRegistration->delete();

        flash()->success('Data pendaftaran berhasil dihapus.');

        return redirect()->route('admin.ppdb-registrations.index');
    }

    private function filteredRegistrationsQuery(Request $request): Builder
    {
        $filters = $this->filters($request);

        return PpdbRegistration::query()
            ->when($filters['search'], function (Builder $query, string $search) {
                $query->where(function (Builder $query) use ($search) {
                    $query
                        ->where('registration_number', 'like', "%{$search}%")
                        ->orWhere('student_name', 'like', "%{$search}%")
                        ->orWhere('parent_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($filters['status'], fn (Builder $query, string $status) => $query->where('status', $status))
            ->when($filters['grade'], fn (Builder $query, string $grade) => $query->where('desired_grade', $grade));
    }

    /**
     * @return array{search: string, status: string, grade: string}
     */
    private function filters(Request $request): array
    {
        return [
            'search' => trim((string) $request->query('search', '')),
            'status' => array_key_exists((string) $request->query('status'), PpdbRegistration::STATUSES)
                ? (string) $request->query('status')
                : '',
            'grade' => trim((string) $request->query('grade', '')),
        ];
    }

    private function availableGrades()
    {
        return PpdbRegistration::query()
            ->select('desired_grade')
            ->whereNotNull('desired_grade')
            ->distinct()
            ->orderBy('desired_grade')
            ->pluck('desired_grade');
    }
}
